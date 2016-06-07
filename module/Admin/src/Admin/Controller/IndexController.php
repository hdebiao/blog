<?php


namespace Admin\Controller;

use Application\Common\AdminBaseController;
use Application\Common\HttpClient;

/**
 * 后台首页
 * Class IndexController
 * @package Admin\Controller
 */
class IndexController extends AdminBaseController
{
    public function indexAction()
    {
        $uid = $_COOKIE['userid'];
        echo '欢迎您：' . $uid . '号嘉宾！';

        $url = $this->getConfig()['url'] . '/v1/index/json';
        echo HttpClient::post($url, []);
        return false;
    }
}
