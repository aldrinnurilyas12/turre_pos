<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Discount</title>
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
                    Master Data / <a href="{{route('master_category.index')}}">Discount</a>
                    </div>
                    @if($discounts->isNotEmpty())
                    <div class="button-add-product">
                        <a class="btn btn-primary" href="{{route('discount_create')}}">Tambah Discount</a>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    @if($discounts->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama Discount</th>
                                    <th>Kode Discount</th>
                                    <th>Total Discount</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
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
                                @foreach ($discounts as $key => $discount)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <div style="display: flex;gap:10px;" class="btn-action">
                                            <a class="btn btn-primary" href="{{route('update_discount', $discount->id)}}">Edit</a>
                                            <div class="delete-action">
                                                <form action="{{route('discount.destroy', $discount->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        
                                        </div>
                                    </td>
                                    <td>{{$discount->discount_name}}</td>
                                    <td>{{$discount->discount_code}}</td>
                                    <td>{{$discount->discount_total}}</td>
                                    <td>{{$discount->start_date}}</td>
                                    <td>{{$discount->end_date}}</td>
                                    <td>{{$discount->created_at}}</td>
                                    <td>{{$discount->created_by}}</td>
                                    <td>{{$discount->updated_at}}</td>
                                    <td>{{$discount->updated_by}}</td>
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
                                    <h3>Belum ada data discount</h3>
                                    <p class="text-secondary">Tambah data discount </p>
                                    <a class="btn btn-primary" href="{{'discount_create'}}">Tambah discount</a>
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