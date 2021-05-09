<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Sha256Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @author Moose <moosecodes@gmail.com>
     */
    public function __invoke(Request $request): string
    {
        if (!$request->token) {
            return 'No token provided. Please provide a string to encrypt.';
        }
        if ($request->decrypt) {
            return $this->unHashString($request->token);
        }
        return $this->hashString($request->token);
    }

    /**
     * Encrypts strings using AES-256-CBC
     *
     * @param string $token
     * @return string
     * 
     * @author Moose <moosecodes@gmail.com>
     */
    protected function hashString($token): string {
        return $encryptedValue = Crypt::encryptString($token);
    }

    /**
     * Decrypts strings encoded with AES-256-CBC
     *
     * @param string $encryptedValue
     * @return string
     * 
     * @author Moose <moosecodes@gmail.com>
     */
    protected function unHashString($encryptedValue): string {
        try {
            $decrypted = Crypt::decryptString($encryptedValue);
        } catch (DecryptException $e) {}

        return $decrypted;
    }
}
