<link href="{{asset('assets/front_end/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/front_end/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/front_end/assets/vendor/jquery/jquery.js')}}"></script>
    <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<div class="card">
    <div class="card-body">
      <div class="container mb-5 mt-3">
        <div class="row d-flex align-items-baseline">
          <div class="col-xl-9">
            <p style="color: #7e8d9f;font-size: 20px;">Invoice : <strong>{{$invoice->first()->invoice}}</strong></p>
          </div>
          <hr>
        </div>
  
        <div class="container">
          <div class="col-md-12">
            <div class="text-center">
              <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
              <p style="font-weight: bold;font-size:25px;" class="pt-0">{{app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name}}</p>
            </div>
  
          </div>
  
  
          <div class="row">
            <div class="col-xl-8">
              <ul class="list-unstyled">
                <li class="text-muted"><span
                    class="fw-bold">Customer :</span> <span style="color:#000000 ;">{{$invoice->first()->customer}}</span></li>
                <li class="text-muted"><span
                    class="fw-bold">Email : </span> <span>{{$invoice->first()->email}}</span></li>
              </ul>
            </div>
            <div class="col-xl-4">
              <ul class="list-unstyled">
                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                    class="fw-bold">Tanggal Transaksi: </span>{{$invoice->first()->created_at}}</li>
                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                    Sukses</span></li>
              </ul>
            </div>
          </div>
  
          <div class="row my-2 mx-1 justify-content-center">
            <table class="table table-striped table-borderless">
              <thead style="background-color:#84B0CA ;" class="text-white">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Items</th>
                  <th scope="col">Banyak</th>
                  <th scope="col">Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $no = 1;
                    ?>
                @foreach($invoice as $inv)
                    <tr>
                        <td>
                        <?php echo $no ++ ?>
                        </td>
                        <td>{{$inv->product_name}}</td>
                        <td>{{{$inv->quantity_per_product}}}</td>
                        <td>{{$inv->price}}</td>
                        
                    </tr>
                @endforeach
              </tbody>
  
            </table>
          </div>
          <div class="row">
            <div class="col-xl-8">
            </div>
            <div class="col-xl-3">
              <ul style="color: black;" class="list-unstyled">
                <li class="text-muted ms-3"><span class="text-black me-4">Qty:</span> <br>{{$invoice->first()->quantity}} Item</li>
                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal:</span> <br>{{"Rp." . number_format($invoice->first()->total)}}</li>
                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Pay Method:</span>
                    <br>
                    @if($invoice->first()->payment_method)
                    {{$invoice->first()->payment_method}}</li>
                    @else
                    <p>-</p>
                    @endif
              </ul>
              <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                  style="font-size: 25px; font-weight:bold;"><br>
                  <td>{{"Rp." . number_format($invoice->first()->total)}}</td></span></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xl-10">
              <p>Thank you for your purchase</p>
            </div>
            <div class="col-xl-2">
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary text-capitalize"
                style="background-color:#1abc8b; border:none;">Download Invoice</button>
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </div>