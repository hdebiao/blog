<?php


namespace Admin\Controller;

use Base\Common\Controller\AdminBase;
use Base\Common\Functions\Http;
use Zend\View\Model\ViewModel;

/**
 * 后台首页
 * Class IndexController
 * @package Admin\Controller
 */
class IndexController extends AdminBase
{
    public function indexAction()
    {
        $uid = $_COOKIE['userid'];
        $url = $this->getConfig()['url'] . '/api/index/json';
        $json = json_decode(Http::post($url, []), true);
        return new ViewModel([
            'json' => $json,
            'uid' => $uid
        ]);
    }
}
