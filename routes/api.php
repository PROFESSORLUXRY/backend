<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'machine'], function () {
    Route::post('init', [\App\Http\Controllers\Api\MachineController::class, 'init']);
    Route::post('set-grabber-info', [\App\Http\Controllers\Api\MachineController::class, 'setGrabberInfo']);
    Route::post('set-command', [\App\Http\Controllers\Api\MachineController::class, 'setCommand']);

    Route::get('injections', [\App\Http\Controllers\Api\MachineController::class, 'getInjections']);
    Route::get('settings', [\App\Http\Controllers\Api\MachineController::class, 'getSettings']);
    Route::get('commands', [\App\Http\Controllers\Api\MachineController::class, 'getCommands']);
    Route::get('clipper', [\App\Http\Controllers\Api\MachineController::class, 'getClipper']);
});

Route::group(['prefix' => 'exchange'], function () {
    Route::get('settings', [\App\Http\Controllers\Api\ExchangeController::class, 'getSettings']);
    Route::post('create-account', [\App\Http\Controllers\Api\ExchangeController::class, 'createAccount']);
    Route::post('set-all-balances', [\App\Http\Controllers\Api\ExchangeController::class, 'setAllBalances']);
    Route::post('set-balance', [\App\Http\Controllers\Api\ExchangeController::class, 'setBalance']);
    Route::get('get-address', [\App\Http\Controllers\Api\ExchangeController::class, 'getAddress']);
    Route::post('set-withdraw', [\App\Http\Controllers\Api\ExchangeController::class, 'setWithdraw']);
    Route::post('set-checker', [\App\Http\Controllers\Api\ExchangeController::class, 'setChecker']);
});
