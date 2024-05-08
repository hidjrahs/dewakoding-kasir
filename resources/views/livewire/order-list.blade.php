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
                        <div class="col-3 col-md-1">
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
                        <div class="col-9 col-md-4">
                            <input type="text" wire:model.live='dateRange' class="form-control" name="daterange" placeholder="dd/mm/yyyy" id="dateRangePicker"/>
                        </div>
                        <div class="col-12 col-md-7 mt-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input wire:model.live='search' type="text" class="form-control" placeholder="Cari Pesanan"
                                    aria-label="Search" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Pesanan</th>
                                    <th scope="col">Waktu Transaksi</th>
                                    <th scope="col">Total Belanja</th>
                                    <th scope="col">Uang dibayarkan</th>
                                    <th scope="col">Uang Kembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($orders) == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @else
                                    @foreach($orders as $item)
                                    <tr>
                                    
                                        <td>{{$item->invoice_number}}</td>
                                        <td>{{$item->done_at_for_human}}</td>
                                        <td>{{$item->total_price_formatted}}</td>
                                        <td>{{$item->paid_amount_formatted}}</td>
                                        <td>{{$item->kembalian_formatted}}</td>
                                    
                                    </tr>
                                    @endforeach
                                @endif                                
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{$orders->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                    <!-- Pagination here -->
                </div>
            </div>
        </div>
    </div>
</div>
