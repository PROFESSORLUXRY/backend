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
                                @endif Cookie</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cookie_settings.create.action') }}" method="POST">
                                @if(isset($item))
                                    <input type="text" class="form-control" name="id" value="{{ $item->id }}" hidden/>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Facebook"
                                           @if(isset($item)) value="{{ $item->name }}" @endif />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="icon_url">Icon Url</label>
                                    <input type="text" class="form-control" name="icon_url" id="icon_url"
                                           placeholder="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Facebook_icon.svg/800px-Facebook_icon.svg.png"
                                           @if(isset($item)) value="{{ $item->icon_url }}" @endif />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="url">Name</label>
                                    <input type="text" class="form-control" name="url" id="url"
                                           placeholder="facebook.com"
                                           @if(isset($item)) value="{{ $item->url }}" @endif />
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
