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

            @foreach($products as $product)
            <form action="{{route('edit_product', $product->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label><strong>Nama Toko</strong></label>
                <input type="text" class="form-control" readonly value="{{app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name}}">
            </div>
              <hr>
              <div class="form-group">
                  <label><strong>Nama Item</strong></label>
                  <input type="text" name="product_name" class="form-control" value="{{$product->product_name}}">
              </div>

              <div class="form-group">
                <label><strong>Kategori Item</strong></label>
               <select class="form-control" name="category_id" id="">
                {{-- <option value="">==== Pilih Kategori Item ====</option> --}}
                  @foreach ($product_category as $item)
                      <option value="{{$item->id}}" {{$item->category_name == $product->category_name ? 'selected' : '' }}>{{$item->category_name}}</option>
                  @endforeach
               </select>
              </div>
              <div class="form-group">
                <label><strong>Harga Item</strong></label>
                <input type="text" inputmode="numeric" name="price" class="form-control" value="{{$product->price}}">
              </div>

              <div class="form-group">
                <label><strong>Stok Item</strong></label>
                <input type="text" inputmode="numeric" name="stock" class="form-control" value="{{$product->stock}}">
              </div>
              <div class="form-group">
                <label><strong>Berat Item (optional)</strong></label>
                <input type="text" inputmode="numeric" name="product_weight" class="form-control" value="{{$product->product_weight}}">
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
                @if ($errors->has('product_type'))
                        <span class="text-danger">{{ $errors->first('product_type') }}</span>
                        @endif
                </div>

              <div class="form-group">
                <label><strong>Ukuran Item (optional)</strong></label>
                <input type="text" inputmode="numeric" name="product_size" class="form-control" value="{{$product->product_size}}">
              </div>

              <div class="form-group">
                <label><strong>Warna Item (optional)</strong></label>
                <input type="text" name="color" class="form-control" value="{{$product->color}}">
              </div>


              @if($product->images)

              <img width="100" height="100" src="{{asset('storage/' . $product->images)}}" alt="">
              <br>
              <br>
              <div class="form-group">
                <label><strong>Ganti gambar Item</strong></label>
                <input type="file" name="images" class="form-control">
              </div>
              @else
              <div class="form-group">
                <label><strong>Gambar/Foto Item (optional)</strong></label>
                <input type="file" name="images" class="form-control">
              </div>
              @endif
              
             <br>
              
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