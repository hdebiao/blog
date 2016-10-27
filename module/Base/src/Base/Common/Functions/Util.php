<?php
namespace Base\Common\Functions;


class Util
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

    /**
     * @param $string
     * @return string
     */
    public static function purify($string)
    {
        return Purifier::getInstance()->purify($string);
    }
}