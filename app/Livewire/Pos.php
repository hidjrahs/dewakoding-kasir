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

        $this->dispatch('openModal');
        $tItem = 'Item'; //. str_repeat("&nbsp;", (6 - strlen('Item')));
        $tQty  = 'Qty'; //. str_repeat("&nbsp;", (6 - strlen('Qty')));
        $tHarga= 'Harga'; //str_repeat("&nbsp;", (6 - strlen('Harga'))).'Harga';
        $tTotal= 'Total'; //str_repeat("&nbsp;", (6 - strlen('Total'))).'Total';
        $caption = $tItem. $tHarga. $tTotal;

        $itm        = "";
        $subTotal   = 0;
        $diskon     = 0;
        $ppn        = 0;
        $totalBelanja = OrderProduct::join('products as b','b.id','=','order_products.product_id')->where('order_id',$this->order->id)->get();
        $itm .='<div class="row">';
        foreach($totalBelanja as $k=> $v){

            $subTotal += $v->unit_price*$v->quantity;
                    
            $itm .='<div class="col-5">'.$v->name.'</div>';
            $itm .='<div class="col-1">'.$v->quantity.'</div>';
            $itm .='<div class="col-3 text-center">'.number_format($v->unit_price, 0, ',', '.').'</div>';
            $itm .='<div class="col-3 text-end">'.number_format($v->unit_price*$v->quantity, 0, ',', '.').'</div>';
        }
        $itm .='</div>';
        $grandTotal = $subTotal-$diskon-$ppn;

        session()->flash('struk', '
        <div id="area-cetak">
            <div class="text-center mb-2"><b>Nota Penjualan</b></div>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td><b>GALERI TATON</b></td>
                </tr>
                <tr>
                    <td>Perum Palm Regency Karanglo Malang</td>
                </tr>
                <tr>
                    <td>Telp: 08123456789</td>
                </tr>
            </table>
            <hr style="border: 2px dashed black;">
            <table cellpadding="0" cellspacing="0" style="width:100%">
                <tr>
                    <td align="left" class="txt-left">Nota&nbsp;</td>
                    <td align="left" class="txt-left">:</td>
                    <td align="left" class="txt-left">&nbsp;'.$this->order->invoice_number.'</td>
                </tr>
                <tr class="d-none">
                    <td align="left" class="txt-left">Kasir</td>
                    <td align="left" class="txt-left">:</td>
                    <td align="left" class="txt-left">&nbsp;Admin</td>
                </tr>
                <tr>
                    <td align="left" class="txt-left">Tgl.&nbsp;</td>
                    <td align="left" class="txt-left">:</td>
                    <td align="left" class="txt-left">&nbsp;'.date('d/m/Y H:i:s',strtotime($this->order->done_at)).'</td>
                </tr>
            </table>
            <hr style="border: 2px dashed black;">
            <div class="row">
                <div class="col-5"><b>Item</b></div>
                <div class="col-1"><b>Qty</b></div>
                <div class="col-3 text-center"><b>Harga</b></div>
                <div class="col-3 text-end"><b>Total</b></div>
            </div>
            <hr style="border: 2px dashed black;">
            '.$itm.'
            <hr style="border: 2px dashed black;">
            <div class="row">
                <div class="col-6">Sub Total</div>
                <div class="col-6 text-end">'.number_format($subTotal, 0, ',', '.').'</div>
                <div class="col-6">Diskon</div>
                <div class="col-6 text-end">'.number_format($diskon, 0, ',', '.').'</div>
                <div class="col-6">PPN</div>
                <div class="col-6 text-end">'.number_format($ppn, 0, ',', '.').'</div>
                <div class="col-6">Grand Total</div>
                <div class="col-6 text-end">'.number_format($grandTotal, 0, ',', '.').'</div>
                <div class="col-6">Bayar</div>
                <div class="col-6 text-end">'.number_format($this->paid_amount, 0, ',', '.').'</div>
                <div class="col-6">Kembalian</div>
                <div class="col-6 text-end">'.number_format($this->paid_amount-$grandTotal, 0, ',', '.').'</div>
            </div>
        </div>
        ');

        $this->dispatch('transactionDone');
        // session()->flash('message', 'Order/Transaksi selesai');
        // $this->dispatch('closeModal');
    
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
