@extends('layouts.front')

@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./categories.html">Categories</a>
                    @if(isset($type))
                        <span>{{ucfirst($type)}}</span>
                    @else
                        <span>All</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="product__page__content">
                    <div class="product__page__title">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-6">
                                <div class="section-title">
                                    @if(isset($type))
                                        <h4>{{ucfirst($type)}}</h4>
                                    @else
                                        <h4>All</h4>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="product__page__filter">
                                    <p>Sort by:</p>
                                    <select id="category-sort">
                                        <option value="">Select Genre</option>
                                        <option value="action">Action</option>
                                        <option value="adventure">Adventure</option>
                                        <option value="comedy">Comedy</option>
                                        <option value="fantesy">Fantesy</option>
                                        <option value="fiction">Fiction</option>
                                        <option value="horror">Horror</option>
                                        <option value="romance">Romance</option>
                                    </select>
                                </div>
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
                {{-- <div class="product__pagination">
                    <a href="#" class="current-page">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#"><i class="fa fa-angle-double-right"></i></a>
                </div> --}}
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
                                data-setbg="{{url('images/'.$mostview->picture)}}">
                                <div class="ep">{{ucfirst($mostview->type)}}</div>
                                <div class="view"><i class="fa fa-eye"></i> {{$mostview->view}}</div>
                                <h5><a href="{{url('user/details/'.$mostview->id)}}">{{$mostview->title}}</a></h5>
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
                <h5><a href="#">Fate stay night unlimited blade works</a></h5>
            </div> --}}
        </div>
    </div>
    {{-- <div class="product__sidebar__comment">
        <div class="section-title">
            <h5>New Comment</h5>
        </div>
        <div class="product__sidebar__comment__item">
            <div class="product__sidebar__comment__item__pic">
                <img src="{{('frontend/images/sidebar/comment-1.jpg')}}" alt="">
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
                <img src="{{('frontend/images/sidebar/comment-2.jpg')}}" alt="">
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
                <img src="{{('frontend/images/sidebar/comment-3.jpg')}}" alt="">
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
                <img src="{{('frontend/images/sidebar/comment-4.jpg')}}" alt="">
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

@section('js')
<script>
    // Sort by category
    $('#category-sort').on('change', function () {
        const type = $(this).val();
        if (type) {
            window.location.href = "{{ url('user/categories') }}/" + type;
        }
    });

</script>
@endsection