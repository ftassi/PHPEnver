<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ftassi
 * Date: 30/03/13
 * Time: 16:50
 * To change this template use File | Settings | File Templates.
 */

namespace PHPEnver\Encryption;

use PHPEnver\Encryption\EncryptionStrategy;

class PlainText implements EncryptionStrategy
{

    /**
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function encrypt($data)
    {
        return $data;
    }
}