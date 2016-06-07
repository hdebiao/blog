<?php
namespace Application\Common;

class UtilFunction
{
        //签名
    public static function sign(array $valid = [])
    {
        ksort($valid);
        reset($valid);
        $validstr = "";
        foreach ($valid as $k => $v) {
            $validstr .= $k . $v;
        }
        $sign = strtoupper(sha1($validstr));
        $valid['sign'] = $sign;
        unset($valid['secret']);
        return $valid;
    }
}