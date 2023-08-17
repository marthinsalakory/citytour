@extends('admin.templates.main')

@section('content')
<h1 class="mt-4">Contact</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Contact</li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-table"></i>
                Contact
            </div>
            <div class="card-body">
                <div class="row table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead class="bg-info">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach (DB::table('contact')->get() as $contact)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->subject}}</td>
                                <td>{{$contact->message}}</td>
                                <td><a onclick="return confirm('delete this contact?')" href="{{route('d_contact', $contact->id)}}" class="btn btn-danger btn-sm">Delete</a></td>
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