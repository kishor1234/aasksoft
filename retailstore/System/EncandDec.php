<?php

class EncandDec {

    function Encrypt($data) {
        $password = "a72a3e70842476f26e97cb02b951e298";
        $salt = substr(md5(mt_rand(), true), 8);

        $key = md5($password . $salt, true);
        $iv = md5($key . $password . $salt, true);

        $ct = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);

        return base64_encode('Salted__' . $salt . $ct);
        //return $this->base64url_encode($ct);
    }

    function Decrypt($data) {
        $password = "a72a3e70842476f26e97cb02b951e298";
        $data = base64_decode($data);
        $salt = substr($data, 8, 8);
        $ct = substr($data, 16);

        $key = md5($password . $salt, true);
        $iv = md5($key . $password . $salt, true);

        $pt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ct, MCRYPT_MODE_CBC, $iv);

        return $pt;
        //return $this->base64url_decode($pt);
    }
    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
    
    function enc_Text($data)
    {
        return $this->base64url_encode($this->Encrypt($data));
    }
    function dec_Text($data)
    {
        return $this->Decrypt($this->base64url_decode($data));
    }
}
//$test=new EncandDec();
//echo $test->Encrypt("kishor4shinde@gmail.com");
//echo $test->base64url_encode("kishor4shinde@gmail.com");
//echo "<br>";
//echo $test->Decrypt("U2FsdGVkX19FfGVKNMb3AaPtVZI1UAUiQoyd1lkSJV+L1ZeaaUzLVy/oBw3wIGox");
//echo $test->base64url_decode($test->base64url_encode("kishor4shinde@gmail.com"));