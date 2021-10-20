<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendBulkMailController;

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

Route::get('/', function () {
    return view('signup');
});

Route::post('send-bulk-mail', [SendBulkMailController::class, 'sendBulkMail'])->name('send-bulk-mail');