@extends('layouts.front')

@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{url('/categories')}}">Categories</a>
                    <span>{{$video->title}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Anime Section Begin -->
<section class="anime-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="anime__video__player" style="width: 100%; aspect-ratio: 16/9; overflow: hidden;">
                    <video id="player" playsinline controls preload="metadata" poster="{{ asset('images/'.$video->picture) }}" style="width: 100%; height: 100%; object-fit: contain;">
                        @if($video->type == 'trailer')
                            <source src="{{ url('user/video/'.$video->trailer) }}" type="video/mp4" />
                        @else
                            <source src="{{ url('user/video/'.$video->video) }}" type="video/mp4" />
                        @endif
                    </video>
                </div>
                <div class="anime__details__episodes">
                    <div class="section-title">
                        <h5>List Name</h5>
                    </div>
                    <a href="#">Full Movie</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="anime__details__review">
                    <div class="section-title">
                        <h5>Reviews</h5>
                    </div>
                    @if(isset($comments) && count($comments) > 0)
                        @foreach($comments as $comment)
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="{{asset('frontend/images/anime/review-1.jpg')}}" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>{{ucfirst($comment->user->name)}} - <span>{{$comment->created_at->diffForHumans()}}</span></h6>
                                    <p>{{$comment->comment}}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-white">No reviews yet. Be the first to review!</p>
                    @endif
                </div>
                <div class="anime__details__form">
                    <div class="section-title">
                        <h5>Your Comment</h5>
                    </div>
                    <form action="{{route('user.comment.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="video_id" value="{{$video->id}}">
                        <textarea name="comment" placeholder="Your Comment"></textarea>
                        <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Anime Section End -->
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const player = new Plyr('#player', {
        keyboard: { focused: true, global: true }, // Enable keyboard seeking
        tooltips: { controls: true, seek: true } // Better seeking UX
    });
    
    // Debug seeking issues
    player.on('seeked', event => {
        console.log('Seeked to:', player.currentTime);
    });
    
    player.on('error', event => {
        console.error('Player error:', event.detail);
    });

    setTimeout(function () {
            $.ajax({
                url: 'video/{{ $video->id }}/increase-view',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function () {
                    console.error('Failed to increase view count');
                }
            });
        }, 5000);
});

</script>

@endsection