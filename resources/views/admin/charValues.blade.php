@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
    @extends('admin.layouts.base')
    @section('tittle')
        Values of {{ $char->tittle }}
    @endsection
    @section('content')
        <div class="row">
            <h3 class="col-md-10">Characteristics of {{ $char->tittle }}</h3>
            <hr>
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#orderDetails-">
                Add new value
            </button>
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
                                <form
                                    action="{{ route('addValue', ['id'=>$categoryId, 'charId'=>$char->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <input style="text-align: center" type="text" name="value" id="value"
                                               placeholder="Value..." class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input style="text-align: center" type="text" name="numberInFilter"
                                               id="numberInFilter" placeholder="Number in filter..."
                                               class="form-control">
                                    </div>
                                    <hr>
                                    <input type="submit" class="btn btn-success btn-block col-12" value="Add">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-3 mb-3">
        </div>
        <div class="row">
            <h6 class="col-md-2">Number in filter</h6>
            <h6 class="col-md-10">Tittle</h6>
            <hr>
            @foreach ($valuesList as $value)
                <hr>
                <strong class="col-md-2">{{ $value->numberInFilter }}</strong>
                <strong class="col-md-5">{{ $value->value }}</strong>
                <button type="button" class="btn btn-outline-warning col-md-2" data-bs-toggle="modal"
                        data-bs-target="#changeModal-{{ $value->id }}">Change tittle
                </button>
                <div class="modal fade" id="changeModal-{{ $value->id }}" tabindex="-1"
                     aria-labelledby="changeModalLabel-{{ $value->value }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                                <h5 class="modal-title text-center" id="changeModalLabel-{{ $value->value }}">
                                    <strong>Change value {{ $value->value }}</strong>
                                </h5>
                            </div>
                            <div class="modal-body text-dark">
                                <div>
                                    <form
                                        action="{{ route('changeValue', ['id'=>$categoryId, 'charId'=>$char->id, 'valueId'=>$value->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group mt-3">
                                            <input type="text" name="value" id="value"
                                                   placeholder="Value..." class="form-control text-center"
                                                   value="{{ $value->value }}">
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
                        data-bs-target="#removeModal-{{ $value->id }}">Remove
                </button>
                <div class="modal fade" id="removeModal-{{ $value->id }}" tabindex="-1"
                     aria-labelledby="removeModalLabel-{{ $value->value }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                                <h5 class="modal-title text-center" id="removeModalLabel-{{ $value->value }}">
                                    <strong>Remove {{ $value->value }}</strong>
                                </h5>
                            </div>
                            <div class="modal-body text-dark">
                                <div>
                                    You are sure you want to delete the characteristic "{{ $value->value }}"?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close
                                </button>
                                <a href="{{ route('removeValue', ['id'=>$categoryId, 'charId'=>$char->id, 'valueId'=>$value->id]) }}">
                                    <button method="GET" type="button" class="btn btn-outline-danger">Remove</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
        @endforeach
    @endsection
@endif
