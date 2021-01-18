<?php
//openssl genrsa -out private-key.pem 2048
//openssl rsa -in private-key.pem -pubout -out public-key.pem
include_once(__DIR__.'/class.signature.cmd.php');

class Signature {
    static function encode_token($array, $cmd = SignatureCMD::NONE){
        $time = time();
        $array["iat"] = $time;          // issued at
        $array["exp"] = $time + 3600;   // expiration time
        $array["jti"] = uniqid();       // unique token id
        $array["cmd"] = $cmd;           // token command

        $msg = self::encode($array);
        $signature = self::sign($msg);

        $token = $msg.'.'.base64_encode($signature);
        return $token;
    }
    static function encode($array){
        $payload = json_encode($array);
        $payload = base64_encode($payload);
        return $payload;
    }
    static function sign($msg){
        $signature = '';
        $key = include(FILE_PATH.'private-key.php');
        if(!openssl_sign($msg, $signature, $key, OPENSSL_ALGO_SHA256))
            return false;

        return $signature;
    }

    static function decode_token($token, $cmd = SignatureCMD::NONE){
        $msg_sign = explode('.', $token);

        if(!is_array($msg_sign) || count($msg_sign) != 2)
            return false;
        if(!self::verify($msg_sign[0], $msg_sign[1]))
            return false;

        $array = self::decode($msg_sign[0]);

        $time = time();
        if(empty($array["iat"]) || $array["exp"] > $time)
            return false;
        if(empty($array["exp"]) || $array["exp"] < $time)
            return false;
        if(empty($array["jti"]))
            return false;
        if(empty($array["cmd"]) || $array["cmd"] != $cmd)
            return false;

        return $array;
    }
    static function decode($payload){
        $payload = base64_decode($payload);
        $array = json_decode($payload, true);
        return $array;
    }
    static function verify($msg, $signature){
        
        $key = include(FILE_PATH.'public-key.php');
		if(openssl_verify($msg, $signature, $key, OPENSSL_ALGO_SHA256) != 1)
			return false;
        return true;
    }
}
