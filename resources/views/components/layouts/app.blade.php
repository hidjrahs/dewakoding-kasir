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
    <link href="{{asset('assets/')}}" rel="stylesheet">
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

      @media only screen and (max-width: 768px) {
      
      }

      @media only screen and (max-width: 480px) {
        
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
  </style>

  </head>
  <body style="background-color: #f0f8ff">
    <div id="head-countainer" class="container mt-3">
      <a href="{{url('/pos')}}" type="button" class="navigasi btn btn-light {{ request()->is('pos*', '') || request()->is('/') ? 'active' : '' }}">POS</a>
      <a href="{{url('/product')}}" type="button" class="navigasi btn btn-light {{ request()->is('product*') ? 'active' : '' }}">Produk</a>
      <a href="{{url('/order')}}" type="button" class="navigasi btn btn-light {{ request()->is('order*') ? 'active' : '' }}">Pesanan</a>
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
