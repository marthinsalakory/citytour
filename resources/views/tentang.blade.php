@extends('layouts.main')

@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('{{ url('/') }}/nova/assets/img/about-header.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center">

        <h2>Tentang Kami</h2>
        <ol>
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li>Tentang Kami</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4" data-aos="fade-up">
          <div class="col-lg-12">
            <div class="content ps-lg-5">
              <h3>Tentang City Tour</h3>
              <div>{!! DB::table('about')->where('id', '=', 1)->first()->isi !!}</div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

</main>

@endsection