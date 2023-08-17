@extends('admin.templates.main')

@section('content')
<h1 class="mt-4">QR Code</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">QR Code</li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-qrcode"></i>
                QR Code Scanner
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form class="input-group mb-3">
                            <input value="{{$pesanan == false ? '' : $pesanan->id}}" oninput="$(this).parent('form:first').attr('action', '{{route('qrcode')}}/' + $(this).val())" class="form-control" placeholder="Code Pesanan">
                            <button class="btn btn-primary">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($pesanan)
<div class="row mt-3 justify-content-center">
    <div class="col-lg-6 col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-qrcode"></i>
                QR Code Scanner
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-end">
                      <p>{!! QrCode::size(100)->generate(route('qrcode', $pesanan->id)) !!}</p>
                    </div>
                    <div class="col-6">
                      <h3>{{Auth::user()->name}}</h3>
                      <p>Jumlah Kuota {{$pesanan->quota}}</p>
                      <p>Biaya: @rupiah($pesanan->quota * 100000)</p>
                    </div>
                    <div class="col-12 text-center">
                      <strong>Status: <span class="{{$pesanan->status == 'paid' ? 'text-success' : 'text-danger'}} text-uppercase">{{$pesanan->status}}</span></strong>
                    </div>
                    @if ($pesanan->status == 'unpaid')  
                    <div class="col-12 text-center mt-2">
                      <a href="{{route('hapus_pesanan', $pesanan->id)}}" onclick="return confirm('Jika anda menghapus maka pesanan anda akan dibatalkan.\nLanjutkan?')" class="btn btn-danger btn-sm">DELETE</a>
                      <a href="{{route('paid', $pesanan->id)}}" onclick="return confirm('Yakin ingin mengubah status menjadi paid.\nLanjutkan?')" class="btn btn-primary btn-sm">PAID</a>
                    </div>
                    @endif
                  </div>
            </div>
        </div>
    </div>
</div>    
@endif
@endsection