<?php

namespace  Admin\Controller;

use Base\Common\Controller\AdminBaseController;
use Zend\View\Model\ViewModel;

/**
 * 博客后台登录模块
 * Class LoginController
 * @package Admin\Controller
 */
class LoginController extends AdminBaseController
{
    public function indexAction()
    {
//        echo md5('wang1019');//生成简单密码
        if (!empty($_COOKIE['userid'])) {
            $this->redirect()->toUrl('/admin');
        }
        return new  ViewModel();
    }

    /**
     * 登录
     * @return bool
     */
    public function dologinAction()
    {
        $username = $this->params()->fromPost('usernmae', '');
        $password = $this->params()->fromPost('password', '');
        $md5password = md5($password);
        if ($username === '' || $password === '') {
            echo '用户名或密码不能为空!';
            return false;
        }
        $user = $this->getUserByUsername($username);
        if (empty($user)) {
            echo '用户名不存在!';
            return false;
        }
        if ($md5password !== $user->offsetGet('password')) {
            echo '密码不正确!';
            return false;
        }
        $user = $user->getArrayCopy();
        $domain_suffix = $this->getConfig()['domain_suffix'];
        setcookie('userid', $user['uid'], time() + 65555000, '/', $domain_suffix);
        $this->redirect()->toUrl('/admin');
        return false;
    }

    /**
     * 注销登录
     * @return bool
     */
    public function logoutAction()
    {
        $domain_suffix = $this->getConfig()['domain_suffix'];
        setcookie('userid', null, 0, '/', $domain_suffix);
        header('location:/admin/login');
        return false;
    }

    public function getUserByUsername($username)
    {
        $tAdminUser = $this->getTable('blog_admin_user');
        return $tAdminUser->select(['username' => $username])->current();

    }
}