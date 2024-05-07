<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dewakoding Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter&display=swap"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;1,200&display=swap">
    <style>
      body {
          font-family: 'Inter', sans-serif;
      }
      #head-countainer .navigasi{
        background-color:transparent;
        /* font-size:18px; */
        font-weight:bold;
        padding: 8px 25px;
        border-radius:20px;
      }
      #head-countainer .active{ 
        background-color: #0d6efd !important;
        color: white !important;
        border-color: transparent !important;
      }
      #product-area{
        width:auto;
        height: 450px;
        overflow: auto;
        box-shadow: 0px 7px 20px 0px #bfbfbf;
        margin-right: 0;
        margin-left: 0;
        scrollbar-width:thin;
      }
    
      .order-area{
        height:95%;
        box-shadow: 0px 7px 20px 0px #bfbfbf;
        border:none;
      }
      .atur-qty{
        position:absolute;
        right:10px;
      }

      @media only screen and (max-width: 1024px) {
        #area-checkout {
          height: 200px !important;
        }
        .cart-area {
          margin-bottom: 100px;
        }
      }

      @media only screen and (max-width: 768px) {
        .p-name{
          width: 140px !important;
        }
        .justify-content-betweenx{
          font-size:14px;
        }
        .justify-content-betweenx img{
          width: 40px !important;
          height: 40px !important;
        }
        .atur-qty{
          position:absolute;
          right:10px;
        }
        .cart-area{
          margin-bottom:100px;
        }
        #area-checkout{
          height: 200px !important;
        }
      }

      @media only screen and (max-width: 480px) {
          .cart-area{
            margin-bottom:100px;
          }
          #area-checkout{
            height: 200px !important;
          }
      }
      .card-title{
        font-size: 14px;
        text-transform: capitalize;
        font-weight: bold;
        overflow: hidden;
        height:35px;
        /* text-overflow: ellipsis;
        white-space: nowrap; */
      }
      .card-name{
        height:202px;
        border-radius: 15px;
      }
      .card-text{
        font-size:14px;
      }
      .card-body{
        padding:5px 10px;
      }
      .btn-checkout{
        border-radius: unset;
        width: 100%;
        padding: 18px;
        font-weight: 600;
        font-size: 16px;
      }
      #area-checkout{
        width: auto;
        height: 0;
        overflow: auto;
        box-shadow: 0px 7px 20px 0px #bfbfbf;
        margin-right: 0;
        margin-left: 0;
        scrollbar-width:thin;
      }
      .card-img, .card-img-top{
        border-radius: 15px;
      }
      .footer-menu{
        z-index: 99999;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        background: #0057d8;
      }
      .footer-menu a{
        padding:10px;
        background-color:transparent;
        border:none;
        color:white;
        border-radius:0;
      }
      .footer-menu .active{
        background-color:white !important;
        font-weight:bold;
      }
      .image-container{
        width:100%;
        height: 120px;
        overflow: hidden;
      }
      .image-container img {
        display: block;
        width: 100%;
        height: auto;
      }
      .p-name{
        width: 160px;
      }
  </style>
  </head>
  <body style="background-color: #f0f8ff">
    <div id="head-countainer" class="container mt-3">
      <div class="w-100">
        <h4>
          <img style="width:40px;height:auto;border-radius: 50%;" src="{{asset('/storage/297173094_558454366067736_6338111394004660904_n.jpg')}}">
          <b>Galeri Taton</b>
        </h4> 
      </div>
      {{ $slot }}
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <div class="footer-menu">
      <a href="{{url('/pos')}}" type="button" class="navigasi btn btn-light {{ request()->is('pos*', '') || request()->is('/') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
          <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
        </svg>
        POS
      </a>
      <a href="{{url('/product')}}" type="button" class="navigasi btn btn-light {{ request()->is('product*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-1x2" viewBox="0 0 16 16">
          <path d="M6 1H1v14h5zm9 0h-5v5h5zm0 9v5h-5v-5zM0 1a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm9 0a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1zm1 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1z"/>
        </svg>
        Produk
      </a>
      <a href="{{url('/order')}}" type="button" class="navigasi btn btn-light {{ request()->is('order*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
        </svg>  
        Pesanan
      </a>
    </div>
    <script>
      document.addEventListener('livewire:init', function() {
        Livewire.on('openModal', function () {
          $('.modal-backdrop').remove();
          var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
          modal.show();
        });
        Livewire.on('closeModal', function () {
          $('.modal-backdrop').remove();
          var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
          modal.hide();
        });
      });
      // document.addEventListener('livewire:load', function() {
        function confirmDelete(itemId) {
          if (confirm('Yakin menghapus produk ini ?')) {
              Livewire.dispatch('destroy', { id: itemId});
          }
        }
      // });
      function hideContent(){
        if($("#product-area").hasClass('d-none')){
          $("#product-area").removeClass('d-none');
          $(".hide-content").html('<i class="bi bi-eye-slash"></i>');
        }else{
          $("#product-area").addClass('d-none');
          $(".hide-content").html('<i class="bi bi-eye"></i>');
        }
      }
    </script>
  </body>
</html>
