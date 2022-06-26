@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
@extends('admin.layouts.base')
@section('tittle')
Categories
@endsection
@section('content')
<div>
    <h3>Categories</h3>
    <hr>
    <div class="mt-4 row">
        <button style="max-width: 100%" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#orderDetails-">
            Add new category
        </button>
        <hr>
        <h6 class="col-md-12">Tittle</h6>
        <hr>
        @foreach ($data as $item)
        <div class="row">
            <strong class="col-md-5">{{ $item->tittle }}</strong>
            <a class="col-md-2" href="{{ route('admCategoriesChar', $item->id) }}"><button type="button" class="btn btn-outline-success">Characteristic</button></a>
            <button type="button" class="btn btn-outline-warning col-md-2" data-bs-toggle="modal" data-bs-target="#changeModal-{{ $item->id }}">Change tittle</button>
            <div class="modal fade" id="changeModal-{{ $item->id }}" tabindex="-1" aria-labelledby="changeModalLabel-{{ $item->tittle }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-dark">
                            <h5 class="modal-title text-center" id="changeModalLabel-{{ $item->tittle }}">
                                <strong>Change tittle {{ $item->tittle }}</strong>
                            </h5>
                        </div>
                        <div class="modal-body text-dark">
                        <div>
                            <form action="{{ route('changeCategory', $item->id) }}" method="POST">
                                @csrf
                                <div class="form-group mt-3">
                                    <input style="text-align: center" type="text" name="tittle" id="tittle" placeholder="Tittle..." class="form-control" value="{{ $item->tittle }}">
                                </div>
                                <hr>
                                <input type="submit" class="btn btn-success btn-block col-12" value="Change">
                            </form>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger col-md-2" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $item->id }}">Remove</button>
            <div class="modal fade" id="removeModal-{{ $item->id }}" tabindex="-1" aria-labelledby="removeModalLabel-{{ $item->tittle }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-dark">
                            <h5 class="modal-title text-center" id="removeModalLabel-{{ $item->tittle }}">
                                <strong>Remove {{ $item->tittle }}</strong>
                            </h5>
                        </div>
                        <div class="modal-body text-dark">
                        <div>
                            You are sure you want to delete the category "{{ $item->tittle }}"? 
                            All products in this category will also be removed!
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('removeCategory', $item->id) }}"><button method="GET" type="button" class="btn btn-outline-danger">Remove</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    <hr>
    <div class="modal fade" id="orderDetails-" tabindex="-1" aria-labelledby="orderDetailsLabel-" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="orderDetailsLabel-">
                        Add new category
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{ route('addCategory') }}" method="POST">
                            @csrf
                            <div class="form-group mt-3">
                                <input style="text-align: center" type="text" name="tittle" id="tittle" placeholder="Tittle..." class="form-control">
                            </div>
                            <hr>
                            <input type="submit" class="btn btn-success btn-block col-12" value="Add">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif