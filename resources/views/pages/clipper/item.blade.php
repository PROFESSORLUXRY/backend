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
                                @endif Clipper</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('clipper.create.action') }}" method="POST">
                                @if(isset($item))
                                    <input type="text" class="form-control" name="id" value="{{ $item->id }}" hidden/>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label" for="url">Rule</label>
                                    <input type="text" class="form-control" name="reg" id="reg"
                                           placeholder="(3[a-zA-HJ-NP-Z0-9]{25,59})"
                                           @if(isset($item)) value="{{ $item->reg }}" @endif />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="url">Rule</label>
                                    <input type="text" class="form-control" name="value" id="value"
                                           placeholder="3NA22JyuX4iW63PgGxS6wGygPUHE69npbd"
                                           @if(isset($item)) value="{{ $item->value }}" @endif />
                                </div>

                                <button type="submit" class="btn btn-primary">@if(isset($item))
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
