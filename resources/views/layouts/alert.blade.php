@if (session('berhasil'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>Berhasil!</strong> {!! session('berhasil') !!}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('gagal'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Gagal!</strong> {!! session('gagal') !!}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif