<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Customers</title>
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
                    Master Data / <a href="{{route('master_category.index')}}">Customers</a>
                    </div>
                   
                </div>
                <div class="card-body">
                    @if($customers->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Total Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                ?>
                                @foreach ($customers as $key => $customer)
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>{{$customer->customer}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->qty_total}}</td>
                                    <td>{{"Rp." . number_format($customer->amount_total)}}</td>
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
                                    <h3>Tidak ada data customer</h3>
                                    <p class="text-secondary">Belum ada data pelanggan saat ini</p>
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