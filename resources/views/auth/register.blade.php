<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Toko</title>
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
                <h2>Daftar Akun</h2>
            </div>

            <form action="{{route('user_register.store')}}" method="POST">
                @method('POST')
                @csrf

                <div class="input-group">
                    <label for="">Masukan Nama Toko Anda</label>
                    <input class="form-input-text" type="text" name="shop_name" value="{{old('shop_name')}}" placeholder="Masukan nama toko" id="" autocomplete="off">
                    <div class="alert alert-warning">
                        <x-input-error :messages="$errors->get('shop_name')"/>
                    </div> 
                </div>

                <div class="input-group">
                    <label for="">Masukan Nama Anda</label>
                    <input class="form-input-text" type="text" name="owner_name" value="{{old('owner_name')}}" placeholder="Masukan nama anda" id="" autocomplete="off">
                </div>

                <div class="input-group">
                    <label for="">Masukan Nama Pengguna</label>
                    <input class="form-input-text" type="text" name="username" value="{{old('username')}}" placeholder="Masukan nama pengguna" id="" autocomplete="off">
                    <div class="alert alert-warning">
                        <x-input-error :messages="$errors->get('username')"/>
                    </div> 
                    </div>

                <div class="input-group">
                    <label for="">Masukan Email</label>
                    <input class="form-input-text" type="email" name="email" value="{{old('email')}}" placeholder="Masukan email anda" id="" autocomplete="off">
                    <div class="alert alert-warning">
                        <x-input-error :messages="$errors->get('email')"/>
                    </div> 
                </div>

                <div class="input-group">
                    <label for="">Masukan Kata Sandi</label>
                    <input class="form-input-text" type="password" name="password" placeholder="Masukan kata sandi" id="" autocomplete="off">
                </div>
               
                <div class="input-group">
                    <label for="">Konfirmasi Password</label>
                    <input class="form-input-text" type="password" name="password_confirmation" placeholder="Masukan kembali kata sandi" id="" autocomplete="off">
                </div>

                <div class="input-group">
                    <div style="display: flex; gap:10px;align-items:baseline;" class="privacy-content">
                        <input style="width: 15px; height:15px;"  class="form-input-text" type="checkbox" name="password_confirmation" id="" autocomplete="off">
                        <a style="font-size:13px;color:gray; " href="">Dengan ini saya menerima kebijakan & ketentuan</a>
                    </div>
                    
                </div>

                <div class="button-group">
                    <button type="submit">Daftar Akun</button>
                    <p>Sudah punya akun? <a style="color:#16a085;" href="{{route('login')}}">Login</a></p>
                    <br>
                    <a style="font-size: 14px;" href="#" data-toggle="modal" data-target="#privacyPolicyContent">Privacy Policy</a>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteUnit{{$dept->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$dept->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel{{$dept->id}}">Kebijakan Privasi dan Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Kami berkomitmen untuk melindungi privasi dan data pribadi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, <br>
                        dan melindungi informasi yang Anda berikan melalui sistem POS kami.</p>
                        <hr>

                    <div class="content-privacy">
                        <h4>1.Informasi yang Kami Kumpulkan</h4>
                        <hr>
                        <p>Kami mengumpulkan informasi pribadi seperti nama, alamat email, nomor telepon, informasi transaksi, serta data pembayaran (termasuk kartu kredit atau metode pembayaran lainnya) 
                            untuk memproses pesanan Anda dan memberikan pengalaman belanja yang lebih baik.</p>
                    </div>

                    <hr>

                    <div class="content-privacy">
                        <h4>2.Penggunaan Informasi</h4>
                        <hr>
                        <p>Data yang kami kumpulkan digunakan untuk memproses transaksi, mengelola akun pengguna, memberikan dukungan pelanggan, serta mengirimkan informasi penting terkait layanan atau pembaruan sistem POS. Kami juga dapat menggunakan data untuk menganalisis tren penggunaan dan memperbaiki sistem kami.</p>
                    </div>

                    <hr>

                    <div class="content-privacy">
                        <h4>3.Keamanan Data Anda</h4>
                        <hr>
                        <p>Kami mengambil langkah-langkah teknis dan organisatoris yang sesuai untuk melindungi data pribadi Anda dari akses yang tidak sah, perubahan, pengungkapan, atau perusakan. Semua informasi sensitif, seperti data pembayaran, dienkripsi dengan teknologi SSL (Secure Socket Layer).</p>
                    </div>

                    <hr>
                    
                    <div class="content-privacy">
                        <h4>4.Pembagian Informasi dengan Pihak Ketiga</h4>
                        <hr>
                        <p>Kami tidak akan menjual, menyewakan, atau mengungkapkan informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali jika diwajibkan oleh hukum atau untuk mematuhi prosedur hukum yang berlaku. Informasi dapat dibagikan kepada penyedia layanan yang mendukung sistem POS kami, dengan syarat mereka setuju untuk menjaga kerahasiaan data Anda.</p>
                    </div>

                    <hr>
                    
                    <div class="content-privacy">
                        <h4>5.Akses dan Pengendalian Data Pribadi</h4>
                        <hr>
                        <p>Anda berhak untuk mengakses, memperbarui, atau menghapus informasi pribadi yang kami simpan. Jika Anda ingin melakukan perubahan pada data Anda atau memiliki pertanyaan tentang kebijakan privasi ini, Anda dapat menghubungi kami melalui kontak yang tersedia di platform sistem POS.</p>
                    </div>

                    <hr>
                    
                    <div class="content-privacy">
                        <h4>6.Perubahan Kebijakan Privasi</h4>
                        <hr>
                        <p>Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Setiap perubahan akan diumumkan melalui platform atau email yang terdaftar, dan perubahan tersebut akan berlaku segera setelah diposting.</p>
                    </div>

                    <hr>
                    
                    <div class="content-privacy">
                        <h4>6.Penggunaan Cookies</h4>
                        <hr>
                        <p>Sistem POS kami menggunakan cookies untuk meningkatkan pengalaman pengguna, menganalisis penggunaan, dan menyimpan preferensi pengguna. Anda dapat mengatur browser Anda untuk menolak cookies, meskipun hal ini mungkin mempengaruhi fungsionalitas sistem.</p>
                    </div>

                    <hr>
                    <p>Dengan menggunakan sistem POS kami, Anda menyetujui pengumpulan dan penggunaan informasi sesuai dengan kebijakan privasi ini.</p>
                    

                    
                </div>
    
               
            </div>
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

.content-privacy {
    width: 100%;
    height: max-content;
}

.modal-body {
    display: block;
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
        display: none;
    }
}    
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const alert = document.querySelectorAll('.alert');
    if (alert) {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); // Menghapus elemen setelah fade out
        }, 2000); // Waktu tampilan alert, dalam milidetik (3 detik)
    }
});
</script>
</html>
