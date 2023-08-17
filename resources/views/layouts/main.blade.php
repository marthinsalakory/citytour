<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CityTour</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  {{-- Jquery --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <!-- Favicons -->
  <link href="{{ url('/') }}/nova/assets/img/favicon.png" rel="icon">
  <link href="{{ url('/') }}/nova/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('/') }}/nova/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/nova/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ url('/') }}/nova/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ url('/') }}/nova/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/nova/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/nova/assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('/') }}/nova/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Nova - v1.3.0
  * Template URL: https://bootstrapmade.com/nova-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="page-index">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ route('beranda') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="{{ url('/') }}/nova/assets/img/logo.png" alt=""> -->
        <h1 class="d-flex align-items-center">CityTour</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('beranda') }}" class="{{Request::routeIs('beranda')?'active':''}}">Beranda</a></li>
          <li><a href="{{ route('tentang') }}" class="{{Request::routeIs('tentang')?'active':''}}">Tentang Kami</a></li>
          <li><a href="{{ route('pemesanan') }}" class="{{Request::routeIs('pemesanan')?'active':''}}">Pemesanan</a></li>
          <li><a href="{{ route('kontak') }}" class="{{Request::routeIs('kontak')?'active':''}}">Kontak</a></li>
          @guest
          <li><a class="btn btn-primary p-2 ms-5 text-light" data-bs-toggle="modal" data-bs-target="#masuk">Masuk</a></li>
          <li><a class="btn btn-primary p-2 ms-2 text-light" data-bs-toggle="modal" data-bs-target="#daftar">Daftar</a></li>
          @else
          <li><a onclick="return confirm('yakin ingin keluar?')" href="{{ route('logout') }}" class="btn btn-danger p-2 ms-5 text-light">Keluar</a></li>
          @endguest
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  
  @yield('content')

  {{-- Jika ada Error --}}
  @if ($errors->any())
    @if(old('masuk'))
      <script type="text/javascript">
          $(window).on('load', function() {
              $('#masuk').modal('show');
          });
      </script>
    @else
      <script type="text/javascript">
          $(window).on('load', function() {
              $('#daftar').modal('show');
          });
      </script>
    @endif
  @endif

  
  @if (isset($masuk))
  <script type="text/javascript">
      $(window).on('load', function() {
          $('#masuk').modal('show');
      });
  </script>
  @endif

  @if (isset($daftar))
  <script type="text/javascript">
      $(window).on('load', function() {
          $('#daftar').modal('show');
      });
  </script>
  @endif

  @guest
  <!-- Modal Masuk -->
  <div class="modal fade" id="masuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" action="{{ route('login') }}" class="modal-body position-relative">
          @csrf
          <input type="hidden" name="masuk" value="true">
          <button type="button" class="btn btn-danger position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal">X</button>
          <div class="row">
            <div class="col-12 text-center">
              <h5>Masuk</h5>
            </div>
          </div><br>
          <div class="row-5">
            <div class="col-12">
              @error('gagal_login')
                    <div class="alert alert-danger mb-3 text-center">{{ $message }}</div>
              @enderror
              <label class="form-label" for="email">Email</label>
              <input class="form-control text-center @error('email') is-invalid @enderror" type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
              @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-2">
              <label class="form-label" for="password">Password</label>
              <input class="form-control text-center @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Password">
              @error('password')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-4">
              <button class="btn btn-primary w-100">Masuk</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Daftar -->
  <div class="modal fade" id="daftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" action="{{ route('register') }}" class="modal-body position-relative">
          @csrf
          <button type="button" class="btn btn-danger position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal">X</button>
          <div class="row">
            <div class="col-12 text-center">
              <h5>Pendaftaran</h5>
            </div>
          </div><br>
          <div class="row-5">
            <div class="col-12">
              <label class="form-label" for="name">Nama Lengkap</label>
              <input class="form-control text-center @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="name Lengkap" value="{{ old('name') }}">
              @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-2">
              <label class="form-label" for="email">Email</label>
              <input class="form-control text-center @error('email') is-invalid @enderror" type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
              @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-2">
              <label class="form-label" for="no_telp">No. Telp</label>
              <input class="form-control text-center @error('no_telp') is-invalid @enderror" type="text" name="no_telp" id="no_telp" placeholder="No. Telp" value="{{ old('no_telp') }}">
              @error('no_telp')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-2">
              <label class="form-label" for="password">Password</label>
              <input class="form-control text-center @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
              @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-2">
              <label class="form-label" for="password_confirmation">Ulangi Password</label>
              <input class="form-control text-center @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi Password" value="{{ old('password_confirmation') }}">
              @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-4">
              <button class="btn btn-primary w-100">Daftar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endguest

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ url('/') }}/nova/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('/') }}/nova/assets/vendor/aos/aos.js"></script>
  <script src="{{ url('/') }}/nova/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ url('/') }}/nova/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ url('/') }}/nova/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ url('/') }}/nova/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ url('/jquery_mask/dist/jquery.mask.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('/') }}/nova/assets/js/main.js"></script>
</body>

</html>