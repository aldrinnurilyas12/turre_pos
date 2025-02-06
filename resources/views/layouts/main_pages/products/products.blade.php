<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turre POS - Item</title>
    <link href="{{asset('assets/front_end/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/front_end/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/front_end/assets/vendor/jquery/jquery.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="sb-nav-fixed"> 
    @include('layouts.component_admin.navbar.navbar')
    @include('layouts.component_admin.sidebar.sidebar')
    <div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <br>
            <div class="card mb-4">
                <div style="display: flex; justify-content:space-between;" class="card-header">
                    
                    <div class="title">
                    Master Data / <a href="{{route('master_products.index')}}">Item</a>
                    </div>

                    @if($products->isNotEmpty())
                    <div class="button-add-product">
                        <a class="btn btn-primary" href="{{route('product_create')}}">Tambah Item</a>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    @if($products->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Gambar</th>
                                    <th>Item</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Berat</th>
                                    <th>Tipe</th>
                                    <th>Warna</th>
                                    <th>Size</th>
                                    <th>Created at</th>
                                    <th>Created by</th>
                                    <th>Updated at</th>
                                    <th>Updated by</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                ?>
                                @foreach ($products as $product)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <div style="display: flex;gap:10px;" class="btn-action">
                                            <a class="btn btn-primary" href="{{route('product_update', $product->id)}}">Edit</a>
                                            <div class="delete-action">
                                                <form action="{{route('master_products.destroy', $product->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        
                                        </div>
                                    </td>
                                    <td>
                                        @if($product->images)
                                        <img width="100" height="100" src="{{'storage/' . $product->images}}" alt="">
                                        @else
                                        <p>Tidak ada gambar</p>
                                        @endif</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->category_name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->product_weight}}</td>
                                    <td>{{$product->product_type}}</td>
                                    <td>{{$product->color}}</td>
                                    <td>{{$product->product_size}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>{{$product->created_by}}</td>
                                    <td>{{$product->updated_at}}</td>
                                    <td>{{$product->updated_by}}</td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div style="height: 50vh; display:flex; justify-content:center; border:1px solid gray;border-radius:10px;" class="empty-transaction">
                        
                        <div style="display: flex;" class="empty-content">
                            <div style="display: flex; gap:20px;margin:auto;" class="alert-info">
                                <img width="70" height="70" src="{{ asset('assets/front_end/assets/img/null.png')}}" alt="">
                                <div style="display: block;" class="text-content">
                                    <h3>Belum ada item</h3>
                                    <p class="text-secondary">Tambah data produk anda</p>
                                    <a class="btn btn-primary" href="{{'product_create'}}">Tambah Item</a>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    @endif
                </div>
            </div>
            </div>
        </main>
    </div>
    </div>

<script src="{{ asset('assets/front_end/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/front_end/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/front_end/js/js/demo/datatables-demo.js')}}"></script>

</body>

@if (Session::has('message_success'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: "{{ Session::get('message_success') }}",
        icon: 'success',
        timer:2000,
        confirmButtonText: 'OK'
    });
</script>
    
@endif

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

    body{
        font-family: "DM Sans", serif;
    }
</style>

</html>