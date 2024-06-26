<div class="row">
    <div class="col-lg-8 col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-auto">
                    <div class="input-group">
                        <button onclick="hideContent()" style="background:transparent;border:none;margin-right:25px;font-size:20px;" class="hide-content d-block d-sm-block d-md-block d-lg-none d-xl-none d-xxl-none">
                            <i class="bi bi-eye"></i>
                        </button>
                        <span class="input-group-text" style="background: white;border-right: none;border-top-left-radius: 15px;border-bottom-left-radius: 15px;"><i class="bi bi-search"></i></span>
                        <input style="height:50px;border-left: none;border-top-right-radius: 15px;border-bottom-right-radius: 15px;font-size:18px;" wire:model.live='search' type="text" class="form-control"
                            id="autoSizingInputGroup" placeholder="Cari Nama Atau Kode Produk">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3" id="product-area">
            @if(count($products) > 0)
                @foreach ($products as $item)
                    <div wire:click="updateCart('{{ $item->id }}')" class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6 mt-3">
                        <div class="card card-name h-100xx">
                            <div class="image-container">
                                <img src="{{ Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset('/storage/product/' . $item->image) }}"
                                class="card-img-top" alt="...">  
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{{ $item->selling_price_formatted }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 mt-4">
                    <div class="alert alert-danger" role="alert">
                        Produk masih kosong, harap gunakan kata kunci lain
                    </div>
                </div>
            @endif

        </div>
        <div class="row mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <div class="col-lg-4 col-12 cart-area">

        <div class="card order-area">

            <div class="card-header text-center">
                @if ($order)
                    <b>Order Code : {{ $order->invoice_number }}</b>
                @else
                    <b>Aplikasi Kasir</b>
                @endif
            </div>


            <div id="area-checkout" class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success text-center">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('warning'))
                    <div class="alert alert-warning text-center">
                        {{ session('warning') }}
                    </div>
                @endif
                @if (count($order->orderProducts) > 0)
                    @foreach ($order->orderProducts as $item)
                        <div class="card mt-2">
                            <div class="d-flex justify-content-betweenx align-items-center">

                                <img src="{{ Str::startsWith($item->product->image, ['http://', 'https://']) ? $item->product->image : asset('/storage/product/' . $item->product->image) }}"
                                    style="width: 80px;height: 80px;margin-right:10px;" />
                                <div class="p-name">
                                    <b>{{ $item->product->name }}</b><br>
                                    {{ $item->product->selling_price_formatted }}
                                </div>
                                <div class="atur-qty">
                                    <button class="btn btn-sm btn-warning me-2"
                                        wire:click="updateCart('{{ $item->product->id }}', false)">-</button>
                                    <span>{{ $item->quantity }}</span>
                                    <button class="btn btn-sm btn-primary ms-2"
                                        wire:click="updateCart('{{ $item->product->id }}')">+</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center p-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" fill="#d3d3d3" class="bi bi-bag-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                        </svg>
                        <p style="color:#959595">Silahkan pilih produk</p>
                    </div>
                @endif
            </div>
            @if($order)
                <div class="card-footer p-0">
                    <button type="button" class="btn btn-primary btn-checkout" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Bayar @if ($total_price != 0) Rp {{  number_format($total_price, 0, ',', '.') }} @endif
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="myForm" class="row g-3" wire:submit.prevent="done" enctype="multipart/form-data">
                <div class="modal-body">
                    @if (session()->has('struk'))
                        {!! session()->get('struk')!!}
                    @else
                        @if (session()->has('payment'))
                            <div class="alert alert-warning text-center">
                                {{ session('payment') }}
                            </div>
                        @endif
                        @error('paid_amount')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="col-md-12x">
                            <label for="paid_amount" class="form-label">Uang yang dibayarkan</label>
                            <input type="number" style="height:50px;" class="form-control" id="paid_amount" name="paid_amount" wire:model="paid_amount">
                        </div>
                    @endif
                </div>
                @if (!session()->has('struk'))
                    <div class="btn-group" style="height:60px;" role="group" aria-label="Basic example">
                        <button type="button" style="border-radius: 0;background-color: #838383;color: white;width: 50%;" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                        <button type="submit" style="border-radius:0;width:50%;" class="btn btn-primary">Selesai</button>
                    </div>
                @else
                    <div class="btn-group" style="height:60px;" role="group" aria-label="Basic example">
                        <button type="button" style="border-radius:0;" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Selesai</button>
                    </div>
                @endif
            </form>
          </div>
        </div>
    </div>
</div>
