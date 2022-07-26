@extends('layouts.app')
@section('tittle')
    Order
@endsection
@php
    $user = Auth::user()->id;
    $generalPrice = 0;
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
                        $generalPrice += $cartProduct->price * $cartProductData->first()->number;
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
                            <b>{{ $cartProductData->first()->number }}</b>
                        </td>
                @endforeach
                </tbody>
            </table>
            <h5>General price: ${{ $generalPrice }}</h5>
            <hr class="mb-5">
            <h4 class="text-center mb-5">Order</h4>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('checkOrder') }}">
                @csrf
                <div class="mt-2">
                    <input id="name" name="name" type="text" class="form-control" placeholder="Recipient firstname and lastname...">
                </div>
                <div class="mt-2">
                    <input id="phone" name="phone" type="text" class="form-control" placeholder="Mobile number...">
                </div><div class="mt-2">
                    <input id="address" name="address" type="text" class="form-control" placeholder="Address of ZIP Code...">
                </div>
                <div class="mt-2">
                    <textarea id="comment" name="comment" class="form-control" rows="10" placeholder="Comment (not necessarily)..."></textarea>
                </div>
                <input id="generalPrice" name="generalPrice" type="text" class="visually-hidden" value="{{ $generalPrice }}" readonly>
                <div class="mt-2">
                    <button type="submit" class="btn btn-outline-success col-9 m-2">Send</button>
                    <a href="{{ route('cartView') }}" class="btn btn-outline-secondary col-2 m-2">Close</a>
                </div>
            </form>
        @else
            <h3 class="text-center">Empty</h3>
        @endif
    </div>
@endsection
