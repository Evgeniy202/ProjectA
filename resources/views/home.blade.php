@extends('layouts.app')

@section('tittle')
    Home
@endsection

@section('content')
    <section class="padding-y">
        <div class="container">

            <header class="section-heading">
                <h3 class="section-title">Favorite products</h3>
            </header>

            <div class="row">
                @foreach($productsList as $product)
                    <div class="col-lg-2 col-md-5 col-sm-5 bg-gradient m-3 ">
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
                                @foreach($categoriesList as $category)
                                    @if($category->id == $product->category)
                                        <small class="text-muted">{{ $category->tittle }}</small>
                                    @endif
                                @endforeach
                                <br>
                                <strong class="price">{{ $product->price }} $</strong> <!-- price.// -->
                            </figcaption>
                        </figure>
                    </div> <!-- col end.// -->
                @endforeach
            </div> <!-- row end.// -->
        </div> <!-- container end.// -->
    </section>
@endsection
