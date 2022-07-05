@extends('layouts.app')

@section('tittle')
    Home
@endsection

@section('content')
    <section class="py-1">
        <div class="container px-4 px-lg-5 mt-2">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($productsList as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <a href="#">
                                <img class="card-img-top img-thumbnail w-50 m-lg-5"
                                     src="{{ asset('/storage/'.$product->mainImage) }}"
                                     alt="{{ $product->tittle }}"/>
                            </a>
                            <div class="card-body p-4 row align-items-end">
                                <div class="text-center">
                                    <a href="#">
                                        <h6>{{ $product->tittle }}</h6>
                                    </a>
                                    {{ $product->price }} $
                                    <br>
                                    <a class="btn btn-outline-dark mt-auto"
                                       href="#">Додати до кошика</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
