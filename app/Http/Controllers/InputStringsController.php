<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputStrings;

class InputStringsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * @author Moose <moosecodes@gmail.com>
     */
    public function __invoke(Request $request)
    {
        $params = $this->extractUrlParams($request);
        return $this->encrypt($params['text'], $params['cipher']);
    }

    private function processData($data, $method) {
        var_dump($method);
        $key_length = openssl_cipher_iv_length($method);
        
        if($key_length > 0) {
            $key = openssl_random_pseudo_bytes($key_length);
            $iv_length = openssl_cipher_iv_length($method);
            $iv = openssl_random_pseudo_bytes($iv_length);
            $encrypted = openssl_encrypt($data, $method, $key, $options = 0, $iv, $tag);
            return [
                'cipher' => $method,
                'algorithm' => $method,
                'original_text' => $data,
                'encrypted_text' => $encrypted,
                'iv_base64' => base64_encode($iv),
                'passphrase_base64' => base64_encode($key),
            ];
        } else {
            $passphrase = "moosecodes-passphrase";
            $encrypted = openssl_encrypt($data, $method, $passphrase);
            return [
                'cipher' => $method,
                'algorithm' => $method,
                'original_text' => $data,
                'encrypted_text' => $encrypted,
                'passphrase' => $passphrase
            ];
        }
    }

    private function save($response) {
        $input = new InputStrings;
        $input->cipher = $response['cipher'];
        $input->algorithm = $response['cipher'];
        $input->encrypted_text = $response['encrypted_text'];
        $input->original_text = $response['original_text'];
        $input->iv_base64 = $response['iv_base64'] ?? null;
        $input->passphrase_base64 = $response['passphrase_base64'] ?? null;
        $input->save();
    }

    /**
     * Takes input string and encrypts is it valid OpenSSL cipher
     *
     * @param [Request] $request
     * @return [Array] $response;
     */
    protected function encrypt(Request $request) {
        if($request->has('cipher') && $request->has('text')) {
            $method = $request->input('cipher');
            $data = $request->input('text');
            $response = 'default response';

            if (strlen($data) > 0 && in_array($method, openssl_get_cipher_methods(true)))
            {
                $response = $this->processData($data, $method);
                $this->save($response);
            }
        } else {
            return 'invalid or missing parameters';
        }

        return $response;
    }

    protected function decrypt(Request $request) {
        echo $request->getContent();
        if($request->has('data')) {
            $data = json_decode($request->input('data'), true);
            $cipher = $data['cipher'];
            $encrypted_text = base64_decode($data['encrypted_text']);
            $key = base64_decode($data['passphrase_base64']);
            $iv = base64_decode($data['iv_base64']);
            echo openssl_decrypt($encrypted_text, $cipher, $key);
            return openssl_decrypt($encrypted_text, $cipher, $key);
        }
        return "no freakin' data";
    }
}
