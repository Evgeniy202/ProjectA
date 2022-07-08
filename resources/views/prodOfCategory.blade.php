@extends('layouts.app')
@section('tittle')
    {{ $category->tittle }}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form class="input-group mb-4" method="GET"
                  action="{{ route('SearchProdInCat', ['categoryId'=>$category->id]) }}">
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
                    @foreach($charsList as $char)
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" class="title" data-bs-toggle="collapse"
                                   data-bs-target="#collapse_aside_brands">
                                    <i class="icon-control fa fa-chevron-down"></i> {{ $char->tittle }}
                                </a>
                            </header>
                            <div class="collapse show" id="collapse_aside_brands">
                                <div class="card-body">
                                    @foreach($valuesList as $value)
                                        @if($value->char == $char->id)
                                            <label class="form-check mb-2 text-dark">
                                                <input class="form-check-input" type="checkbox"
                                                       value="{{ $value->$value }}">
                                                <span class="form-check-label"> {{ $value->value }} </span>
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
                                        <input class="form-control" id="min" placeholder="$0" type="number">
                                    </div> <!-- col end.// -->

                                    <div class="col-6">
                                        <label for="max" class="form-label">Max</label>
                                        <input class="form-control" id="max" placeholder="$1,0000" type="number">
                                    </div> <!-- col end.// -->
                                </div> <!-- row end.// -->
                                <button class="btn btn-light w-100" type="button">Apply</button>
                            </div> <!-- card-body.// -->
                        </div> <!-- collapse.// -->
                    </article> <!-- filter-group // -->
                </div> <!-- card.// -->
                <!-- ===== Card for sidebar filter .// ===== -->
            </aside> <!-- col .// -->
            <main class="col-lg-9">
                <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
                    <h3 class="d-block py-2">{{ $category->tittle }}</h3>
                    <div class="ms-auto">
                        <select class="form-select d-inline-block w-auto">
                            <option value="3">Randomly</option>
                            <option value="0">Expensive at first</option>
                            <option value="1">Cheap at first</option>
                        </select>
                    </div>
                </header>
                <!-- ========= content items ========= -->
                <div class="row">
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
                                    <a href="{{ route('productDetail', $product->id) }}"
                                       class="float-end btn btn-light btn-icon"> <i class="fa fa-heart"></i> </a>

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
                </div> <!-- row end.// -->
                <hr>
                <footer class="d-flex mt-4">
                    {{ $productsList->links() }}
                </footer>
                <!-- ========= content items .// ========= -->
            </main> <!-- col .// -->
        </div>
    </div>
@endsection
