<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\app\Http\Controllers\SettingController;

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

Route::group([ "prefix"=> "admin","middleware"=> ["web","auth"]], function () {
    Route::resource('setting', SettingController::class)->except('update','destroy')->names('admin.settings');
    Route::put('/admin/settings', [SettingController::class,'update'])->name('admin.settings.update');
    Route::post('/admin/settings/delete/{setting}', [SettingController::class,'destroy'])->name('admin.settings.destroy');
});
