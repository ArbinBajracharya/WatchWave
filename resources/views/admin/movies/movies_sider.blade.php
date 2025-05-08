@extends('layouts_backend.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Active</h4>
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
                                @foreach($actives as $key => $active)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ucfirst($active->title)}}</td>
                                    <td>{{ucfirst($active->type)}}</td>
                                    <td>{{ is_array($active->genre) ? implode(', ', array_map('ucfirst', $active->genre)) : ucfirst($active->genre) }}</td>
                                    <td>{{$active->language}}</td>
                                    <td>{{ is_array($active->cast) ? implode(', ', $active->cast) : $active->cast }}</td>
                                    <td>{{ is_array($active->director) ? implode(', ', $active->director) : $active->director }}</td>
                                    <td>{{$active->relase_date}}</td>
                                    <td class="text-center">
                                        <a href="{{url('admin/movies/inactive/'.$active->id)}}" title="Inactive"><i class="fas fa-minus"></i></a>
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">All movies</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables-new" class="display table table-striped table-hover">
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
                                    <td class="text-center">
                                        <a href="{{url('admin/movies/active/'.$movie->id)}}" title="Active"><i class="fas fa-plus"></i></a>
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

    $(document).ready(function () {
      $("#basic-datatables-new").DataTable({});
    });
</script>
@endsection