<?php

namespace Application\Common;

class HttpClient
{
    public static $valid = [];

    public static function post($url, array $post = [])
    {
        $ch = curl_init();
        $defaults = array(
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 0,
            CURLOPT_CONNECTTIMEOUT => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_VERBOSE => false,
            CURLOPT_USERAGENT => self::$valid['ua']
        );
        $post['sign'] = UtilFunction::sign(self::$valid);//签名
        $defaults[CURLOPT_POSTFIELDS] = $post;
        curl_setopt_array($ch, $defaults);
        $data = curl_exec($ch);
        if ($data) {
            curl_close($ch);
            return $data;
        }
        $error = curl_errno($ch);
        error_log('curl错误码：' . $error);
        curl_close($ch);
        return false;
    }


}