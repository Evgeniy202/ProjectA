@extends('layouts.app')

@section('tittle')
    {{ $product->tittle }}
@endsection

@section('content')
    <div class="container text-light">
        <nav aria-label="breadcrumb" class="mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('prodOfCatView', $category->id) }}">{{ $category->tittle }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->tittle }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-4">
                <div class="main-img-slider">
                    <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->mainImage) }}">
                        <img src="{{ asset('/storage/'.$product->mainImage) }}"
                             class="img-fluid w-100 rounded">Переглянути більше зображень</a>
                </div>
            </div>
            <div class="col-md-8">
                <h3> {{ $product->tittle }} </h3>
                <p>Price: {{ $product->price }} грн.</p>
                <p>Description: {{ $product->description }} </p>
                <hr>

                <a href="#">
                    <button class="btn btn-danger">Додати до кошику</button>
                </a>

            </div>
            <hr>
            <p class="mt-4"><h4>Характеристики:</h4></p>
            <table class="table">
                <tbody>
                @foreach($charsOfProd as $charOfProd)
                    @foreach($charsList as $char)
                        @foreach($valuesList as $value)
                            @if(($char->id == $value->char) && ($value->id == $charOfProd->value))
                                <tr class="text-light">
                                    <th scope="row">{{ $char->tittle }}</th>
                                    <td>{{ $value->value }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
                </tbody>
            </table>
            <hr>

            {{--            comment in future--}}

        </div>
        <div class="row">
            <section id="detail">
                <div class="main-img-slider">
                    @if($product->img_1 != null)
                    <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_1) }}">
                        <img src="{{ asset('/storage/'.$product->img_1) }}" class="img-fluid" style="display: none;">
                    </a>
                    @endif
                    @if($product->img_2 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_2) }}">
                            <img src="{{ asset('/storage/'.$product->img_2) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                    @if($product->img_3 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_3) }}">
                            <img src="{{ asset('/storage/'.$product->img_3) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                    @if($product->img_4 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_4) }}">
                            <img src="{{ asset('/storage/'.$product->img_4) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                    @if($product->img_5 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_5) }}">
                            <img src="{{ asset('/storage/'.$product->img_5) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                    @if($product->img_6 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_6) }}">
                            <img src="{{ asset('/storage/'.$product->img_6) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                    @if($product->img_7 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_7) }}">
                            <img src="{{ asset('/storage/'.$product->img_7) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                    @if($product->img_8 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_8) }}">
                            <img src="{{ asset('/storage/'.$product->img_8) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                    @if($product->img_9 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_9) }}">
                            <img src="{{ asset('/storage/'.$product->img_9) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                    @if($product->img_10 != null)
                        <a data-fancybox="gallery" href="{{ asset('/storage/'.$product->img_10) }}">
                            <img src="{{ asset('/storage/'.$product->img_10) }}" class="img-fluid" style="display: none;">
                        </a>
                    @endif
                </div>
            </section>
            <script>
                $('#detail .main-img-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    speed: 300,
                    lazyLoad: 'ondemand',
                    asNavFor: '.thumb-nav',
                    prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
                    nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">Next</span></div>'
                });
            </script>
            <script>
                $('.thumb-nav').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    centerPadding: '0px',
                    asNavFor: '.main-img-slider',
                    dots: false,
                    centerMode: false,
                    draggable: true,
                    speed: 200,
                    focusOnSelect: true,
                    prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable">Previous</span></div>',
                    nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">Next</span></div>'
                });
            </script>
            <script>
                $('.main-img-slider').on('afterChange', function (event, slick, currentSlide, nextSlide) {
                    //remove all active class
                    $('.thumb-nav .slick-slide').removeClass('slick-current');
                    //set active class for current slide
                    $('.thumb-nav .slick-slide:not(.slick-cloned)').eq(currentSlide).addClass('slick-current');
                });
            </script>
        </div>
    </div>
@endsection
