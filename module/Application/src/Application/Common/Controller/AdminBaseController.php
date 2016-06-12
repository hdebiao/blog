<?php
namespace Application\Common\Controller;

class AdminBaseController extends BaseController
{
    public static function echoJson($status, $msg, $refer)
    {
        echo parent::jsonEncode(['status' => $status, 'msg' => $msg, 'refer' => $refer]);
        return false;
    }
}