<?php

namespace  Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class LoginController extends AbstractActionController
{
    public function indexAction()
    {
        echo sprintf("%s:%s", __FUNCTION__, __CLASS__);
        return false;
    }
}