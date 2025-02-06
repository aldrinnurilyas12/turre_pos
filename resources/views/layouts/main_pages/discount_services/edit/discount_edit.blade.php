<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turre POS - Ubah Kategori</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="sb-nav-fixed"> 
  @include('layouts.component_admin.navbar.navbar')
  @include('layouts.component_admin.sidebar.sidebar')
  <div id="layoutSidenav">
  <div id="layoutSidenav_content">
      <main>
        <br>
          <div class="container-fluid px-4">
            <h4>Ubah Data Kategori</h4>
            <hr>

            @foreach($discounts as $discount)
            <form action="{{route('edit_discount', $discount->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

                <input type="text" name="id" value="{{$discount->id}}" hidden>
                <div class="form-group">
                  <label><strong>Nama Diskon</strong></label>
                  <input type="text" name="discount_name" class="form-control" value="{{$discount->discount_name}}" autocomplete="off">
                </div>

                <div class="form-group">
                  <label><strong>Kode Diskon</strong></label>
                  <input type="text" name="discount_code" class="form-control" value="{{$discount->discount_code}}" autocomplete="off">
                </div>

                <div class="form-group">
                  <label><strong>Jumlah Diskon (%)</strong></label>
                  <input type="text" name="discount_total" class="form-control" value="{{$discount->discount_total}}" autocomplete="off">
                </div>

                <div class="form-group">
                  <label><strong>Tanggal awal discount</strong></label>
                  <input type="date" name="start_date" class="form-control" autocomplete="off">
                </div>

                <div class="form-group">
                  <label><strong>Tanggal akhir discount</strong></label>
                  <input type="date" name="end_date" class="form-control" autocomplete="off">
                </div>

              <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
            @endforeach
          </div>
      </main>
    </body>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');
    
        body{
            font-family: "DM Sans", serif;
        }
    </style>
</html>