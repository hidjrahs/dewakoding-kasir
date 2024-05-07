<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Validator;

class Pos extends Component
{
    public $search = '';
    public $product;
    public $order;
    public $total_price;
    public $paid_amount = 0;

    public function render()
    {
        $this->order = Order::where('done_at', null)
                ->latest()
                ->first();

        if ($this->order ==  null) {
            $this->order = Order::create([
                'invoice_number' => $this->generateUniqueCode()
            ]);
        }

        $this->order = Order::where('done_at', null)
                ->with('orderProducts')
                ->latest()
                ->first();
        
        $this->total_price = $this->order->total_price ?? 0;
        return view('livewire.pos', [
            'products' => Product::search($this->search)->paginate(12),
            'order' => $this->order
        ]);
    }

    public function createOrder()
    {
        $this->order = Order::where('done_at', null)
                ->latest()
                ->first();

        if ($this->order ==  null) {
            $this->order = Order::create([
                'invoice_number' => $this->generateUniqueCode()
            ]);
        }
        // session()->flash('message', 'Sukses mulai transaksi, silakan pilih produk.');
    }

    public function updateCart($productId, $isAdded = true)
    {
        try {
            if ($this->order) {
                $product = Product::findOrFail($productId);
                $orderProduct = OrderProduct::where('order_id', $this->order->id)
                    ->where('product_id', $productId)
                    ->first();
                
                if ($orderProduct) {
                    if ($isAdded) {
                        if ($orderProduct->quantity + 1 > $product->stock) {
                            session()->flash('warning', 'Stok tidak cukup');
                            return false;
                        }
                        $orderProduct->increment('quantity', 1);
                    } else {
                        $orderProduct->decrement('quantity', 1);
                        if ($orderProduct->quantity < 1) {
                            $orderProduct->delete();
                            session()->flash('message', 'Produk berhasil dihapus dari keranjang');
                            return;
                        }
                    }
                    $orderProduct->save();
                } else {
                    if ($isAdded) {
                        if ($product->stock < 1) {
                            session()->flash('warning', 'Stok tidak cukup');
                            return false;
                        }

                        OrderProduct::create([
                            'order_id' => $this->order->id,
                            'product_id' => $product->id,
                            'unit_price' => $product->selling_price,
                            'quantity' => 1
                        ]);
                    }else{
                        session()->flash('warning', 'Stok Tidak Cukup');
                        return false;
                    }
                }
                $this->total_price = $this->order->total_price ?? 0;

                session()->flash('message', $isAdded ? 'Produk berhasil ditambahkan' : 'Produk berhasil dihapus dari keranjang');
            } else {
                session()->flash('message', 'Klik Mulai Transaksi Dahulu');
            }
            
        } catch (ValidationException $e) {
            dd($e);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function done()
    {
        
        $this->validate([
            'paid_amount' => 'required|numeric'
        ], [
            'paid_amount.required' => 'Jumlah yang dibayar harus diisi.',
            'paid_amount.numeric' => 'Jumlah yang dibayar harus berupa angka.',
            'paid_amount.min' => 'Jmlah yang dibayar harus di atas 0.'
        ]);
        $totalBelanja = 0;
        $totalBelanja = OrderProduct::where('order_id', $this->order->id)->sum('unit_price');
        if($totalBelanja == 0){
            $this->dispatch('openModal');
            session()->flash('payment', 'Mohon Pilih Produk Yang Akan Dibeli Terlebih Dahulu Sebelum Membayar');
            return false;
        }
        if($this->paid_amount == 0 || $this->paid_amount == ""){
            $this->dispatch('openModal');
            session()->flash('payment', 'Mohon Isi Uang Yang Dibayarkan');
            return false;
        }
        if($this->paid_amount < $totalBelanja){
            $this->dispatch('openModal');
            session()->flash('payment', 'Uang Yang Dibayarkan Kurang Dari Total Belanja');
            return false;
        }

        $this->order->update([
            'paid_amount' => $this->paid_amount,
            'done_at' => now()
        ]);

        // kurangi stok
        $itemBelanja = OrderProduct::where('order_id', $this->order->id)->get();
        foreach($itemBelanja as $t){
            $product    = Product::where('id', $t->product_id)->firstOrFail();
            $sisaStok   = $product->stock - $t->quantity;
            $product    = Product::where('id',$t->product_id)->update(['stock'=>$sisaStok]);   
        }

        session()->flash('message', 'Order/Transaksi selesai');
        $this->dispatch('closeModal');
    
        // Emitkan event untuk membuka kembali modal jika validasi gagal
        // return redirect()->route('pos');
    }

    function generateUniqueCode($length = 6) {
        $number = uniqid();
        $varray = str_split($number);
        $len = sizeof($varray);
        $uniq = array_slice($varray, $len-6, $len);
        $uniq = implode(",", $uniq);
        $uniq = str_replace(',', '', $uniq);

        return $uniq;
    }

}
