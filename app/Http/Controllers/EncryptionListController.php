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
        $ciphers = openssl_get_cipher_methods();
        $response = [];


        for($i = 0; $i < count($ciphers); $i++) {
            $response[$i]['method'] = [$ciphers[$i]];
            $response[$i]['passphrase'] = false;

            if(isset($ciphers[$i]['method'])){
                $response[$i]['passphrase'] = true;
            }
        }
        return response()->json($response);
    }
}
