<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ftassi
 * Date: 29/03/13
 * Time: 22:25
 * To change this template use File | Settings | File Templates.
 */

namespace PHPEnver\Encryption;


interface EncryptionStrategy {

    /**
     * @param $data
     * @return string
     */
    public function decrypt($data);

    /**
     * @param $data
     * @return mixed
     */
    public function encrypt($data);
}