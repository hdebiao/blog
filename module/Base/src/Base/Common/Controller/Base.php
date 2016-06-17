<?php

namespace Base\Common\Controller;

use Base\Common\Functions\Util;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;

class Base extends AbstractActionController
{
    public $config;
    public $dbs = [];
    public $tables = [];
    public $redis;

    /**
     * @return array
     */
    public function getConfig()
    {
        if (null === $this->config) {
            try {
                $this->config = $this->getServiceLocator()->get('config');
            } catch (\Exception $e) {
                error_log(
                    $e->getMessage() . PHP_EOL .
                    $e->getTraceAsString() . PHP_EOL
                );
            }
        }

        return $this->config;
    }

    /**
     * @param string $db
     * @return \Zend\Db\Adapter\Adapter
     */
    public function getDB($db = 'db')
    {
        if (!array_key_exists($db, $this->dbs)) {
            try {
                $this->dbs[$db] = $this->getServiceLocator()->get($db);
            } catch (\Exception $e) {
                error_log(
                    $e->getMessage() . PHP_EOL .
                    $e->getTraceAsString() . PHP_EOL
                );
            }
        }
        return $this->dbs[$db];
    }

    /**
     * @param $table
     * @param string $db
     * @return \Zend\Db\TableGateway\TableGateway
     */
    public function getTable($table, $db = 'db')
    {
        if (!array_key_exists($table, $this->tables)) {
            try {
                $this->tables[$table] = new TableGateway($table, $this->getDB($db));
            } catch (\Exception $e) {
                error_log(
                    $e->getMessage() . PHP_EOL .
                    $e->getTraceAsString() . PHP_EOL
                );
            }
        }
        return $this->tables[$table];
    }

    /**
     * @return \Redis
     */
    public function redis()
    {
        if (null === $this->redis) {
            try {
                $this->redis = $this->getServiceLocator()->get('redis');
            } catch (\Exception $e) {
                error_log(
                    $e->getMessage() . PHP_EOL .
                    $e->getTraceAsString() . PHP_EOL
                );
            }
        }
        return $this->redis;
    }

    protected static function jsonEncode($array, $pretty = true)
    {
        return json_encode($array, $pretty ? (JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : 0);
    }


    protected function dataType($post, $default)
    {
        $post = empty($post) ? $default : $post;
        switch (gettype($default)) {
            case 'boolean':
                return  (bool)$post;
            case 'integer':
                return (int)$post;
            case 'double':
                return (float)$post;
            case 'string':
                return Util::purify($post);
            default:
                return $post;
        }
    }

    protected function filterData($params, $defaults)
    {
        $new_params = [];
        foreach ($defaults as $k => $v) {
            if (array_key_exists($k, $params)) {
                $new_params[$k] = $this->dataType($params[$k], $v);
            } else {
                $new_params[$k] = $v;
            }
        }
        return $new_params;
    }

}