<link href="{{ asset('assets/front_end/css/styles.css') }}" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <div style="padding: 10px;" class="logo-content-turre">
        <img height="70" width="90" src="{{ asset('assets/front_end/assets/img/logo.png') }}" alt="">
    </div>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">

            @if (app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_logo)
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img style="border-radius: 50%;" width="30" height="30"
                        src="{{ asset('storage/' . app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_logo) }}"
                        alt="">
                </a>
            @else
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img style="border-radius: 50%;" width="30" height="30"
                        src="{{ asset('assets/front_end/assets/img/empty.png') }}" alt="">
                </a>
            @endif
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile_information') }}">Akun</a></li>
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                {{-- <li><hr class="dropdown-divider" /></li> --}}
            </ul>
        </li>
    </ul>
</nav>


{{-- Modal Logout --}}
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script src="../assets/front_end/js/js/sb-admin-2.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/front_end/js/scripts.js') }}"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

    body {
        font-family: "DM Sans", serif;
    }
</style>
