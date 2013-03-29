<?php

namespace PHPEnver\DataSource;

use PHPEnver\Encryption\EncryptionStrategy;

class JsonDataSource implements DataSourceInterface
{

    /**
     * @var string
     */
    protected $file;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var \PHPEnver\Encryption\EncryptionStrategy
     */
    protected $encryptionStrategy;

    /**
     * @param $file
     * @param EncryptionStrategy $encryptionStrategy
     */
    public function __construct($file, EncryptionStrategy $encryptionStrategy)
    {
        $this->file = $file;
        $this->encryptionStrategy = $encryptionStrategy;
    }

    /**
     * @param $key
     * @return string
     */
    public function get($key)
    {
        $this->readData();
        return $this->encryptionStrategy->decrypt($this->data[$key]);
    }

    /**
     * @param $key
     * @param $value
     * @return boolean
     */
    public function set($key, $value)
    {
        $cryptedData = $this->encryptionStrategy->encrypt($value);
        $this->readData();
        $this->data[$key] = $cryptedData;
        return $this->saveData();
    }

    /**
     * @param $key
     * @return boolean
     */
    public function delete($key)
    {
        $this->readData();
        unset($this->data[$key]);
        return $this->saveData();
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        $this->readData();
        return array_keys($this->data);
    }

    protected function readData()
    {
        if (is_null($this->data)) {
            $json = file_get_contents($this->file);
            $this->data = json_decode($json, true);
        }
    }

    /**
     * @return bool
     */
    protected function saveData()
    {
        return (boolean)file_put_contents($this->file, json_encode($this->data));
    }
}
