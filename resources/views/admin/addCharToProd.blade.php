@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
    @extends('admin.layouts.base')
    @section('tittle')
        Add characteristics to {{ $product->tittle }}
    @endsection
    @section('content')
        <div class="row">
            <h3 class="col-md-10">Characteristics of {{ $product->tittle }}</h3>
            <hr>
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#newProdChar-">
                Add new characteristic
            </button>
            <hr class="mt-3 mb-3">
        </div>
        <div class="modal fade" id="newProdChar-" tabindex="-1" aria-labelledby="newProdCharLabel-"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="newProdCharLabel-">
                            Add new Characteristic
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="{{ route('addChar', $product->id) }}" method="POST">
                                @csrf
                                <div class="form-group mt-3">
                                    <select name="char">
                                        @foreach ($charsList as $char)
                                            <option value="{{ $char->id }}"
                                                    data-class="{{ $char->id }}">{{ $char->tittle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <select name="value">
                                        @foreach ($valuesList as $value)
                                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="numberInFilter"
                                           id="numberInFilter" placeholder="Number in filter..."
                                           class="form-control text-center">
                                </div>
                                <hr>
                                <input type="submit" class="btn btn-success btn-block col-12" value="Add">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h6 class="col-md-1">Number in list</h6>
            <h6 class="col-md-4">Tittle</h6>
            <h6 class="col-md-7">Value</h6>
            <hr class="mb-5">
        </div>
        <div class="row">
            @foreach($charsList as $char)
                <hr>
                <strong class="col-md-1">{{ $char->numberInFilter }}</strong>
                <a class="btn btn-outline-warning col-md-2 ">{{ $char->tittle }}</a>
                @if(!isset($prodCharsList))
                    @foreach($prodCharsList as $prodChar)
                        @if($prodChar->char == $char->id)
                            @foreach($valuesList as $value)
                                @if($value->id == $prodChar->$value)
                                    <strong class="col-md-9">{{ $value->value }}</strong>
                                @endif
                            @endforeach
                        @else
                            <strong class="col-md-9"></strong>
                        @endif
                    @endforeach
                @else
                    <strong class="col-md-9"></strong>
                @endif
                <hr>
            @endforeach
        </div>
    @endsection
@endif
{{--            numInList--}}
