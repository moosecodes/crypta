<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class EncryptionListController extends Controller
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
        $response = [];

        for($i = 0; $i < count($list); $i++) {
            $response[$i]['method'] = [$list[$i]];
            $response[$i]['passphrase'] = false;
            die($response[$i]);
            if(openssl_cipher_iv_length($list[$i]) > 0){
                $response[$i]['passphrase'] = true;
            }
        }
        return response()->json($response);
    }
}
