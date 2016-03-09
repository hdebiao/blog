<?php


namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $uid = $_COOKIE['userid'];
        echo '欢迎您：' . $uid . '号嘉宾！';

        $tm = $this->getTable('blog_admin_user');
        $a  = $tm->select(array('uid'=> 1))->current()->offsetGet('password');
        $b  = $tm->select(array('uid'=> 1))->getArrayObjectPrototype();
        $this->p($a);
        $c = new Select();
        return false;
//        return new ViewModel();
    }





    public function getTable($table)
    {
        $config = $this->getServiceLocator()->get('config');
        $adapter = new Adapter($config['db']);
        $gettable = new TableGateway($table,$adapter);
        return $gettable;
    }



    //打印数组的函数   用于测试   打印函数
    public function p($array){
        return $this->dayin($array,1,'<pre>',0);
    }

    //打印数组的函数   用于测试
    public function dayin($var, $echo=true, $label=null, $strict=true) {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        }else
            return $output;
    }







}
