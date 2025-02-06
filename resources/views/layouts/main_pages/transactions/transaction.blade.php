<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>
    <link href="{{asset('assets/front_end/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/front_end/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/front_end/assets/vendor/jquery/jquery.js')}}"></script>
    <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
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
                    Transaksi / <a href="{{route('transaction.index')}}">Transaksi</a>
                    </div>

                    @if($show_transaction_array_data->isNotEmpty())
                    <div class="button-add-product">
                        <a class="btn btn-primary" href="{{route('transaction_create')}}">Tambah Transaksi</a>
                    </div>
                    @endif
                   
                </div>
                <div class="card-body">

                    @if($show_transaction_array_data->isNotEmpty())
                        @foreach($show_transaction_array_data as $transaction)
                        <div class="card-header">
                            <h5>#Invoice : {{$transaction->invoice}}</h5>
                        </div>
                        <div class="container-transaction">

                            <div class="container-orders">
                                <div style="align-content: center;" class="img-icon">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
        
                                <div class="detail-orders">
                                    <div style="display: flex; gap:20px;align-items:baseline;" class="total-date-orders">
                                        <p style="width:max-content;margin-bottom: 10px; color:blue;font-weight:bold;margin-bottom: 0;">Rp.{{number_format($transaction->total)}}</p>
                                        <p style="color: gray;margin-bottom: 0; font-size:13px;">{{\Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y h:i')}}</p>
                                    </div>
                                    <div style="display: flex;gap:10px;padding:0;" class="content-products">
                                        <p style="margin-bottom: 0;"> {{ implode(', ', $transaction->product_name) }}</p>
                                    </div>
                                </div>

                            </div>
                        
                        </div>
                        <div style="display:flex;justify-content:center;margin-bottom:30px;" class="detail-order">
                            <a class="btn btn-primary" href="{{route('invoice_detail', $transaction->id)}}">Detail</a>
                        </div>
                        <hr>
                        @endforeach
                    @else
                    <div style="height: 50vh; display:flex; justify-content:center; border:1px solid gray;border-radius:10px;" class="empty-transaction">
                        
                        <div style="display: flex;" class="empty-content">
                            <div style="display: flex; gap:20px;margin:auto;" class="alert-info">
                                <img width="70" height="70" src="{{ asset('assets/front_end/assets/img/null.png')}}" alt="">
                                <div style="display: block;" class="text-content">
                                    <h3>Belum ada transaksi</h3>
                                    <p class="text-secondary">Buat transaksi pertama anda</p>
                                    <a class="btn btn-primary" href="{{'transaction_create'}}">Buat Transaksi</a>
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



    {{-- modal show detail --}}
    {{-- @foreach($transaction_data as $transaction) 
    <div  class="modal fade" id="showDetail{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$transaction->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="position: sticky;" class="modal-header">
                    <h5 style="font-size: 13px;width:500px;" class="modal-title" id="exampleModalLabel{{$transaction->id}}">Invoice #{{$transaction->invoice}}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div style="overflow-y: scroll;height:300px;" class="container-content">
                    
                    <div style="padding: 20px; display:flex;flex-wrap:wrap; gap:20px;font-size:13px;" class="content-card">
                        <div class="img-content">
                            <img width="60" height="60" src="{{asset('storage/' . $transaction->images)}}" alt="">
                        </div>

                        <div class="transaction-data">
                            <h5 style="font-size: 14px;">{{$transaction->product_name}}</h5>
                            <p>x{{$transaction->quantity}}</p>
                        </div>
                    </div>
                    <hr>

                    
                </div>
                    <div style="display: flex; flex-wrap:wrap; justify-content:space-between;padding:10px;position:sticky;" class="total-transaction">
                        <h5 style="font-size: 15px;"><strong>Total</strong></h5>

                        <p>{{"Rp.".number_format($transaction->total)}}</p>
                    </div>
                

               
            </div>
        </div>
    </div>

  
    
    @endforeach --}}

<script src="{{ asset('assets/front_end/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/front_end/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/front_end/js/js/demo/datatables-demo.js')}}"></script>
<script src="{{ asset('bootstrap/js/js/bootstrap.bundle.min.js')}}"></script>
{{-- <script src="{{ asset('bootstrap/js/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('bootstrap/js/js/bootstrap.min.js')}}"></script> --}}

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

    .container-transaction{
        display: flex;
        gap:20px;
        justify-content: space-between;
        padding: 20px;
    }

    .container-orders{
        display: flex;
        gap: 20px;
    }
</style>

</html>