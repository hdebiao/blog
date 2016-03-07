<?php

namespace Application\Common;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController
{
    public $config;
    public $dbs = [];
    public $tables = [];

    /**
     * @return array
     */
    public function getConfig()
    {
        if (null === $this->config) {
            $this->config = $this->getServiceLocator()->get('config');
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
            $this->dbs[$db] = $this->getServiceLocator()->get($db);
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
            $this->tables[$table] = new TableGateway($table, $this->getDB($db));
        }
        return $this->tables[$table];
    }
}