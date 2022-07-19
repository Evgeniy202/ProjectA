@extends('layouts.app')
@section('tittle')
    {{ $category->tittle }}
@endsection
@section('content')
    @php
        if (!empty(Auth::user()->id))
        {
            $chosenOne = \App\Models\Selected::query()->where('user', Auth::user()->id)->get();
        }

        $chosenOneArray = [];
        if (!empty($chosenOne))
        {
            foreach ($chosenOne as $chosenProduct)
            {
               array_push($chosenOneArray, $chosenProduct->product);
            }
        }
    @endphp
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"
    ></script>
    <div class="container">
        <div class="row">
            <form class="input-group mb-4" method="GET"
                  action="{{ route('SearchProdInCat', $category->id) }}">
                <input name="search" id="search" class="mr-sm-2 col-md-9 bg-light form-control" type="text"
                       placeholder="Search"
                       aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0 col-md-2" type="submit">Search</button>
                <a href="{{ route('prodOfCatView', $category->id) }}"
                   class="btn btn-outline-secondary my-2 my-sm-0 col-md-1">Reset
                </a>
            </form>
            <aside class="col-lg-3">
                <button class="btn btn-outline-secondary mb-3 w-100  d-lg-none" data-bs-toggle="collapse"
                        data-bs-target="#aside_filter">Show filter
                </button>
                <!-- ===== Card for sidebar filter ===== -->
                <div id="aside_filter" class="collapse card d-lg-block mb-5">
                    <form action="{{ route('prodOfCatView', $category->id) }}">
                        @foreach($charsList as $char)
                            <article class="filter-group">
                                <header class="card-header">
                                    <a href="#" class="title" data-bs-toggle="collapse"
                                       data-bs-target="#collapse_aside_{{ $char->id }}">
                                        <i class="icon-control fa fa-chevron-down"></i> {{ $char->tittle }}
                                    </a>
                                </header>
                                <div class="collapse show" id="collapse_aside_{{ $char->id }}">
                                    <div class="card-body">
                                        @foreach($valuesList as $value)
                                            @if($value->char == $char->id)
                                                <label class="form-check mb-2 text-dark">
                                                    @if(array_key_exists($char->id.'-'.$value->id, $activeChars))
                                                        <input id="{{ $char->id }}-{{ $value->id }}"
                                                               name="{{ $char->id }}-{{ $value->id }}"
                                                               class="form-check-input" type="checkbox"
                                                               value="{{ $char->id }}-{{ $value->id }}" checked>
                                                        <span class="form-check-label"> {{ $value->value }} </span>
                                                    @else
                                                        <input id="{{ $char->id }}-{{ $value->id }}"
                                                               name="{{ $char->id }}-{{ $value->id }}"
                                                               class="form-check-input" type="checkbox"
                                                               value="{{ $char->id }}-{{ $value->id }}">
                                                        <span class="form-check-label"> {{ $value->value }} </span>
                                                    @endif
                                                </label> <!-- form-check end.// -->
                                            @endif
                                        @endforeach
                                    </div> <!-- card-body .// -->
                                </div> <!-- collapse.// -->
                            </article>
                        @endforeach
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" class="title" data-bs-toggle="collapse" data-bs-target="#collapse_aside2"
                                   aria-expanded="true">
                                    <i class="icon-control fa fa-chevron-down"></i> Price
                                </a>
                            </header>
                            <div class="collapse show" id="collapse_aside2" style="">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="min" class="form-label">Min</label>
                                            @if(array_key_exists('min', $activeChars))
                                                <input class="form-control" name="min" id="min" placeholder="$0"
                                                       type="number" value="{{ $activeChars['min'] }}">
                                            @else
                                                <input class="form-control" name="min" id="min" placeholder="$0"
                                                       type="number" value="0">
                                            @endif
                                        </div> <!-- col end.// -->
                                        <div class="col-6">
                                            <label for="max" class="form-label">Max</label>
                                            @if(array_key_exists('max', $activeChars))
                                                <input class="form-control" name="max" id="max" placeholder="$1,0000"
                                                       type="number" value="{{ $activeChars['max'] }}">
                                            @else
                                                <input class="form-control" name="max" id="max" placeholder="$1,0000"
                                                       type="number" value="0">
                                            @endif
                                        </div> <!-- col end.// -->
                                    </div> <!-- row end.// -->
                                </div> <!-- card-body.// -->
                            </div> <!-- collapse.// -->
                        </article> <!-- filter-group // -->
                        <button class="btn btn-outline-success col-md-6 m-1" type="submit">Apply</button>
                        <a href="{{ route('prodOfCatView', $category->id) }}"
                           class="btn btn-outline-warning col-md-4 m-1" type="button">Reset</a>
                    </form>
                </div> <!-- card.// -->
                <!-- ===== Card for sidebar filter .// ===== -->
            </aside> <!-- col .// -->
            <main class="col-lg-9">
                <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
                    <h3 class="d-block py-2">{{ $category->tittle }}</h3>
                    <div class="ms-auto">
                        <select name="meth" id="meth" class="form-select d-inline-block w-auto">
                            @foreach($sortList as $sort)
                                <option value="{{ $sort['val'] }}">{{ $sort['tittle'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#meth').on('change', function () {
                                var sort = $(this).val();
                                if (sort) {
                                    window.location.replace("/category/{{ $category->id }}?sort=" + sort);
                                }
                            });
                        });
                    </script>
                </header>
                <!-- ========= content items ========= -->
                <div class="row">
                    @if(($productsFil == null) && (str_replace(['page='.request()->page, 'sort='.request()->sort], '', request()->getQueryString())))
                        <h3 class="text-center">Nothing found!</h3>
                    @else
                        @if(empty($productsFil[0]))
                            @foreach($productsList as $product)
                                <div class="col-lg-3 col-md-5 col-sm-5 bg-gradient m-4">
                                    <figure class="card-product-grid">
                                        <div class="bg-light rounded mt-2">
                                            <a href="{{ route('productDetail', $product->id) }}"
                                               class="img-wrap rounded bg-gray-light">
                                                <img height="100" class="mix-blend-multiply mt-4 m-5 rounded"
                                                     src="{{ asset('/storage/'.$product->mainImage) }}">
                                            </a>
                                        </div>
                                        <figcaption class="pt-2">
                                            @if((in_array($product->id, $chosenOneArray)) && (!empty(Auth::user()->id)))
                                                <a id="selectBtn-{{ $product->id }}"
                                                   href="{{ route('removeChoseOne', ['product'=>$product->id]) }}"
                                                   class="float-end btn btn-light btn-outline-danger active"><i
                                                        class="bi bi-heart">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                             fill="currentColor" class="bi bi-heart"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                        </svg>
                                                    </i></a>
                                            @elseif (!empty(Auth::user()->id))
                                                <a id="selectBtn-{{ $product->id }}"
                                                   href="{{ route('choseOne', ['product'=>$product->id]) }}"
                                                   class="float-end btn btn-light btn-outline-danger"><i
                                                        class="bi bi-heart">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                             fill="currentColor" class="bi bi-heart"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                        </svg>
                                                    </i></a>
                                            @else
                                                <a id="selectBtn-{{ $product->id }}"
                                                   href="{{ route('login') }}"
                                                   class="float-end btn btn-light btn-outline-danger"><i
                                                        class="bi bi-heart">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                             fill="currentColor" class="bi bi-heart"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                        </svg>
                                                    </i></a>
                                            @endif
                                            <a href="{{ route('productDetail', $product->id) }}"
                                               class="title">{{ $product->tittle }}</a>
                                            <br>
                                            <small class="text-muted">{{ $category->tittle }}</small>
                                            <br>
                                            <strong class="price">{{ $product->price }} $</strong> <!-- price.// -->
                                        </figcaption>
                                    </figure>
                                </div> <!-- col end.// -->
                            @endforeach
                        @else
                            @foreach($productsFil->items() as $productFil)
                                <div class="col-lg-3 col-md-5 col-sm-5 bg-gradient m-4">
                                    <figure class="card-product-grid">
                                        <div class="bg-light rounded mt-2">
                                            <a href="{{ route('productDetail', $productFil['id']) }}"
                                               class="img-wrap rounded bg-gray-light">
                                                <img height="100" class="mix-blend-multiply mt-4 m-5 rounded"
                                                     src="{{ asset('/storage/'.$productFil['mainImage']) }}">
                                            </a>
                                        </div>
                                        <figcaption class="pt-2">
                                            @if(in_array($productFil['id'], $chosenOneArray))
                                                <a id="selectBtn-{{ $productFil['id'] }}"
                                                   href="{{ route('removeChoseOne', ['product'=>$productFil['id']]) }}"
                                                   class="float-end btn btn-light btn-outline-danger active"><i
                                                        class="bi bi-heart">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                             fill="currentColor" class="bi bi-heart"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                        </svg>
                                                    </i></a>
                                            @else
                                                <a id="selectBtn-{{ $productFil['id'] }}"
                                                   href="{{ route('choseOne', ['product'=>$productFil['id']]) }}"
                                                   class="float-end btn btn-light btn-outline-danger"><i
                                                        class="bi bi-heart">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                             fill="currentColor" class="bi bi-heart"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                        </svg>
                                                    </i></a>
                                            @endif
                                            <a href="{{ route('productDetail', $productFil['id']) }}"
                                               class="title">{{ $productFil['tittle'] }}</a>
                                            <br>
                                            <small class="text-muted">{{ $category['tittle'] }}</small>
                                            <br>
                                            <strong class="price">{{ $productFil['price'] }} $</strong>
                                            <!-- price.// -->
                                        </figcaption>
                                    </figure>
                                </div> <!-- col end.// -->
                            @endforeach
                        @endif
                    @endif
                </div> <!-- row end.// -->
                <hr>
                <footer class="d-flex mt-4">
                    @if(($productsFil == null) && (!str_replace(['page='.request()->page, 'sort='.request()->page], '', request()->getQueryString())))
                        @if(empty($productsFil[0]))
                            {{ $productsList->links() }}
                        @endif
                    @endif
                    @if((!request()->filled('page')) || (request()->page == 1))
                        @if($productsFilLinks > 1)
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                        <span class="page-link" aria-hidden="true">‹</span>
                                    </li>
                                    <li class="page-item active" aria-current="page"><span
                                            class="page-link">1</span></li>
                                    @for($i = 2; $i <= $productsFilLinks; $i++)
                                        <li class="page-item"><a class="page-link"
                                                                 href="?page={{ $i }}&{{ str_replace('page='.request()->page, '', request()->getQueryString()) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="?page=2&{{ str_replace('page='.request()->page, '', request()->getQueryString()) }}"
                                           rel="next"
                                           aria-label="Next »">›</a>
                                    </li>
                                </ul>
                            </nav>
                        @endif
                    @elseif((request()->page > 1) && (str_replace(['page='.request()->page, 'sort='.request()->page], '', request()->getQueryString())))
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link"
                                       href="?page={{ request()->page - 1 }}&{{ str_replace('page='.request()->page, '', request()->getQueryString()) }}"
                                       rel="Previous"
                                       aria-label=" «Previous">‹</a>
                                </li>
                                @for($i = 1; $i <= $productsFilLinks; $i++)
                                    @if($i == request()->page)
                                        <li class="page-item active" aria-current="page"><span
                                                class="page-link">{{ $i }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                                 href="?page={{ $i }}&{{ str_replace('page='.request()->page, '', request()->getQueryString()) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                                <li class="page-item">
                                    <a class="page-link"
                                       href="?page={{ request()->page + 1 }}&{{ str_replace('page='.request()->page, '', request()->getQueryString()) }}"
                                       rel="next"
                                       aria-label="Next »">›</a>
                                </li>
                            </ul>
                        </nav>
                    @endif
                </footer>
                {{--                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>--}}
                <!-- ========= content items .// ========= -->
            </main> <!-- col .// -->
        </div>
    </div>
@endsection
