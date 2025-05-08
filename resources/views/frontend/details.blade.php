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
                    <span>{{$details->title}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Anime Section Begin -->
<section class="anime-details spad">
    <div class="container">
        <div class="anime__details__content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="anime__details__pic set-bg" data-setbg="{{asset('images/'.$details->picture)}}">
                        <div class="comment"><i class="fa fa-comments"></i> {{count($comments)}}</div>
                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>{{$details->title}}</h3>
                        </div>
                        <div class="anime__details__rating">
                            <div class="rating">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            </div>
                            <span>1.029 Votes</span>
                        </div>
                        <p>{{$details->description}}</p>
                        <div class="anime__details__widget">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        @php
                                            // Process director (not clickable)
                                            $directorLinks = array_map(function($producer) {
                                                return '<a href="'.route('user.director.show', ['name' => urlencode($producer)]).'" class="cast-link" style="color: inherit">'.ucfirst($producer).'</a>';
                                            }, json_decode($details->director));
                                            $director = implode(", ", $directorLinks);
                                            
                                            // Process cast into clickable links
                                            $castLinks = array_map(function($actor) {
                                                return '<a href="'.route('user.actor.show', ['name' => urlencode($actor)]).'" class="cast-link" style="color: inherit">'.ucfirst($actor).'</a>';
                                            }, json_decode($details->cast));
                                            $cast = implode(", ", $castLinks);
                                            
                                            // Process genre (not clickable)
                                            $genre = implode(", ", array_map('ucfirst', json_decode($details->genre)));
                                        @endphp
                                
                                        <li><span>Type:</span> {{ ucfirst($details->type) }}</li>
                                        <li><span>Director:</span> {!! $director !!}</li>
                                        <li><span>Release Date:</span> {{ $details->relase_date }}</li>
                                        <li><span>Cast:</span> {!! $cast !!}</li>
                                        <li><span>Genre:</span> {{ $genre }}</li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Scores:</span> 7.31 / 1,515</li>
                                        <li><span>Rating:</span> 8.5 / 161 times</li>
                                        <li><span>Duration:</span> {{$details->duration}}</li>
                                        <li><span>Quality:</span> HD</li>
                                        <li><span>Views:</span> 131,541</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="anime__details__btn">
                            @if(in_array($details->id, json_decode(auth()->user()->watchlist ?? '[]', true)))
                                <a href="{{ url('user/watchlist/'.$details->id) }}" class="follow-btn active">
                                    <i class="fa fa-heart"></i> Added to WatchList
                                </a>
                            @else
                                <a href="{{ url('user/watchlist/'.$details->id) }}" class="follow-btn">
                                    <i class="fa fa-heart-o"></i> Add to WatchList
                                </a>
                            @endif
                            <a href="{{url('user/watch/'.$details->id)}}" class="watch-btn"><span>Watch Now</span> <i
                                class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Reviews</h5>
                        </div>
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
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        <form action="{{route('user.comment.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="video_id" value="{{$details->id}}">
                            <textarea name="comment" placeholder="Your Comment"></textarea>
                            <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>you might like...</h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="{{asset('frontend/images/sidebar/tv-1.jpg')}}">">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Boruto: Naruto next generations</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="{{asset('frontend/images/sidebar/tv-2.jpg')}}">">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="{{asset('frontend/images/sidebar/tv-3.jpg')}}">">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg" data-setbg="{{asset('frontend/images/sidebar/tv-4.jpg')}}">">
                            <div class="ep">18 / ?</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                            <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->
@endsection