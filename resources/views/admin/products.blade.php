@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
    @extends('admin.layouts.base')
    @section('tittle')
        Products
    @endsection
    @section('content')
        <button type="button" class="btn btn-outline-success col-md-12" data-bs-toggle="modal"
                data-bs-target="#orderDetails-">
            Add new Product
        </button>
        <div class="modal fade" id="orderDetails-" tabindex="-1" aria-labelledby="orderDetailsLabel-"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="orderDetailsLabel-">
                            Add new product
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-3">
                                    <select class="form-control text-center btn-outline-secondary" name="category">
                                        @foreach ($categoriesList as $item)
                                            <option value="{{ $item->id }}">{{ $item->tittle }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group mt-3">
                                        <input type="text" name="tittle" id="tittle" placeholder="Tittle..."
                                               class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" name="slug" id="slug" placeholder="Marking..."
                                               class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <textarea class="form-control" name="description" id="description" rows="10"
                                                  placeholder="Description..."></textarea>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" name="price" id="price" placeholder="Price..."
                                               class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Is available <input type="checkbox" name="isAvailable" id="isAvailable"
                                                                   value="1"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Is favorite <input type="checkbox" name="isFavorite" id="isFavorite"
                                                                  value="1"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Main image <input type="file" name="mainImg" id="mainImg"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_1"
                                                                                         id="img_1"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_2"
                                                                                         id="img_2"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_3"
                                                                                         id="img_3"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_4"
                                                                                         id="img_4"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_5"
                                                                                         id="img_5"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_6"
                                                                                         id="img_6"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_7"
                                                                                         id="img_7"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_8"
                                                                                         id="img_8"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_9"
                                                                                         id="img_9"></label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Additional image (not necessarily) <input type="file" name="img_10"
                                                                                         id="img_10"></label>
                                    </div>
                                </div>
                                <hr>
                                <input type="submit" class="btn btn-success btn-block col-12" value="Add">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-5">
        <div class="row">
            @foreach($categoriesList as $category)
                <a href="{{ route('productOfCategory', $category->id) }}" class="btn btn-outline-warning col-md-2">
                    {{ $category->tittle }}
                </a>
            @endforeach
        </div>
    @endsection
@endif
