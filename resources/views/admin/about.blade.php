@extends('admin.templates.main')

@section('content')
<h1 class="mt-4">About</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">About</li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-file"></i>
                About
            </div>
            <div class="card-body">
                <form method="POST" class="row">
                    @csrf
                    <div class="col-12">
                        <textarea required name="isi" class="form-control"rows="10">{!! $isi !!}</textarea>
                    </div>
                    <div class="col-12 mt-2">
                        <button class="btn btn-danger" type="reset">Reset Perubahan</button>
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection