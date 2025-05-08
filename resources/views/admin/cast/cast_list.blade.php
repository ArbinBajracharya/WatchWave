@extends('layouts_backend.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Casts</h4>
                    {{-- <a href="{{url('admin/movies/add')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Movie
                    </a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Dob</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($casts as $key => $cast)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$cast->name}}</td>
                                    <td>{{$cast->dob}}</td>
                                    <td>{{$cast->country}}</td>
                                    <td>
                                        <a href="{{url('admin/cast/edit/'.$cast->id)}}" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="{{url('admin/cast/delete/'.$cast->id)}}" title="Delete" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></a>
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
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
      $("#basic-datatables").DataTable({});
    });
</script>
@endsection