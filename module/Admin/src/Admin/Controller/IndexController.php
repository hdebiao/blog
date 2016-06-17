<?php


namespace Admin\Controller;

use Base\Common\Controller\AdminBaseController;
use Base\Common\Functions\HttpFunction;
use Zend\View\Model\ViewModel;

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
        $url = $this->getConfig()['url'] . '/v1/index/json';
        $json = json_decode(HttpFunction::post($url, []), true);
        return new ViewModel([
            'json' => $json,
            'uid' => $uid
        ]);
    }
}
