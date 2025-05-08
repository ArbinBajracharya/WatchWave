@extends('layouts.front')

@section('content')

<!-- Anime Section Begin -->
<section class="anime-details spad">
    <div class="container">
        <div class="anime__details__content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="anime__details__pic set-bg" data-setbg="{{ isset($casts->picture) ? asset('images/casts/'.$casts->picture) : asset('frontend/images/profile.png') }}"
                        style="
                            width: 250px;      /* Set equal width and height */
                            height: 250px;
                            border-radius: 50%;
                            overflow: hidden;   /* Ensures the image stays clipped to the circle */
                        "
                    ></div>
                </div>
                <div class="col-lg-9">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>{{$casts->name}}</h3>
                        </div>
                        <p>{{$casts->descripton}}</p>
                        <div class="anime__details__widget">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Dob:</span> {{$casts->dob}} </li>
                                        <li><span>Country:</span> {{$casts->country}} </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Watch List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($movies as $movie)
                                <div class="col-lg-3 col-md-6 col-sm-6">  <!-- Changed from col-lg-4 to col-lg-3 -->
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $movie->picture) }}">
                                            <div class="ep">{{ucfirst($movie->type)}}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                $genre = json_decode($movie->genre);
                                                @endphp
                    
                                                @foreach($genre as $genre)
                                                    <li>{{ucfirst($genre)}}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{url('user/details/'.$movie->id)}}">{{$movie->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->
@endsection