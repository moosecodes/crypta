<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

const ALLOWED_PARAMETERS = [
    'token',
    'decrypt'
];

const ERROR_STRINGS = [
    'INVALID_PARAMS' => 'Invalid parameters passed: ',
    'NO_TOKEN' => 'No token provided. Please provide a token/string to encrypt your string.',
];

class Aes256CbcController extends Controller
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
        $params = $this->checkParameters($request);

        if (!$params) return ERROR_STRINGS['INVALID_PARAMS'] . $params;

        $token = $request->token;

        $decryptFlag = $request->decrypt;

        if (!$token) return ERROR_STRINGS['NO_TOKEN'];

        if ($decryptFlag) return $this->unHashString($token);

        return $this->hashString($token);
    }

    private function checkParameters($request) {
        $params = [];
        foreach($request as $p) {
            $params[] = $p;
        }
        return $params;
    }

    /**
     * Encrypts strings using AES-256-CBC
     *
     * @param string $token
     * @return string
     * 
     * @author Moose <moosecodes@gmail.com>
     */
    private function hashString($token): string {
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
    private function unHashString($encryptedValue): string {
        try {

            $decrypted = Crypt::decryptString($encryptedValue);

        } catch (DecryptException $e) {}

        return $decrypted;
    }
}
