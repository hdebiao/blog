<?php
namespace Application\Common;

class V1BaseController extends BaseController
{
    public static function echoJson($id, $msg)
    {
        echo parent::jsonEncode(['id' => $id, 'msg' => $msg]);
        return false;
    }
}