<?php
namespace Base\Common\Controller;

class AdminBase extends Base
{
    public static function echoJson($status, $msg, $refer)
    {
        echo parent::jsonEncode(['status' => $status, 'msg' => $msg, 'refer' => $refer]);
        return false;
    }
}