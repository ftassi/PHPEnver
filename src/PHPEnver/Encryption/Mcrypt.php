<?php

namespace PHPEnver\Encryption;

use Illuminate\Encryption\Encrypter;

class Mcrypt implements EncryptionStrategy
{
    protected $key;

    protected $encrypter;

    function __construct($key)
    {
        $this->encrypter = new Encrypter($key);
    }

    /**
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        $encryptedData = base64_decode($data);
        return $this->encrypter->decrypt($encryptedData);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function encrypt($data)
    {
        $encryptedData = $this->encrypter->encrypt($data);
        return base64_encode($encryptedData);
    }
}
