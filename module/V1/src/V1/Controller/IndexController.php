<?php
namespace V1\Controller;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        echo __CLASS__ . '\\' . __FUNCTION__;
        return false;
    }
}