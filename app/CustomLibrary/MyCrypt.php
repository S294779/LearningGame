<?php

namespace App\CustomLibrary;

/**
 * Description of Crypt
 *
 * @author Sbr
 */
class MyCrypt {

    const private_key = 'Sds_)(+sf@#$%^&*(sdfsdf89456e_)*&*()45355@@#@@**7GDG';
    const public_key = '#9-!~';

    public static function simple_encrypt($plain_text) {
        return strtr(base64_encode($plain_text), self::private_key, self::public_key);
        
    }

    public static function simple_decrypt($encrypted_text) {
        return base64_decode(strtr($encrypted_text, self::public_key,self::private_key));
    }

}
