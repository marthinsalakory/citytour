@extends('layouts.main')

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-xl-4">
        <h2 data-aos="fade-up">CityTour</h2>
        <blockquote data-aos="fade-up" data-aos-delay="100">
          <p>Jelajahi lokasi wisata impian anda pada kota ini, dengan aman dan dengan harga yang nyaman.</p>
        </blockquote>
        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          <a href="{{route('pemesanan')}}" class="btn-get-started">Pesan Sekarang</a>
          <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Putar Video</span></a>
        </div>

      </div>
    </div>
  </div>
</section><!-- End Hero Section -->

@endsection