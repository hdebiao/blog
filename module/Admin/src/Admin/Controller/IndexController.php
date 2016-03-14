<?php


namespace Admin\Controller;

use Application\Common\BaseController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $uid = $_COOKIE['userid'];
        echo '欢迎您：' . $uid . '号嘉宾！';
        return new ViewModel();
    }
}
