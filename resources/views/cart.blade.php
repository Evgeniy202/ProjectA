@extends('layouts.app')
@section('tittle')
    Cart
@endsection
@php
    $user = Auth::user()->id;
@endphp
@section('content')
    <div class="container">
        @if(!empty($cartProductsList[0]))
            <table class="table text-light">
                <thead>
                <tr>
                    <th scope="col">Tittle</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Number</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartProductsList as $cartProduct)
                    @php
                        $cartProductData = $inCart->where('user', $user)->where('product', $cartProduct->id);
                    @endphp
                    <tr>
                        <th scope="row"><a
                                href="{{ route('productDetail', $cartProduct->id) }}">{{ $cartProduct->tittle }}</a>
                        </th>
                        <td><a href="{{ route('productDetail', $cartProduct->id) }}"><img
                                    src="{{ asset('/storage/'.$cartProduct->mainImage) }}"
                                    class="img-fluid rounded" style="width: 115px"></a></td>
                        <td>${{ $cartProduct->price * $cartProductData->first()->number }}</td>
                        <td>
                            <form action="{{ route('changeNumberProduct', $cartProductData->first()->id) }}"
                                  method="POST">
                                @csrf
                                <input type="number" class="form-control col-md-12" name="qty" min="1"
                                       value="{{ $cartProductData->first()->number }}">
                                <br>
                                <input type="submit" class="btn btn-primary col-md-12" value="Change number">
                            </form>
                            <a href="{{ route('removeProductFromCart', $cartProductData->first()->id) }}"
                               class="btn btn-danger col-md-12 mt-2">Remove</a>
                @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">Empty</h3>
        @endif
    </div>
@endsection
