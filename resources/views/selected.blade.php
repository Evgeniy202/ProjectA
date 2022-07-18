@extends('layouts.app')
@section('tittle')
    Selected
@endsection
@section('content')
    <main class="container">
        <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
            @if($selectedProducts != null)
                @if(count($selectedProducts) < 2)
                    <strong class="d-block py-2">{{ count($selectedProducts) }} product</strong>
                @elseif(count($selectedProducts) > 1)
                    <strong class="d-block py-2">{{ count($selectedProducts) }} products</strong>
                @endif
            @else
                <strong class="d-block py-2">0 product</strong>
            @endif
        </header>
        <!-- ========= content items ========= -->
        @if(($selectedProducts == null) || (count($selectedProducts) == 0))
            <h3 class="text-center">Empty</h3>
        @else
            @foreach($selectedProducts as $selectedProduct)
                <article class="card card-product-list m-4">
                    <div class="row g-0">
                        <aside class="col-xl-3 col-md-4">
                            <a href="{{ route('productDetail', $selectedProduct->id) }}"
                               class="img-wrap rounded bg-gray-light"> <img height="100"
                                                                            class="mix-blend-multiply mt-4 m-5 rounded"
                                                                            src="{{ asset('/storage/'.$selectedProduct->mainImage) }}">
                            </a>
                        </aside> <!-- col.// -->
                        <div class="col-lg-6 col-md-5 col-sm-7">
                            <div class="card-body">
                                <a href="{{ route('productDetail', $selectedProduct->id) }}"
                                   class="title h5"> {{ $selectedProduct->tittle }} </a>

                                <div class="rating-wrap mb-2">
                                    <i class="dot"></i>
                                </div> <!-- rating-wrap.// -->
                                <p class="text-dark">{{ $selectedProduct->description }}</p>
                            </div> <!-- card-body.// -->
                        </div> <!-- col.// -->
                        <aside class="col-xl-3 col-md-3 col-sm-5">
                            <div class="info-aside">
                                <div class="price-wrap">
                                    <span class="price h5 text-dark m-1"> ${{ $selectedProduct->price }} </span>
                                </div> <!-- info-price-detail // -->
                                <div class="mb-3">
                                    <a href="#" class="btn btn-outline-primary col-8 m-1"> Add to cart </a>
                                    <a href="#" class="btn btn-outline-danger col-8 m-1"> Remove from selected </a>
                                </div>
                            </div> <!-- info-aside.// -->
                        </aside> <!-- col.// -->
                    </div> <!-- row.// -->
                </article>
            @endforeach
        @endif
        <hr>
    </main>
@endsection
