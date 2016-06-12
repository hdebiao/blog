<?php


namespace Admin\Controller;

use Application\Common\Controller\AdminBaseController;
use Application\Common\Util\HttpUtil;

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
        echo $url;
        echo HttpUtil::post($url, []);
        return false;
    }
}
