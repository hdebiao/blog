<?php
namespace Base\Common\Controller;

class ApiBase extends Base
{
    public static function echoJson($id, $msg)
    {
        echo parent::jsonEncode(['id' => $id, 'msg' => $msg]);
        return false;
    }
}