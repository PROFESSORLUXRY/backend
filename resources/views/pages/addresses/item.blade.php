@extends('pages.layout')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">@if(isset($item))
                                    Edit
                                @else
                                    New
                                @endif Address</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('addresses.create.action') }}" method="POST">
                                @if(isset($item))
                                    <input type="text" class="form-control" name="id" value="{{ $item->id }}" hidden/>
                                @endif

                                @if(isset($item))
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" class="form-control" name="address"
                                               value="{{ $item->address }}"/>
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address"></textarea>
                                        <div class="form-text">Enter BTC address (You can use several via SHIFT +
                                            ENTER)
                                        </div>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary">
                                    @if(isset($item))
                                        Edit
                                    @else
                                        Create
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
