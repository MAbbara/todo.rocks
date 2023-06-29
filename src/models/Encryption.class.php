<?php

class Encryption {

    static function encrypt($listID, $text) {
        $cipher_method = 'aes-128-ctr';

        $hash = hash("sha3-512", $listID);
        $key = $_ENV['ENC_KEY'] . $hash;

        $enc_key = openssl_digest($key, 'SHA256', TRUE);
        $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
        $crypted_token = openssl_encrypt($text, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
        
        return $crypted_token;
    }

    static function decrypt($listID, $encrypted_text) {
        $cipher_method = 'aes-128-ctr';

        $hash = hash("sha3-512", $listID);
        $key = $_ENV['ENC_KEY'] . $hash;

        list($crypted_token, $enc_iv) = explode("::", $encrypted_text);
        $enc_key = openssl_digest($key, 'SHA256', TRUE);
        $message = openssl_decrypt($crypted_token, $cipher_method, $enc_key, 0, hex2bin($enc_iv));

        return $message;
    }
}