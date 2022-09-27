<?php
function encrypt($string, $action){
    $encrypt_method = "camellia128";
    $secret_key = '02a256ab821c06d56aceeaefd4f39d5f';
    $secret_iv = '1fcf5HJ4g21';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
?>