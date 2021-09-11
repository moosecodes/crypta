<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Sha1Controller;
use App\Http\Controllers\StringEncryptionController;
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

Route::post('/encryption', StringEncryptionController::class)->name('encryptionDefaultRoute');

Route::get('/encryption/list', EncryptionListController::class)->name('encryptionList');
Route::get('/encryption/encrypt', [StringEncryptionController::class, 'encrypt'])->name('encrypt');
Route::post('/encryption/decrypt', [StringEncryptionController::class, 'decrypt'])->name('decrypt');
Route::get('/generate/private-key', [StringEncryptionController::class, 'genPrivateKey'])->name('genPrivateKey');

Route::post('/upload/image', ImageUploadController::class)->name('imageUpload');

Route::post('/chatbot', [ChatBotController::class, 'send'])->name('chatbot');
