<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Turre POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="video-content">
            <video autoplay muted loop>
                <source src="{{asset('assets/front_end/assets/video/opening.mp4')}}" type="video/mp4">
            </video>
            <div class="overlay">
                <div class="text-content">
                    <h4>Selamat datang di <span style="color:#1abc8b;">Turre POS</span></h4>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div style="height: 150px;" class="carousel-inner">
                              <div class="carousel-item active">
                                <p style="font-size: 17px; color:rgb(247, 247, 247);">Nikmati pengalaman dengan menggunakan sistem kami untuk <br> memudahkan transaksi bisnis anda.</p>
                              </div>
                              <div class="carousel-item">
                                <p style="font-size: 17px; color:rgb(247, 247, 247);">Turre POS saat ini sudah terintegrasi dengan Payment Gateway untuk memudahkan transaksi bisnis anda.</p>
                              </div>
                              <div class="carousel-item">
                                <p style="font-size: 17px; color:rgb(247, 247, 247);">Turre POS memberikan kemudahan untuk anda mencoba versi Trial 7 Hari gratis</p>
                              </div>
                            </div>
                            
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          
                    </div>
                    
                    <br>
                    <div style="display:flex; gap:20px;align-items:center;" class="btn-login-intro">
                        <a href="{{route('register')}}" class="btn-login">Daftar akun sekarang</a>
                        <a href="{{route('login')}}" style="color: white;text-decoration:underline;" href="">Lewati</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<style>

@import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');
  
  body{
      font-family: "DM Sans", serif;
    padding: 0;
    margin: 0;
}

.container {
    position: relative;
    width: 100%;
    height: 100vh; /* Kontainer mengambil seluruh tinggi layar */
    overflow: hidden;
}

.video-content {
    position: relative;
    width: 100%;
    height: 100%;
}

video {
    width: 100%;
    height: 100%;
    object-fit: contain; /* Memastikan video menutupi seluruh kontainer tanpa terdistorsi */
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; /* Latar belakang hitam semi-transparan */
    display: flex;
    justify-content: center;
    align-items: center; /* Memastikan teks berada di tengah */
    color: white;
    z-index: 1; /* Menempatkan overlay di atas video */
}
.btn-login {
    background: #1abc8b;
    color: white;
    padding: 10px;
    border:none;
    border-radius: 6px;
    text-decoration: none;
}

a:hover{
    text-decoration: none;
    color: white;
}

.text-content {
    
    background: rgba(0, 0, 0, 0.356);
    padding: 30px;
    border-radius: 10px;
    width: 35%;
}

h4 {
    font-size: 2rem;
    margin-bottom: 20px;
}

p {
    font-size: 1.2rem;
    line-height: 1.5;
}




@media(max-width: 560px){

    .text-content{
        width: 90%;
    }


}
</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
