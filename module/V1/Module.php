<?php

namespace V1;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach('route', function (MvcEvent $e) {
            $routes = $e->getRouteMatch()->getParams();
            $controller = $routes['controller'];
            if (strpos($controller, 'V1') === 0) {
                header('Content-Type:application/json;charset=UTF-8');
                $ua = $_SERVER['HTTP_USER_AGENT'];
                $sign = $_POST['sign'];
                if (!isset($ua) or !isset($sign)) {
                    exit('PERMISSION DENIED');
                }
                $valid = (array)$e->getApplication()->getServiceManager()->get('config')['valid'];
                $v = static::sign($valid);
                if ($ua !== $v['ua'] or $sign !== $v['sign']) {
                    exit('PERMISSION DENIED');
                }
            }
        });
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    //签名
    private static function sign($valid)
    {
        ksort($valid);
        reset($valid);
        $validstr = "";
        foreach ($valid as $k => $v) {
            $validstr .= $k . $v;
        }
        $sign = strtoupper(sha1($validstr));
        $valid['sign'] = $sign;
        unset($valid['secret']);
        return $valid;
    }

    public function argSort($para)
    {
        ksort($para);
        reset($para);

        return $para;
    }

    /**
     * @param MvcEvent $e
     * @return \Zend\Db\Adapter\Adapter
     */
    public function getDb($e)
    {
        return $e->getApplication()->getServiceManager()->get('db');
    }

    /**
     * @param $userid
     * @param $e
     * @return array|\ArrayObject|null
     */
    public function getUser($userid, $e)
    {
        $tUser = new TableGateway('blog_admin_user', $this->getDb($e));
        return $tUser->select(['uid' => $userid])->current();
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getControllerConfig()
    {
        return [
            'abstract_factories' => [
                'Application\Services\CommonControlAppAbstractFactory'
            ]
        ];
    }
}
