@extends('admin.layouts.base')
@section('tittle')
    Details of {{ $product->tittle }}
@endsection
@section('content')
    <div class="row">
        <h3 class="col-md-8">{{ $product->tittle }}</h3>
        <button class="btn btn-outline-warning btn-block col-md-2" data-bs-toggle="modal"
                data-bs-target="#productChars">
            Characteristics
        </button>
        <div class="modal fade" id="productChars" tabindex="-1"
             aria-labelledby="productChars" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-dark">
                        <h5 class="modal-title text-center" id="productChars">
                            <strong>Characteristics of {{ $product->tittle }}</strong>
                        </h5>
                    </div>
                    <div class="modal-body text-dark row">
                        @foreach($charsList as $char)
                            <strong class="col-md-6">{{ $char->tittle }}</strong>
                            @foreach($valuesList as $value)
                                @if($value->char == $char->id)
                                    <p class="col-md-6">{{ $value->value }}</p>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('addCharToProductView', $productId) }}"
                           class="btn btn-outline-dark col-md-12">
                            Characteristic manage
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('removeProduct', ['productId'=>$productId, 'categoryId'=>$product->category]) }}"
           class="btn btn-outline-danger btn-block col-md-2">
            Remove {{ $product->tittle }}
        </a>
        <hr class="mb-4">
    </div>
    <div class="row">
        <form action="{{ route('changeProduct', $productId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-3">
                <div class="form-group mt-3">
                    <input type="text" name="tittle" id="tittle" placeholder="Tittle..."
                           class="form-control bg-dark text-light" value="{{ $product->tittle }}">
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="slug" id="slug" placeholder="Marking..."
                           class="form-control bg-dark text-light" value="{{ $product->slug }}">
                </div>
                <div class="form-group mt-3">
                    <textarea class="form-control bg-dark text-light" name="description" id="description" rows="10"
                              placeholder="Description...">{{ $product->description }}</textarea>
                </div>
                <div class="form-group mt-3">
                    <input type="text" name="price" id="price" placeholder="Price..."
                           class="form-control bg-dark text-light" value="{{ $product->price }}">
                </div>
                <div class="form-group mt-3">
                    @if($product->isAvailable == 1)
                        <label>Is available <input type="checkbox" name="isAvailable" id="isAvailable"
                                                   value="1" checked></label>
                    @else
                        <label>Is available <input type="checkbox" name="isAvailable" id="isAvailable"
                                                   value="1"></label>
                    @endif
                </div>
                <div class="form-group mt-3">
                    @if($product->isFavorite)
                        <label>Is favorite <input type="checkbox" name="isFavorite" id="isFavorite"
                                                  value="1" checked></label>
                    @else
                        <label>Is favorite <input type="checkbox" name="isFavorite" id="isFavorite"
                                                  value="1"></label>
                    @endif
                </div>
                <img src="{{ asset('/storage/'.$product->mainImage) }}" alt="{{ $product->tittle }}">
                <div class="form-group mt-3">
                    <label>Main image <input type="file" name="mainImg" id="mainImg" value="{{ $product->mainImage }}"></label>
                </div>
                @isset($product->img_1)
                    <img src="{{ asset('/storage/'.$product->img_1) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_1"
                                                                     id="img_1"></label>
                </div>
                @isset($product->img_2)
                    <img src="{{ asset('/storage/'.$product->img_2) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_2"
                                                                     id="img_2"></label>
                </div>
                @isset($product->img_3)
                    <img src="{{ asset('/storage/'.$product->img_3) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_3"
                                                                     id="img_3"></label>
                </div>
                @isset($product->img_4)
                    <img src="{{ asset('/storage/'.$product->img_4) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_4"
                                                                     id="img_4"></label>
                </div>
                @isset($product->img_5)
                    <img src="{{ asset('/storage/'.$product->img_5) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_5"
                                                                     id="img_5"></label>
                </div>
                @isset($product->img_6)
                    <img src="{{ asset('/storage/'.$product->img_6) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_6"
                                                                     id="img_6"></label>
                </div>
                @isset($product->img_7)
                    <img src="{{ asset('/storage/'.$product->img_7) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_7"
                                                                     id="img_7"></label>
                </div>
                @isset($product->img_8)
                    <img src="{{ asset('/storage/'.$product->img_8) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_8"
                                                                     id="img_8"></label>
                </div>
                @isset($product->img_9)
                    <img src="{{ asset('/storage/'.$product->img_9) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_9"
                                                                     id="img_9"></label>
                </div>
                @isset($product->img_10)
                    <img src="{{ asset('/storage/'.$product->img_10) }}" alt="{{ $product->tittle }}">
                @endisset
                <div class="form-group mt-3">
                    <label>Additional image (not necessarily) <input type="file" name="img_10"
                                                                     id="img_10"></label>
                </div>
            </div>
            <hr>
            <input type="submit" class="btn btn-outline-primary btn-block col-md-12" value="Change">
        </form>
    </div>
@endsection

