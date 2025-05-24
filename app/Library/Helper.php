<?php
/**
 * 
 */

class Helper{
    function __construct(){}
    
    public static function encrypt($data){
        $passEncrypt = base64_decode(KEY1);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $passEncrypt, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
        }  

    public static function decrypt($data){
        $passEncrypt = base64_decode(KEY1);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        list($encrypted,$iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
        return openssl_decrypt($encrypted, 'aes-256-cbc', $passEncrypt, 0, $iv);
    }
}
?>