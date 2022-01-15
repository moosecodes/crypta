<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sha1Controller;
use App\Http\Controllers\InputStringsController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\EncryptionListController;
use App\Http\Controllers\ChatBotController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/encryption/list', EncryptionListController::class)->name('encryptionList');

Route::post('/encryption/encrypt', [InputStringsController::class, 'encrypt'])->name('encrypt');
Route::post('/encryption/decrypt', [InputStringsController::class, 'decrypt'])->name('decrypt');
