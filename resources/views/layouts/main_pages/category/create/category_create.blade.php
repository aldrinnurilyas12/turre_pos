<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turre POS - Tambah Produk</title>
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
            <h4>Tambah Data Kategori</h4>
            <hr>
            <form action="{{route('master_category.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label><strong>Nama Kategori</strong></label>
                  <input type="text" name="category_name" class="form-control" value="{{old('category_name')}}" placeholder="Masukan nama produk" id="inputEmail4" autocomplete="off">
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            <br>
            <br>
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