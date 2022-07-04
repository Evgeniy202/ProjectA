@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
    @extends('admin.layouts.base')
    @section('tittle')
        Products of {{ $category->tittle }}
    @endsection
    @section('content')
        <div class="row">
            <h3 class="col-md-10">Products of {{ $category->tittle }}</h3>
            <hr class="mb-4">
        </div>
        <div class="row">
            <h6 class="col-md-4">Tittle</h6>
            <h6 class="col-md-2">Price</h6>
            <h6 class="col-md-2">Is available</h6>
            <h6 class="col-md-2">Is favorite</h6>
            <h6 class="col-md-2">Image</h6>
            <hr class="mb-4">
            @foreach($productsList as $product)
                <hr>
                <a href="{{ route('admProductDetails', $product->id) }}" class="col-md-4 btn btn-outline-warning">{{ $product->tittle }}</a>
                <p class="col-md-2">{{ $product->price }}$</p>
                <strong class="col-md-2">
                    @if($product->isAvailable == 1)
                        +
                    @else
                        -
                    @endif
                </strong>
                <strong class="col-md-2">
                    @if($product->isFavorite == 1)
                        +
                    @else
                        -
                    @endif
                </strong>
                <img style="max-width: 100px" class="col-md-2" src="{{ asset('/storage/' . $product->mainImage) }}" alt="{{ $product->tittle }}">
                <hr>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $productsList->links() }}
            </div>
        </div>
    @endsection
@endif
