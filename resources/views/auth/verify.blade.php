@extends('layouts.main')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('{{ url('/') }}/nova/assets/img/about-header.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center">

        <h2>Verifikasi Email</h2>
        <ol>
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li>Verifikasi Email</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->
    
    <section>
        <div class="container" data-aos="fade-up">
          <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
              <h3>Verifikasi Email Anda</h3>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        Tautan verifikasi baru telah dikirim ke alamat email Anda.
                    </div>
                @endif
              <p>Sebelum melanjutakan, periksa email Anda untuk tautan verifikasi. Jika tidak menerima email tersebut klik dibawah untuk meminta lainnya.</p>
              <a class="cta-btn" href="{{ route('verification.resend') }}">Kirim Ulang</a>
            </div>
          </div>
  
        </div>
      </section>

</main>
@endsection
