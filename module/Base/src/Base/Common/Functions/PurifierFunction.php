<?php

namespace Base\Common\Functions;

class PurifierFunction
{
    private static $instance;
    private $purifier;

    private function __construct()
    {
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', '');
        $config->set('Core.Encoding', 'UTF-8');
        $this->purifier = new \HTMLPurifier($config);
    }

    /**
     * @return \HTMLPurifier
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new self;
        }
        return static::$instance;
    }

    /**
     * @param $string
     * @return string
     */
    public function purify($string)
    {
        return trim($this->purifier->purify($string));
    }
}