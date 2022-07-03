@if (($admin == true) && ($accessLevel < 3) && ($accessLevel > 0))
    @extends('admin.layouts.base')
    @section('tittle')
        Add characteristics to {{ $product->tittle }}
    @endsection
    @section('content')
        @php
            $arrayValues = [];
            foreach ($prodCharsList as $pc){
                array_push($arrayValues, $pc->char);
            }
        @endphp
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <div class="row">
            <h3 class="col-md-10">Characteristics of {{ $product->tittle }}</h3>
            <hr>
            <button type="button" class="btn btn-outline-success col-md-9" data-bs-toggle="modal"
                    data-bs-target="#newProdChar-">
                Add new characteristic
            </button>
            <a href="{{ route('admCategoriesChar', $product->category) }}" class="btn btn-outline-warning col-md-3">
                Characteristics manage
            </a>
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
                            <form action="{{ route('addCharToProduct', $product->id) }}" method="POST">
                                @csrf
                                <div class="form-group mt-3">
                                    <select name="char" class="form-control text-center" id="char">
                                        <option>-Select characteristic-</option>
                                        @foreach ($charsList as $char)
                                            @if(!in_array($char->id, $arrayValues))
                                                <option value="{{ $char->id }}"
                                                        data-class="{{ $char->id }}">{{ $char->tittle }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <select name="value" class="form-control text-center" id="value">
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="numberInList" id="numberInList"
                                           placeholder="Number in list"
                                           class="form-control text-center">
                                </div>
                                <hr>
                                <input type="submit" class="btn btn-success btn-block col-12" value="Add">
                                <script>
                                    $(document).ready(function () {
                                        $('#char').on('change', function () {
                                            var charID = $(this).val();
                                            if (charID) {
                                                $.ajax({
                                                    url: '/admin/adm/products/add_char/{{ $productId }}/' + charID,
                                                    type: "GET",
                                                    data: {"_token": "{{ csrf_token() }}"},
                                                    dataType: "json",
                                                    success: function (data) {
                                                        if (data) {
                                                            $('#value').empty();
                                                            $('#value').focus;
                                                            $('#value').append('<option value="">-Select value of characteristic-</option>');
                                                            $.each(data, function (key, value) {
                                                                $('select[name="value"]').append('<option value="' + value.id + '">' + value.value + '</option>');
                                                            });
                                                        } else {
                                                            $('#value').empty();
                                                        }
                                                    }
                                                });
                                            } else {
                                                $('#value').empty();
                                            }
                                        });
                                    });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h6 class="col-md-1">Number in list</h6>
            <h6 class="col-md-3">Tittle</h6>
            <h6 class="col-md-8">Value</h6>
            <hr class="mb-5">
        </div>
        <div class="row">
            @foreach($prodCharsList as $prodChar)
                @foreach($charsList as $char)
                    @if($char->id == $prodChar->char)
                        @foreach($valuesList as $value)
                            @if($value->id == $prodChar->value)
                                <hr>
                                <strong class="col-md-1">{{ $prodChar->numberInList }}</strong>
                                <strong class="col-md-3 ">{{ $char->tittle }}</strong>
                                <p class="col-md-5">{{ $value->value }}</p>
                                <button type="button" class="btn btn-outline-warning col-md-2" data-bs-toggle="modal"
                                        data-bs-target="#changeChar-{{ $prodChar->id }}">Change
                                </button>
                                <div class="modal fade" id="changeChar-{{ $prodChar->id }}" tabindex="-1"
                                     aria-labelledby="changeChar-{{ $prodChar->id }}"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content text-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="changeChar-{{ $prodChar->id }}">
                                                    Change characteristic "{{ $char->tittle }}"
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <form
                                                        action="{{ route('changeCharToProduct', ['productId'=>$product->id, 'prodCharId'=>$prodChar->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="form-group mt-3">
                                                            <select name="changeValue" class="form-control text-center"
                                                                    id="changeValue">
                                                                @foreach ($valuesList as $value)
                                                                    @if($char->id == $value->char)
                                                                        <option value="{{ $value->id }}"
                                                                                data-class="{{ $value->id }}">{{ $value->value }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <input type="text" name="numberInList" id="numberInList"
                                                                   placeholder="Number in list" value="{{ $prodChar->numberInList }}"
                                                                    class="form-control text-center">
                                                        </div>
                                                        <hr>
                                                        <input type="submit" class="btn btn-warning btn-block col-12"
                                                               value="Change">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-danger col-md-1" data-bs-toggle="modal"
                                        data-bs-target="#removeModal-{{ $char->id }}">Remove
                                </button>
                                <div class="modal fade" id="removeModal-{{ $char->id }}" tabindex="-1"
                                     aria-labelledby="removeModal-{{ $char->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header text-dark">
                                                <h5 class="modal-title text-center" id="removeModal-{{ $char->id }}">
                                                    <strong>Remove {{ $char->tittle }}</strong>
                                                </h5>
                                            </div>
                                            <div class="modal-body text-dark">
                                                <div>
                                                    You are sure you want to delete the
                                                    characteristic {{ $char->tittle }} of {{ $product->tittle }}?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Close
                                                </button>
                                                <a href="{{ route('removeCharToProduct', ['productId'=>$productId, 'prodCharId'=>$prodChar->id]) }}"
                                                   class="btn btn-outline-danger">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        </div>
    @endsection
@endif
{{--            numInList--}}
