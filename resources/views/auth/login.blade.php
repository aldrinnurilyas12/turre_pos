<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Turre POS</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="form-input">

        <div class="content-grettings">
            <div class="logo-content-turre">
                <img height="90" width="90" src="{{asset('assets/front_end/assets/img/logo.png')}}" alt="">
            </div>
            <h1 style="margin-top:0;">Welcome to <span style=" color: #1abc8b;">Turre POS</span></h1>
            <p class="title-content">Gunakan Turre POS untuk kebutuhan bisnis Anda. <br>
                Mulai dari manajemen inventaris yang efisien, pencatatan transaksi yang akurat, 
                hingga laporan keuangan yang mudah dipantau, sehingga bisnis Anda dapat berjalan lebih lancar dan terorganisir.</p>
            <br>
            <a class="link-href" href="">Dapatkan informasi lainnya</a>
        </div>
        
        <div class="form-group">
            <div class="logo-turre">
                <h2>Login Turre POS</h2>
            </div>


            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="">Masukan Email atau Nama Pengguna</label>
                    <input class="form-input-text" type="text" value="{{old('login')}}" name="login" placeholder="Masukan Email Anda atau username" autocomplete="off">
                    @if ($errors->get('login'))
                    <div class="alert alert-warning">
                        <x-input-error :messages="$errors->get('login')"/>
                    </div>
                    @endif     
                </div>

                <div class="input-group">
                    <label for="">Masukan Kata Sandi</label>
                    <input class="form-input-text" type="password" name="password"  placeholder="Masukan kata sandi" autocomplete="off">
                    @if ($errors->get('password'))
                    <div class="alert alert-warning">
                        <x-input-error :messages="$errors->get('password')"/>
                    </div>
                    @endif  
                </div>
               
                <div class="button-group">
                    <button type="submit">Login</button>
                    <p>Sudah punya akun? <a style="color:#16a085;" href="{{route('register')}}">Daftar akun</a></p>
                </div>
                
                
            </form>
        </div>
    </div>
    
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

@if (Session::has('failed'))
<script>
    Swal.fire({
        title: 'Gagal',
        text: "{{ Session::get('failed') }}",
        icon: "error",
        timer:4000,
        confirmButtonText: 'OK'
    });
</script>
    
@endif

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

  /* General Styling */
body {
    font-family: "Noto Serif", serif;
    background-color: #f4f7fb;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.form-input {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap:2em;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
   width: max-content;
    padding: 30px;
}

.alert {
    color: red;
    transition: opacity 0.5s ease-out;
}


/* Greeting Section */
.content-grettings {
    margin: auto;
    display: grid;
}

h1 {
    font-size: 32px;
    color: #2c3e50;
    margin-bottom: 10px;
}

.title-content {
    width: 30em;
    text-align: left
    font-size: 16px;
    color: #7f8c8d;
}


.link-href{
    color: #000000;
    font-size: 14px;
}
/* Logo Section */
.logo-turre {
    text-align: center;
    margin-bottom: 30px;
}

.logo-turre h2 {
    font-size: 36px;
    color: #000000;
    font-weight: bold;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    font-size: 14px;
    color: #7f8c8d;
    margin-bottom: 8px;
}

.form-input-text {
    width: 100%;
    height: 35px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    color: #2c3e50;
    padding-left: 10px;
    transition: border-color 0.3s ease;
}

.form-input-text:focus {
    border-color: #1abc9c;
    outline: none;
}

/* input[type="password"]:focus {
    border-color: #e74c3c;
} */

/* Button */
button {
    padding: 14px;
    background-color: #1abc9c;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #16a085;
}

/* Form Input Text Alignment */
.input-group input {
    margin-top: 5px;
}

/* Error message styling (if any) */
.error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}

.form-group {
    padding: 10px;
}

/* Responsive */
@media (max-width: 480px) {
    .form-input {
        padding: 20px;
        width: 90%;
    }

    h1 {
        font-size: 28px;
    }

    .logo-turre h2 {
        font-size: 28px;
    }
    
    .content-grettings{
        display: none;
    }
}


@media (max-width: 680px) {
   
    .content-grettings{
        list-style-type: none;
        text-decoration: none;
        display: none;
    }
}

    
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); // Menghapus elemen setelah fade out
        }, 2000); // Waktu tampilan alert, dalam milidetik (3 detik)
    }
});

</script>
</html>
