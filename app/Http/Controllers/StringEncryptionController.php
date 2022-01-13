<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StringEncryptionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @author Moose <moosecodes@gmail.com>
     */
    public function __invoke(Request $request)
    {
        $params = $this->extractUrlParams($request);

        return $this->encrypt($params['text'], $params['cipher']);
    }

    /**
     * Takes input string and encrypts is it valid OpenSSL cipher
     *
     * @param [Request] $request
     * @return [Array] $response;
     */
    protected function encrypt(Request $request) {
        if($request->has('cipher') && $request->has('text')) {
            $cipher = $request->input('cipher');
            $text = $request->input('text');
            $response = 'response default';

            if (strlen($text) > 0 && in_array($cipher, openssl_get_cipher_methods(true)))
            {
                $key_length = openssl_cipher_iv_length($cipher);
                if($key_length > 0){
                    $key = openssl_random_pseudo_bytes($key_length);
                    $iv_length = openssl_cipher_iv_length($cipher);
                    $iv = openssl_random_pseudo_bytes($iv_length);
                    $encrypted = openssl_encrypt($text, $cipher, $key, $options = 0, $iv, $tag);
                    $response = [
                        'cipher' => $cipher,
                        'encrypted_text' => $encrypted,
                        'original_text' => $text,
                        'iv_base64' => base64_encode($iv),
                        'passphrase_base64' => base64_encode($key),
                    ];
                } else {
                    $encrypted = openssl_encrypt($text, $cipher, "session('key')");
                    $response = [
                        'cipher' => $cipher,
                        'encrypted_text' => $encrypted,
                        'original_text' => $text,
                    ];
                }
            }
        } else {
            return 'invalid/missing parameters (cipher and/or text)';
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

    protected function genPrivateKey() {
        // Create the keypair
        $res=openssl_pkey_new();

        // Get private key
        openssl_pkey_export($res, $privkey, "PassPhrase number 1" );

        // Get public key
        $pubkey=openssl_pkey_get_details($res);
        $pubkey=$pubkey["key"];
        var_dump($privkey);
        echo "<br /><br /><br />";
        var_dump($pubkey);

        // Create the keypair
        $res2=openssl_pkey_new();

        // Get private key
        openssl_pkey_export($res2, $privkey2, "password2" );

        // Get public key
        $pubkey2=openssl_pkey_get_details($res2);
        $pubkey2=$pubkey2["key"];
        echo "<br /><br /><br />";
        var_dump($privkey2);
        echo "<br /><br /><br />";
        var_dump($pubkey2);

        $data = "aaaa";

        $iv = openssl_random_pseudo_bytes(32);
        openssl_seal($data, $sealed, $ekeys, array($pubkey, $pubkey2), "AES256", $iv);

        echo "<br /><br /><br />";
        var_dump("sealed");
        var_dump(base64_encode($sealed));
        echo "<br /><br /><br />";

        // Unseal/Open using the encryption keys
        var_dump("E Key 1");
        var_dump(base64_encode($ekeys[0]));
        echo "<br /><br /><br />";
        var_dump("E Key 2");
        var_dump(base64_encode($ekeys[1]));
        echo "<br /><br /><br />";

        // decrypt the data and store it in $open
        if (openssl_open($sealed, $open, $ekeys[1], openssl_pkey_get_private($privkey2  ,"password2"), "AES256", $iv)){
            echo "Here is the opened data: ", $open;
        } else {
            echo "Failed to open data.";
        }

    }

}
