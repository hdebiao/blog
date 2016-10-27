<?php


namespace Admin\Controller;

use Base\Common\Controller\AdminBase;
use Base\Common\Functions\Http;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

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
