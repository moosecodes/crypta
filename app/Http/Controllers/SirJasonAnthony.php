<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SirJasonAnthony extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $list = openssl_get_cipher_methods();
        return $list;
    }
}
