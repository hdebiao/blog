<?php
namespace Api\Controller;
use Base\Common\Controller\ApiBase;

class IndexController extends ApiBase
{

    public function indexAction()
    {
        echo __CLASS__ . '\\' . __FUNCTION__;
        return false;
    }

    public function jsonAction()
    {
        echo self::jsonEncode([
            'name' => 'convee',
            'email' => 'convee@sina.cn'
        ]);
        return false;
    }
}