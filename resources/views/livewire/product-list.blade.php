<div class="mt-4">
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="margin-bottom:100px;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12 mt-3">
                            <a href="{{url('product/create')}}" style="" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
                        </div>
                        <div class="col-md-2">
                            <select 
                                wire:model.live='perPage' 
                                class="form-select">
                                <option value="">Jumlah Halaman</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-md-10 mt-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input wire:model.live='search' type="text" class="form-control" placeholder="Cari Produk"
                                    aria-label="Search" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Harga Modal</th>
                                    <th scope="col">Harga Jual</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $item)
                                <tr>
                                    <td>
                                        <img src="{{$item->image_url}}" style="width: 80px;height: 80px" />
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->stock}}</td>
                                    <td>{{$item->cost_price}}</td>
                                    <td>{{$item->selling_price}}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <a href="{{url('product/edit', ['id' => $item->id])}} " class="btn btn-warning" wire:navigate>Edit</a>
                                        <!-- <button wire:click="destroy('{{ $item->id }}')" class="btn btn-danger" onclick="return confirm('Yakin menghapus produk ini ?')">Delete</button> -->
                                        <button class="btn btn-danger" onclick="confirmDelete('{{ $item->id }}')">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Data rows here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{$products->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                    <!-- Pagination here -->
                </div>
            </div>
        </div>
    </div>
</div>
