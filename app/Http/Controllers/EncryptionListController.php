<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $list = [
            'AES-256-CBC'
        ];
        
        return $list;
    }
}
