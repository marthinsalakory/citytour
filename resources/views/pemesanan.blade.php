@extends('layouts.main')

@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('{{ url('/') }}/nova/assets/img/about-header.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center">

        @include('layouts.alert')
        <h2>Pemesanan</h2>
        <ol>
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li>Pemesanan</li>
        </ol>

        <div class="w-100 mt-3 text-center">
          @if ($jml_pesanan)
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail_pesanan">Detail Pesanan</button>
          @else
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pesan">Daftar</button>
          @endif
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

  @if ($jml_pesanan)
  <!-- Modal detail_pesanan -->
  <div class="modal fade" id="detail_pesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body position-relative">
          <button type="button" class="btn btn-danger position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal">X</button>
          <div class="row">
            <div class="col-12 text-center">
              <h5 class="fw-bold">Detail Pesanan</h5>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6 text-end">
              <p>{!! QrCode::size(100)->generate(route('qrcode', $pesanan->id)) !!}</p>
            </div>
            <div class="col-6">
              <h3>{{Auth::user()->name}}</h3>
              <p>Jumlah quota {{$pesanan->quota}}</p>
              <p>Biaya: @rupiah($pesanan->quota * 100000)</p>
            </div>
            @if ($pesanan->status == 'paid')
            <div class="col-12 text-center">
              <strong>Status : <span class="text-success text-uppercase">{{$pesanan->status}}</span></strong>
            </div>
            @else
            <div class="col-12 text-center">
              <strong>Silahkan datangi petugas kemudian scan barcode untuk menyelesaikan pembayaran</strong>
            </div>
            @endif
            <div class="col-12 text-center mt-3">
              <a href="{{route('hapus_pesanan')}}" onclick="return confirm('Jika anda menghapus maka pesanan anda akan dibatalkan.\nLanjutkan?')" class="btn btn-danger btn-sm">Hapus</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <!-- Modal Pesan -->
  <div class="modal fade" id="pesan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" action="{{route('pemesanan')}}" class="modal-body position-relative">
          @csrf
          <input type="hidden" name="masuk" value="true">
          <button type="button" class="btn btn-danger position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal">X</button>
          <div class="row">
            <div class="col-12 text-center">
              <h5>Daftar</h5>
            </div>
          </div><br>
          <div class="row-5">
            <div class="col-12">
              <label class="form-label" for="kuota">Untuk Berapa Orang</label>
              <input oninput="$('#harga').val(uang($(this).val() *  100000))" class="form-control text-center @error('quota') is-invalid @enderror" type="number" name="quota" id="quota" placeholder="Jumlah kuota" value="{{ old('quota') }}">
              @error('kuota')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-3">
              <label class="form-label">Harga</label>
              <input disabled class="form-control text-center" type="text" value="@rupiah(0)" id="harga">
            </div>
            <div class="col-12 mt-4">
              <button class="btn btn-primary w-100">Masuk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif

  <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">

        <h3 class="fw-bold text-center mb-5">Street View</h3>

        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="300">

          @foreach (DB::table('street_view')->get() as $sv)              
          <div class="col-lg-4 col-md-6 portfolio-item">
            <img src="{{ url('images', $sv->images) }}" class="img-fluid" alt="{{ url('images', $sv->images) }}">
            <div class="portfolio-info">
              <h4>{{$sv->name}}</h4>
              {{-- <p>Lorem ipsum, dolor sit amet consectetur</p> --}}
              <a href="{{ url('images', $sv->images) }}" title="{{$sv->name}}" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a onclick="" href="#" title="More Details" class="details-link" data-bs-toggle="modal" data-bs-target="#more_sv"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div>
          @endforeach

        </div>

      </div>

    </div>
  </section>

</main>

<!-- Modal -->
<div class="modal fade" id="more_sv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">More Street View</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-lg-4">
            <img class="img-fluid" id="sv_images">
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h3 id="sv_name"></h3>
          </div>
          <div class="col-12">
            <p id="sv_description"></p>
          </div>
        </div>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>

<script type="text/javascript">
  function uang(nominal){
    return nominal.toLocaleString("id-ID", { style: "currency", currency: "IDR" });
  }
</script>

@endsection