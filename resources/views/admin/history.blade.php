@extends('admin.templates.main')

@section('content')
<h1 class="mt-4">History</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">History</li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-table"></i>
                History
            </div>
            <div class="card-body">
                <div class="row table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead class="bg-info">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Quota</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach (DB::table('history')->get() as $history)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{DB::table('users')->where('id', '=', $history->user_id)->first()->name}}</td>
                                <td>{{$history->quota}}</td>
                                <td><span class="text-success">paid</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection