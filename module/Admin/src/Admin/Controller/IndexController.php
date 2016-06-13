<?php


namespace Admin\Controller;

use Base\Common\Controller\AdminBaseController;
use Base\Common\Functions\HttpFunction;

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
        echo HttpFunction::post($url, []);
        return false;
    }
}
