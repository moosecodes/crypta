<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChatBotController extends Controller
{
    /**
     * Takes input string and encrypts is it valid OpenSSL cipher
     *
     * @param [Request] $request
     * @return [Array] $response;
     */
    protected function send(Request $request) {
        // dd($request);
        if (!Schema::hasTable('a')) {
            Schema::create('a', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('times_accessed');
                $table->string('message');
                $table->timestamps();
            });
        } else {
            
        }
        echo $request->message;
        return Schema::hasTable('a');
    }
}
