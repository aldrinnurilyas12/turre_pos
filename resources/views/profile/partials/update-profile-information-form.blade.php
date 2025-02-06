<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turre POS - Informasi Profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="sb-nav-fixed"> 
  @include('layouts.component_admin.navbar.navbar')
  @include('layouts.component_admin.sidebar.sidebar')
  <div id="layoutSidenav">
  <div id="layoutSidenav_content">
      <main>
        <br>
        <section class="introduction-profil">
            @foreach($users as $user)

            <div class="container-content">
                <div class="img-content">
                  @if($user->shop_logo)
                    <img width="200" height="200" src="{{asset('storage/' . $user->shop_logo)}}" alt="">
                  @else
                  <img width="200" height="200" src="{{asset('assets/front_end/assets/img/empty.png')}}" alt="">
                  @endif
                </div>
    
                <div class="container-information">
                  <div class="content-profil">
                      <h4>{{$user->shop_name}}</h4>
                      <p class="text-secondary">{{$user->email}}</p>
                  </div>

                  <div style="display: flex;flex-wrap:wrap; gap:20px;" class="statistic-info">
                    <div class="item-content">
                      <label style="text-align: center;" for="">
                        Item
                        @if($products_total)
                        <p>{{$products_total}}</p>
                        @else
                        <p>-</p>
                        @endif
                      </label>
                    </div>

                    <div class="transaction-content">
                      <label style="text-align: center;" for="">
                        Transaksi
                        @if($transaction_total)
                        <p>{{$transaction_total}}</p>
                        @else
                        <p>-</p>
                        @endif
                      </label>
                    </div>

                    <div class="customer-content">
                      <label style="text-align: center;" for="">
                        Customers
                        @if($customers)
                        <p>{{$customers}}</p>
                        @else
                        <p>-</p>
                        @endif
                      </label>
                    </div>
                  </div>

                </div>
            </div>
            
           
            @endforeach
        </section>

      

        <br>
        <section class="update-profil">
          <div class="container-fluid px-4">
            <h4><strong>Profil Pengguna</strong></h4>
            <hr>

            @foreach($users as $user)
            <form method="POST" action="{{ route('profile_update', $user->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              
              <div class="form-group">
                  <label><strong>Nama Toko</strong></label>
                  <input type="text" name="shop_name" class="form-control" value="{{$user->shop_name}}">
                  @if ($errors->has('shop_name'))
                  <span class="text-danger">{{ $errors->first('shop_name') }}</span>
              @endif
              </div>

              <div class="form-group">
                <label><strong>Nama Pemilik Toko</strong></label>
                <input type="text" name="owner_name" class="form-control" value="{{$user->owner_name}}">
              </div>

              <div class="form-group">
                <label><strong>Username</strong></label>
                <input type="text" name="username" class="form-control" value="{{$user->username}}">
                @if ($errors->has('username'))
                <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label><strong>Email</strong></label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}">
              </div>

              @if($user->shop_logo)
              <div class="form-group">
                <label><strong>Gambar/Logo Toko</strong></label>
                <input type="file" name="shop_logo" class="form-control">
              </div>
              @else
              <div class="form-group">
                <label><strong>Gambar/Logo Toko</strong></label>
                <input type="file" name="shop_logo" class="form-control">
                <span class="text-danger">*anda belum upload logo toko</span>
              </div>
              @endif
              
              <div class="form-group">
                <label><strong>Tanggal buat akun</strong></label>
                <input type="text" class="form-control" value="{{$user->created_at}}" readonly>
              </div>
             
              
              <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
            @endforeach
            <br>
            <br>
          </div>
        </section>
      </main>
    </body>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');
  
      body{
          font-family: "DM Sans", serif;
      }

      .container-content {
        width: 100%;
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
        gap:20px;

      }

      .container-information{
        display: block;
        padding-top: 40px;
      }
      .content-profil {
        align-content: center;

      }

      .img-content{
        box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;
      }

      .content-profil h4 {
        font-weight: bold;
      }

      .content-profil p {
        font-size: 14px;
      }
  </style>

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
</html>
