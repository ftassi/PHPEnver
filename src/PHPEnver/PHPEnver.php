<?php

namespace PHPEnver;

use PHPEnver\DataSource\DataSourceInterface;

class PHPEnver
{

    /**
     * @var DataSourceInterface $dataSource
     */
    protected $dataSource;

    function __construct(DataSourceInterface $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @param $key
     * @return string
     */
    public function get($key)
    {
        return $this->dataSource->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value)
    {
        return $this->dataSource->set($key, $value);
    }

    /**
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        return $this->dataSource->delete($key);
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return $this->dataSource->getKeys();
    }
}
