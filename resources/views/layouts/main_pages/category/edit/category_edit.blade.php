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

            @foreach($category_data as $category)
            <form action="{{route('category_edit', $category->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <input type="text" name="id" value="{{$category->id}}" hidden>
              <div class="form-group">
                <label><strong>Nama Kategori</strong></label>
                <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}">
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