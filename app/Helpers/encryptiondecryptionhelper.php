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



   

    public static function encdecId($id,$action)

    {
        $output = false;

        //cipher method
        $ciphering = "BF-CBC";

        
        $encryption_iv = "8ZtyeBqt";
        //echo "</br>".$iv_length;
        $options = 0;

        

        // encryption key
        $encryption_key = "aopasffewsdjkad";

        

        


        // Encryption process
        if ($action == 'encrypt')
        {

           

            $output = openssl_encrypt($id, $ciphering,

	        $encryption_key, $options, $encryption_iv);

            // Base64 encode the encrypted result
            $output = base64_encode($output);
        }
        //decryption 
        else if($action =='decrypt')
        {

           // Base64 decode the ID
             $id = base64_decode($id);

            $output = openssl_decrypt($id, $ciphering,

	                    $encryption_key, $options, $encryption_iv);

        }
       
        return $output;
    }
}    

?>