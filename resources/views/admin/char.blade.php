@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
    @extends('admin.layouts.base')
    @section('tittle')
        Characteristics of {{ $category->tittle }}
    @endsection
    @section('content')
        <div class="row">
            <h3 class="col-md-10">Characteristics of {{ $category->tittle }}</h3>
            <hr>
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#orderDetails-">
                Add new characteristics
            </button>
            <hr class="mt-3 mb-3">
        </div>
        <div class="modal fade" id="orderDetails-" tabindex="-1" aria-labelledby="orderDetailsLabel-"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="orderDetailsLabel-">
                            Add new Characteristic
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="{{ route('addChar', $category->id) }}" method="POST">
                                @csrf
                                <div class="form-group mt-3">
                                    <input style="text-align: center" type="text" name="tittle" id="tittle"
                                           placeholder="Tittle..." class="form-control">
                                </div>
                                <div class="form-group mt-3">
                                    <input style="text-align: center" type="text" name="numberInFilter"
                                           id="numberInFilter" placeholder="Number in filter..." class="form-control">
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
            <h6 class="col-md-1">Number in filter</h6>
            <h6 class="col-md-11">Tittle</h6>
            <hr>
            @foreach ($charList as $item)
                <hr>
                <strong class="col-md-1">{{ $item->numberInFilter }}</strong>
                <strong class="col-md-4">{{ $item->tittle }}</strong>
                <button type="button" class="btn btn-outline-success col-md-1" data-bs-toggle="modal"
                        data-bs-target="#valuesModal-{{ $item->id }}">Values
                </button>
                <div class="modal fade" id="valuesModal-{{ $item->id }}" tabindex="-1"
                     aria-labelledby="valuesModalLabel-{{ $item->tittle }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                                <h5 class="modal-title text-center" id="valuesModalLabel-{{ $item->tittle }}">
                                    <strong>Values of {{ $item->tittle }}</strong>
                                </h5>
                            </div>
                            <div class="modal-body text-dark">
                                <a class="row"
                                   href="{{ route('admCharValues', ['id'=>$category->id, 'charId'=>$item->id]) }}">
                                    <button type="button" class="btn btn-outline-success">Manage
                                        characteristic
                                    </button>
                                </a>
                                <hr>
                                <div class="text-center">
                                    @foreach ($valueList as $value)
                                        @if ($value->char == $item->id)
                                            <strong> |{{ $value->value }}| </strong>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-success col-md-2" data-bs-toggle="modal"
                        data-bs-target="#addValueModal-{{ $item->id }}">Add value
                </button>
                <div class="modal fade" id="addValueModal-{{ $item->id }}" tabindex="-1"
                     aria-labelledby="addValueModalLabel-{{ $item->tittle }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                                <h5 class="modal-title text-center" id="addValueModalLabel-{{ $item->tittle }}">
                                    <strong>Add value of {{ $item->tittle }}</strong>
                                </h5>
                            </div>
                            <div class="modal-body text-dark">
                                <div>
                                    <form
                                        action="{{ route('addCharValue', ['id'=>$category->id, 'charId'=>$item->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group mt-3">
                                            <input type="text" name="value" id="value" placeholder="Value..."
                                                   class="form-control text-center">
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="text" name="numberInFilter" id="numberInFilter"
                                                   placeholder="Number in filter..." class="form-control text-center">
                                        </div>
                                        <hr>
                                        <input type="submit" class="btn btn-success btn-block col-12" value="Create">
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-warning col-md-2" data-bs-toggle="modal"
                        data-bs-target="#changeModal-{{ $item->id }}">Change tittle
                </button>
                <div class="modal fade" id="changeModal-{{ $item->id }}" tabindex="-1"
                     aria-labelledby="changeModalLabel-{{ $item->tittle }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                                <h5 class="modal-title text-center" id="changeModalLabel-{{ $item->tittle }}">
                                    <strong>Change tittle {{ $item->tittle }}</strong>
                                </h5>
                            </div>
                            <div class="modal-body text-dark">
                                <div>
                                    <form action="{{ route('changeChar', ['id'=>$category->id, 'charId'=>$item->id]) }}"
                                          method="POST">
                                        @csrf
                                        <div class="form-group mt-3">
                                            <input type="text" name="tittle" id="tittle"
                                                   placeholder="Tittle..." class="form-control text-center"
                                                   value="{{ $item->tittle }}">
                                        </div>
                                        <hr>
                                        <input type="submit" class="btn btn-success btn-block col-12" value="Change">
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-danger col-md-2" data-bs-toggle="modal"
                        data-bs-target="#removeModal-{{ $item->id }}">Remove
                </button>
                <div class="modal fade" id="removeModal-{{ $item->id }}" tabindex="-1"
                     aria-labelledby="removeModalLabel-{{ $item->tittle }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                                <h5 class="modal-title text-center" id="removeModalLabel-{{ $item->tittle }}">
                                    <strong>Remove {{ $item->tittle }}</strong>
                                </h5>
                            </div>
                            <div class="modal-body text-dark">
                                <div>
                                    You are sure you want to delete the characteristic "{{ $item->tittle }}"?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close
                                </button>
                                <a href="{{ route('removeChar', ['id'=>$category->id, 'charId'=>$item->id]) }}">
                                    <button method="GET" type="button" class="btn btn-outline-danger">Remove</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    @endsection
@endif
