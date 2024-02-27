<?php

namespace App\Helpers;
use App\Helpers\customEncryptFunction;

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


    public static function encdecId($string,$action)
    {
        $output = false;

        //cipher method
        $ciphering = "BF-CBC";

        
        $encryption_iv = "8ZtyeBqt";
        //echo "</br>".$iv_length;
        $options = 0;

        

        // encryption key
        $encryption_key = "aopasffewsdjkad";
        //echo "</br>".$encryption_key;

        // Encryption process
        if ($action == 'encrypt')
        {
            $output = openssl_encrypt($string, $ciphering,
	        $encryption_key, $options, $encryption_iv);
        }
        //decryption 
        else if($action =='decrypt')
        {
            $output = openssl_decrypt($string, $ciphering,
	                    $encryption_key, $options, $encryption_iv);

        }
       
        return $output;
    }
}    

?>