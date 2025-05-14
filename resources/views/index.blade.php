@extends('layouts.front')

@section('content')
<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            @foreach($sliders as $slider)
                <div class="hero__items set-bg" data-setbg="{{asset('images/'.$slider->picture)}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">{{ucfirst($slider->type)}}</div>
                                @php
                                    $genre = json_decode($slider->genre);
                                @endphp

                                @foreach($genre as $genre)
                                    <div class="label">{{ucfirst($genre)}}</div>
                                @endforeach
                                <h2>{{$slider->title}}</h2>
                                <p class="text-truncate mb-0">
                                    {{$slider->description}}
                                </p>
                                <a href="{{url('user/details/'.$slider->id)}}"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Recently Added</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($videos as $video)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $video->picture) }}">
                                    <div class="ep">{{ucfirst($video->type)}}</div>
                                    <div class="comment"><i class="fa fa-comments"></i> {{$video->comments_count}}</div>
                                    <div class="view"><i class="fa fa-eye"></i> {{$video->view}}</div>
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        @php
                                          $genre = json_decode($video->genre);
                                        @endphp

                                        @foreach($genre as $genre)
                                            <li>{{ucfirst($genre)}}</li>
                                        @endforeach
                                    </ul>
                                    <h5><a href="{{url('user/details/'.$video->id)}}">{{$video->title}}</a></h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="popular__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Popular Shows</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($populars as $popular)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $popular->picture) }}">
                                        <div class="ep">{{ucfirst($popular->type)}}</div>
                                        <div class="comment"><i class="fa fa-comments"></i> {{$popular->comments_count}}</div>
                                        <div class="view"><i class="fa fa-eye"></i> {{$popular->view}}</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            @php
                                            $genre = json_decode($popular->genre);
                                            @endphp

                                            @foreach($genre as $genre)
                                                <li>{{ucfirst($genre)}}</li>
                                            @endforeach
                                        </ul>
                                        <h5><a href="{{url('user/details/'.$popular->id)}}">{{$popular->title}}</a></h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="live__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Action</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories/action')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($actions) && count($actions) > 0)
                            @foreach($actions as $action)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $action->picture) }}">
                                            <div class="ep">{{ucfirst($action->type)}}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{$action->comments_count}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$action->view}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                $genre = json_decode($action->genre);
                                                @endphp

                                                @foreach($genre as $genre)
                                                    <li>{{ucfirst($genre)}}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{url('user/details/'.$action->id)}}">{{$action->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="px-5" style="color: white">No action movies available.</span>
                        @endif
                    </div>
                </div>
                <div class="live__product pt-5">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Adventure</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories/adventure')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($adventures)&&count($adventures) > 0)
                            @foreach($adventures as $adventure)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $adventure->picture) }}">
                                            <div class="ep">{{ucfirst($adventure->type)}}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{$adventure->comments_count}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$adventure->view}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                $genre = json_decode($adventure->genre);
                                                @endphp

                                                @foreach($genre as $genre)
                                                    <li>{{ucfirst($genre)}}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{url('user/details/'.$adventure->id)}}">{{$adventure->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="px-5" style="color: white">No adventure movies available.</span>
                        @endif
                    </div>
                </div>
                <div class="live__product pt-5">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Comedy</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories/comedy')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($comedys)&&count($comedys) > 0)
                            @foreach($comedys as $comedy)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $comedy->picture) }}">
                                            <div class="ep">{{ucfirst($comedy->type)}}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{$comedy->comments_count}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$comedy->view}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                $genre = json_decode($comedy->genre);
                                                @endphp

                                                @foreach($genre as $genre)
                                                    <li>{{ucfirst($genre)}}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{url('user/details/'.$comedy->id)}}">{{$comedy->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="px-5" style="color: white">No comedy movies available.</span>
                        @endif
                    </div>
                </div>
                <div class="live__product pt-5">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Fantesy</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories/fantesy')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($fantesys)&&count($fantesys) > 0)
                            @foreach($fantesys as $fantesy)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $fantesy->picture) }}">
                                            <div class="ep">{{ucfirst($fantesy->type)}}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{$fantesy->comments_count}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$fantesy->view}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                $genre = json_decode($fantesy->genre);
                                                @endphp

                                                @foreach($genre as $genre)
                                                    <li>{{ucfirst($genre)}}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{url('user/details/'.$fantesy->id)}}">{{$fantesy->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="px-5" style="color: white">No fantasy movies available.</span>
                        @endif
                    </div>
                </div>
                <div class="live__product pt-5">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Fiction</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories/fiction')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($fictions)&&count($fictions) > 0)
                            @foreach($fictions as $fiction)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $fiction->picture) }}">
                                            <div class="ep">{{ucfirst($fiction->type)}}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{$fiction->comments_count}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$fiction->view}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                $genre = json_decode($fiction->genre);
                                                @endphp

                                                @foreach($genre as $genre)
                                                    <li>{{ucfirst($genre)}}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{url('user/details/'.$fiction->id)}}">{{$fiction->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="px-5" style="color: white">No fiction movies available.</span>
                        @endif
                    </div>
                </div>
                <div class="live__product pt-5">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Horror</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories/horror')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($horrors)&&count($horrors) > 0)
                            @foreach($horrors as $horror)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $horror->picture) }}">
                                            <div class="ep">{{ucfirst($horror->type)}}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{$horror->comments_count}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$horror->view}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                $genre = json_decode($horror->genre);
                                                @endphp

                                                @foreach($genre as $genre)
                                                    <li>{{ucfirst($genre)}}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{url('user/details/'.$horror->id)}}">{{$horror->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="px-5" style="color: white">No horror movies available.</span>
                        @endif
                    </div>
                </div>
                <div class="live__product pt-5">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Romance</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{url('user/categories/romance')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($romances)&&count($romances) > 0)
                            @foreach($romances as $romance)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $romance->picture) }}">
                                            <div class="ep">{{ucfirst($romance->type)}}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{$romance->comments_count}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$romance->view}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                $genre = json_decode($romance->genre);
                                                @endphp

                                                @foreach($genre as $genre)
                                                    <li>{{ucfirst($genre)}}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{url('user/details/'.$romance->id)}}">{{$romance->title}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="px-5" style="color: white">No romance movies available.</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="product__sidebar">
                    <div class="product__sidebar__view">
                        <div class="section-title">
                            <h5>Top Views</h5>
                        </div>
                        @foreach($mostviews as $mostview)
                            <div class="filter__gallery">
                                <div class="product__sidebar__view__item set-bg"
                                data-setbg="{{('images/'.$mostview->picture)}}">
                                <div class="ep">{{ucfirst($mostview->type)}}</div>
                                <div class="view"><i class="fa fa-eye"></i> {{$mostview->view}}</div>
                                <h5><a href="#">{{$mostview->title}}</a></h5>
                            </div>
                        @endforeach
                        {{-- <div class="product__sidebar__view__item set-bg mix month week"
                        data-setbg="{{('frontend/images/sidebar/tv-2.jpg')}}">
                        <div class="ep">18 / ?</div>
                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                    </div>
                    <div class="product__sidebar__view__item set-bg mix week years"
                    data-setbg="{{('frontend/images/sidebar/tv-3.jpg')}}">
                    <div class="ep">18 / ?</div>
                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                </div>
                <div class="product__sidebar__view__item set-bg mix years month"
                data-setbg="{{('frontend/images/sidebar/tv-4.jpg')}}">
                <div class="ep">18 / ?</div>
                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
            </div>
            <div class="product__sidebar__view__item set-bg mix day"
            data-setbg="{{('frontend/images/sidebar/tv-5.jpg')}}">
            <div class="ep">18 / ?</div>
            <div class="view"><i class="fa fa-eye"></i> 9141</div>
            <h5><a href="#">Fate stay night unlimited blade works</a></h5> --}}
        </div>
    </div>
    {{-- <div class="product__sidebar__comment">
        <div class="section-title">
            <h5>New Comment</h5>
        </div>
        <div class="product__sidebar__comment__item">
            <div class="product__sidebar__comment__item__pic">
                <img src="{{asset('frontend/images/sidebar/comment-1.jpg')}}" alt="">
            </div>
            <div class="product__sidebar__comment__item__text">
                <ul>
                    <li>Active</li>
                    <li>Movie</li>
                </ul>
                <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
            </div>
        </div>
        <div class="product__sidebar__comment__item">
            <div class="product__sidebar__comment__item__pic">
                <img src="{{asset('frontend/images/sidebar/comment-2.jpg')}}" alt="">
            </div>
            <div class="product__sidebar__comment__item__text">
                <ul>
                    <li>Active</li>
                    <li>Movie</li>
                </ul>
                <h5><a href="#">Shirogane Tamashii hen Kouhan sen</a></h5>
                <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
            </div>
        </div>
        <div class="product__sidebar__comment__item">
            <div class="product__sidebar__comment__item__pic">
                <img src="{{asset('frontend/images/sidebar/comment-3.jpg')}}" alt="">
            </div>
            <div class="product__sidebar__comment__item__text">
                <ul>
                    <li>Active</li>
                    <li>Movie</li>
                </ul>
                <h5><a href="#">Kizumonogatari III: Reiket su-hen</a></h5>
                <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
            </div>
        </div>
        <div class="product__sidebar__comment__item">
            <div class="product__sidebar__comment__item__pic">
                <img src="{{asset('frontend/images/sidebar/comment-4.jpg')}}" alt="">
            </div>
            <div class="product__sidebar__comment__item__text">
                <ul>
                    <li>Active</li>
                    <li>Movie</li>
                </ul>
                <h5><a href="#">Monogatari Series: Second Season</a></h5>
                <span><i class="fa fa-eye"></i> 19.141 Viewes</span>
            </div>
        </div>
    </div> --}}
</section>
<!-- Product Section End -->
@endsection