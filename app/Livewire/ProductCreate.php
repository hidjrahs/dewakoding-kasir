<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use Intervention\Image\Facades\Image;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $cost_price;
    public $selling_price;
    public $stock;
    public $image;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'stock' => 'required|numeric|min:1',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image' => 'max:2048'
        ], [
            'name.required' => 'Nama produk harus diisi.',
            'stock.required' => 'Stok produk harus diisi.',
            'stock.numeric' => 'Stok produk harus berupa angka.',
            'stock.min' => 'Stok produk harus di atas 0.',
            'cost_price.required' => 'Harga modal harus diisi.',
            'cost_price.numeric' => 'Harga modal harus berupa angka.',
            'selling_price.required' => 'Harga jual harus diisi.',
            'selling_price.numeric' => 'Harga jual harus berupa angka.',
            'image.max' => 'Gambar maksimal 2MB.',

        ]);

        $this->image->storeAs('public/product', $this->image->hashName());
        // $image = $this->image;
        // $imageName = $image->hashName();
        // $imagePath = storage_path('app/public/product/' . $imageName);

        // // Mengompres gambar dengan lebar maksimum 1200px dan tinggi maksimum 1200px
        // Image::make($image->getRealPath())
        // ->resize(1000, null, function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // })
        // ->save($imagePath);

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'cost_price' => $this->cost_price,
            'selling_price' => $this->selling_price,
            'image' => $this->image->hashName(),
            'stock' => $this->stock
        ]);

       
        session()->flash('message', 'Data Berhasil Disimpan.');

        return redirect()->route('product');

    }
    public function render()
    {
        return view('livewire.product-create');
    }
}
