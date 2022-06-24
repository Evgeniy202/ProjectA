@if ($admin == true)

@extends('admin.layouts.base')

@section('tittle')
Categories
@endsection

@section('content')
<div>
    <h3>Categories</h3>
    <hr>
    <div class="mt-4 row">
        <h6 class="col-md-1">№</h6>
        <h6 class="col-md-11">Tittle</h6>
        <hr>
        @foreach ($data as $item)
        <div class="row">
            <strong class="col-md-1">{{ $item->id }}</strong>
            <strong class="col-md-6">{{ $item->tittle }}</strong>
            <button type="button" class="btn btn-outline-warning col-md-2">Change</button>
            <button type="button" class="btn btn-outline-danger col-md-2" data-bs-toggle="modal" data-target=".bd-example-modal-sm"-{{ $item->id }}">Remove</button>
            <div class="modal fade" id="#removeCategory-{{ $item->id }}" tabindex="-1" aria-labelledby="#removeCategoryLabel-{{ $item->tittle }}" aria-hidden="true">
                {{-- <div class="modal-dialog modal-xl">
                    <div class="modal-content text-dark">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="#removeCategoryLabel-{{ $item->tittle }}">
                                Remove category
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <form action="{{ route('removeCategory') }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <input style="text-align: center" type="text" name="tittle" id="tittle" class="form-control" value="{{ $item->tittle }}">
                                    </div>
                                    <hr>
                                    <input type="submit" class="btn btn-danger btn-block col-12" value="Remove">
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    <hr>
    <button style="max-width: 100%" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#orderDetails-">
        Add new category
    </button>
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