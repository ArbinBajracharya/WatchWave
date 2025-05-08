@extends('layouts_backend.front')

@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Forms</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home">
            <a href="{{url('admin/dashboard')}}">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="{{url('/admin/director')}}">List</a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="#">Edit Director</a>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="{{route('admin.director.update')}}" method="POST" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Edit director</div>
              </div>
              <div class="card-body">
                
                  <div class="row">
                  
                    @csrf
                    <input type="hidden" name="id" value="{{$director->id}}">
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="email2">Name</label>
                        <input type="text" class="form-control" id="Title" name="name" value="{{$director->name}}" placeholder="Enter Name">
                      </div>
                    </div>
                  
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="email2">DOB</label>
                        <input type="text" class="form-control" id="email2" name="dob" value="{{$director->dob}}" placeholder="Enter Dob">
                      </div>
                  </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Country</label>
                          <input type="text" class="form-control" id="email2" name="country" value="{{$director->country}}" placeholder="Enter Country">
                        </div>
                    </div>
                    
                    {{-- Upload cover --}}
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="picture">Picture</label>
                        <input type="file" class="form-control" id="picture" name="picture" accept="image/*">
                      </div>
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                          <label for="email2">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="5">{{$director->description}}
                            </textarea>
                        </div>
                    </div>
                  </div>
                
              </div>
              <div class="card-action">
                <button type="submit" class="btn btn-success">Submit</button>
                <button class="btn btn-danger">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>
</script>
@endsection