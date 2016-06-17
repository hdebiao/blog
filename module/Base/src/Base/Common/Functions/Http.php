<?php

namespace Base\Common\Functions;

class Http
{
    public static $ch;
    public static $valid = [
        'ua' => 'convee-admin-ua',
        'secret' => '17e2721c65c87f0cfd73c5b65b3eaaaf'
    ];

    public static function getCurl()
    {
        if (null === static::$ch) {
            static::$ch = curl_init();
        }
        curl_reset(static::$ch);
        return static::$ch;
    }
    public static function post($url, array $post = [])
    {
        $ch = static::getCurl();
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
        $post['sign'] = Util::sign(self::$valid)['sign'];//签名
        $defaults[CURLOPT_POSTFIELDS] = http_build_query($post);
        curl_setopt_array($ch, $defaults);
        $data = curl_exec($ch);
        if ($data) {
            curl_close($ch);
            return $data;
        }
        error_log('curl错误：' . curl_error($ch));
        curl_close($ch);
        return false;
    }


}