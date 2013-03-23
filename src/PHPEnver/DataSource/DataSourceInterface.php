<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ftassi
 * Date: 23/03/13
 * Time: 16:43
 * To change this template use File | Settings | File Templates.
 */

namespace PHPEnver\DataSource;


interface DataSourceInterface {

    /**
     * @param $key
     * @return string
     */
    public function get($key);

    /**
     * @param $key
     * @param $value
     * @return boolean
     */
    public function set($key, $value);

    /**
     * @param $key
     * @return boolean
     */
    public function delete($key);

    /**
     * @return array
     */
    public function getKeys();
}