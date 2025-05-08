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
            <a href="{{url('/admin/movies')}}">List</a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="#">Edit Movies</a>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="{{route('admin.movies.update')}}" method="POST" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header">
                <div class="card-title">Edit Movies</div>
              </div>
              <div class="card-body">
                
                  <div class="row">
                  
                    @csrf
                    <input type="hidden" name="id" value="{{$video->id}}">
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="email2">Title</label>
                        <input type="text" class="form-control" id="Title" name="title" value="{{$video->title}}" placeholder="Enter Movie Title">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        @php
                        $selectedGenres = is_array($video->genre) ? $video->genre : json_decode($video->genre, true);
                        @endphp

                        <div class="form-group">
                        <label for="email2">Genre</label>
                        <div class="selectgroup selectgroup-pills">

                            @foreach (['action', 'adventure', 'comedy', 'fantesy', 'fiction', 'horror', 'romance'] as $genre)
                            <label class="selectgroup-item">
                                <input type="checkbox" name="genre[]" value="{{ $genre }}"
                                    class="selectgroup-input"
                                    {{ in_array($genre, $selectedGenres ?? []) ? 'checked' : '' }}>
                                <span class="selectgroup-button">{{ ucfirst($genre) }}</span>
                            </label>
                            @endforeach

                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="email2">Type</label>
                            <select class="form-control" id="typeSelect" name="type">
                                <option value="movie" {{ $video->type == 'movie' ? 'selected' : '' }}>Movie</option>
                                <option value="trailer" {{ $video->type == 'trailer' ? 'selected' : '' }}>Trailer</option>
                                <option value="documentary" {{ $video->type == 'documentary' ? 'selected' : '' }}>Documentary</option>
                            </select>                      
                        </div>
                    </div>
                  
                    <div class="col-md-6 col-lg-4">
                      <div class="form-group">
                        <label for="email2">Language</label>
                        <input type="text" class="form-control" id="email2" name="language" value="{{$video->language}}" placeholder="Enter language">
                      </div>
                  </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Country</label>
                          <input type="text" class="form-control" id="email2" name="country" value="{{$video->country}}" placeholder="Enter Country">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Cast</label>
                          <input type="text" class="form-control" id="email2" name="cast[]" value="{{is_array(json_decode($video->cast)) ? implode(', ', json_decode($video->cast)) : $video->cast }}" placeholder="Enter Cast">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Director</label>
                          <input type="text" class="form-control" id="email2" name="director[]" value="{{is_array(json_decode($video->director)) ? implode(', ', json_decode($video->director)) : $video->director }}" placeholder="Enter Director">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Release Date</label>
                          <input type="text" class="form-control" id="email2" name="release_date" value="{{$video->relase_date}}" placeholder="Enter relase date">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Duration</label>
                          <input type="text" class="form-control" id="email2" name="duration" value="{{$video->duration}}" placeholder="Enter Duration">
                        </div>
                    </div>
                    
                    {{-- Video section --}}
                    <div class="col-md-6 col-lg-4">
                      <!-- Video Input -->
                      <div class="form-group" id="videoGroup">
                        <div id="upload-container">
                          <label>Video</label>
                          <input type="hidden" name="video_path">
                          <input type="file" class="form-control" id="browseButton" name="video" accept="video/*">
                          <div id="upload-progress" style="display: none; width: 100%; background: #eee;">
                              <div id="progress-bar" style="width: 0; height: 20px; background: green;"></div>
                          </div>
                        </div>
                      </div>
                    
                      <!-- Trailer Input (Initially Hidden) -->
                      <div class="form-group" id="trailerGroup" style="display: none;">
                        <label for="trailer">Trailer</label>
                        <input type="file" class="form-control" id="trailer" name="trailer" accept="video/*">
                      </div>

                      <!-- Pre-release Checkbox -->
                      <div class="form-group form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="preRelease" name="pre_release">
                        <label class="form-check-label" for="preRelease">Pre-release</label>
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
                            <textarea class="form-control" name="description" id="description" rows="5">{{$video->description}}
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
  $(document).ready(function() {
  // 1. Handle pre-release checkbox change
  $('#preRelease').on('change', function() {
    if (this.checked) {
      $('#trailerGroup').show();
      $('#videoGroup').hide();
    } else {
      $('#trailerGroup').hide();
      $('#videoGroup').show();
    }
  });

  // 2. Automatically check pre-release when Trailer is selected
  $('#typeSelect').on('change', function() {
    if ($(this).val() === 'trailer') {
      $('#preRelease').prop('checked', true).trigger('change'); // Check and trigger change
    } else {
      $('#preRelease').prop('checked', false).trigger('change'); // Uncheck and trigger change
    }
  });

  // 3. Initialize on page load
  if ($('#typeSelect').val() === 'trailer') {
    $('#preRelease').prop('checked', true).trigger('change');
  }
});

let r = new Resumable({
    target: '/upload-chunks',
    query: {_token: '{{ csrf_token() }}'},
    fileType: ['mp4', 'mov', 'avi'],
    chunkSize: 10 * 1024 * 1024, // 10MB
    testChunks: false,
    throttleProgressCallbacks: 1,
});

r.assignBrowse(document.getElementById('browseButton'));
    
r.on('fileAdded', function(file) {
    // Show progress bar
    document.getElementById('upload-progress').style.display = 'block';

    // Start upload
    r.upload();
});

r.on('fileProgress', function(file) {
    let progress = Math.floor(file.progress() * 100);
    document.getElementById('progress-bar').style.width = progress + '%';
});

r.on('fileSuccess', function(file, message) {
    let response = JSON.parse(message);
    if (response.done) {
        console.log('Upload complete: ' + response.filename);
        document.querySelector('input[name="video_path"]').value = response.filename;
    }
    alert('Upload complete');

});

r.on('fileError', function(file, message) {
    alert('Upload failed: ' + message);
});
</script>
@endsection