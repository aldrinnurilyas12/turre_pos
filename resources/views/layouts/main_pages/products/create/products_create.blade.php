<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turre POS - Tambah Item</title>
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
            <h4>Tambah Data Item</h4>
            <hr>
            <form action="{{route('master_products.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label><strong>Nama Toko</strong></label>
                <input type="text" class="form-control" readonly value="{{app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name}}">
            </div>
              <hr>
              <div class="form-group">
                  <label><strong>Nama Item</strong></label>
                  <input type="text" name="product_name" class="form-control" value="{{old('product_name')}}" placeholder="Masukan nama Item" autocomplete="off">
              </div>

              <div class="form-group">
                <label><strong>Kategori Item</strong></label>
                @if($product_category->isNotEmpty())
               <select class="form-control" name="category_id" id="">
                <option value="">==== Pilih Kategori Item ====</option>
                  @foreach ($product_category as $item)
                      <option value="{{$item->id}}">{{$item->category_name}}</option>
                  @endforeach
               </select>
               @else
               <p class="text-secondary">Anda belum buat data Kategori, <a href="{{route('category_create')}}">Buat kategori</a> </p>
              @endif
              </div>
              <div class="form-group">
                <label><strong>Harga Item</strong></label>
                <input type="text" inputmode="numeric" name="price" class="form-control" value="{{old('price')}}" placeholder="Masukan harga Item" autocomplete="off">
              </div>

              <div class="form-group">
                <label><strong>Stok Item</strong></label>
                <input type="text" inputmode="numeric" name="stock" class="form-control" value="{{old('stock')}}" value="{{old('stock')}}" placeholder="Masukan stok Item" autocomplete="off">
              </div>
              <div class="form-group">
                <label><strong>Berat Item (optional)</strong></label>
                <input type="text" inputmode="numeric" name="product_weight" class="form-control" value="{{old('product_weight')}}" placeholder="Masukan berat Item (optional)" autocomplete="off">
              </div>
              <div class="form-group">
                <label><strong>Tipe Item (optional)</strong></label>
                <select name="product_type" class="form-control" id="">
                  <option value="">=== Pilih Tipe Item ===</option>
                  <option value="PCS">Pcs</option>
                  <option value="KG">Kilogram</option>
                  <option value="GR">Gram</option>
                  <option value="Lusin">Lusin</option>
                  <option value="Dus">Dus</option>
                </select>
                </div>

              <div class="form-group">
                <label><strong>Ukuran Item (optional)</strong></label>
                <input type="text" inputmode="numeric" name="product_size" class="form-control" value="{{old('product_size')}}" placeholder="Masukan ukuran Item" autocomplete="off">
              </div>

              <div class="form-group">
                <label><strong>Warna Item (optional)</strong></label>
                <input type="text" name="color" class="form-control" value="{{old('color')}}" placeholder="Masukan warna Item" autocomplete="off">
              </div>

              <div class="form-group">
                <label><strong>Gambar/Foto Item (optional)</strong></label>
                <input type="file" name="images" class="form-control">
              </div>
              
             
              
              <button type="submit" class="btn btn-primary">Tambah Item</button>
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