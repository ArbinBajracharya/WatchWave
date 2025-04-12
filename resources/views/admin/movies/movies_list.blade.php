@extends('layouts_backend.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Basic</h4>
                    <a href="{{url('admin/movies/add')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Movie
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Genre</th>
                                    <th>language</th>
                                    <th>Cast</th>
                                    <th>Director</th>
                                    <th>Release Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movies as $key => $movie)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ucfirst($movie->title)}}</td>
                                    <td>{{ucfirst($movie->type)}}</td>
                                    <td>{{ is_array($movie->genre) ? implode(', ', array_map('ucfirst', $movie->genre)) : ucfirst($movie->genre) }}</td>
                                    <td>{{$movie->language}}</td>
                                    <td>{{ is_array($movie->cast) ? implode(', ', $movie->cast) : $movie->cast }}</td>
                                    <td>{{ is_array($movie->director) ? implode(', ', $movie->director) : $movie->director }}</td>
                                    <td>{{$movie->relase_date}}</td>
                                    <td>
                                        <a href="{{url('admin/movies/edit/'.$movie->id)}}" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="{{url('admin/movies/delete/'.$movie->id)}}" title="Delete" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></a>
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