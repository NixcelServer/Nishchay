<?php

namespace App\Helpers;

class EncryptionDecryptionHelper{



    public static function encryptData($data){
        $output = false;
        $cipher_method = 'AES-256-CBC';
        $encryption_iv = '3751f5684539a8b6';
        $options = 0;
        $encryption_key = "ajjasdfjasdjlad";
        $output = openssl_encrypt($data, $cipher_method, $encryption_key, $options, $encryption_iv);
        return $output;

    }

    public static function decryptData($data){
        $output = false;
        $cipher_method = 'AES-256-CBC';
        $encryption_iv = '3751f5684539a8b6';
        $options = 0;
        $encryption_key = "ajjasdfjasdjlad";
        $output = openssl_decrypt($data, $cipher_method, $encryption_key, $options, $encryption_iv);
        return $output;
    }
}


?>