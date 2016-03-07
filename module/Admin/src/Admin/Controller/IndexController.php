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


        $tuser = $this->getTable('blog_admin_user');
        $user = $tuser->select(['uid' => $uid])->current();
        var_dump($user);
        $option = $this->getTable('blog_options')->select()->toArray();
        var_dump($option);
        return new ViewModel();
    }
}
