@extends('admin.templates.main')

@section('content')
<h1 class="mt-4">Street View</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Street View</li>
</ol>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header row">
                <div class="col-lg-6 col-12">
                    <i class="fa-solid fa-table"></i>
                    Street View
                </div>
                <div class="col-lg-6 col-12 text-lg-end text-center">
                    <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#btn-add">Add</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead class="bg-info">
                            <tr>
                                <th>No</th>
                                <th>Images</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach (DB::table('street_view')->get() as $sv)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><img class="img-fluid" src="{{url('images', $sv->images)}}" alt="Images"></td>
                                <td>{{$sv->name}}</td>
                                <td>{!!nl2br($sv->description)!!}</td>
                                <td>
                                    <a onclick="return confirm('Are you sure?')" href="{{route('street_view', $sv->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="btn-add" tabindex="-1" aria-labelledby="btn-addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form method="POST" class="modal-content" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Street View</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Name:</label>
                <input required type="text" class="form-control" name="name" id="name" placeholder="Enter name">
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="image">Image:</label>
                </div>
                <div class="col-10">
                    <input required type="file" class="form-control" name="images" id="images" onchange="previewImage(event)">
                </div>
                <div class="col-2">
                    <img id="preview" style="display:none;" class="img-fluid">
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea required class="form-control" name="description" id="description" rows="3" placeholder="Enter description"></textarea>
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
<script>
    function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = "block";
    }
    reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection