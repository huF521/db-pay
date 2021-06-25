<?php

namespace DbPay;

class BaseServer
{
    protected static $instance;

    /**
     * @param array $config
     * @return static
     */
    public static function getInstance($config = [])
    {
        $class = get_called_class();
        if (empty(self::$instance)) self::$instance = new $class($config);
        return self::$instance = new static($config);
    }

    public function __construct($config)
    {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
