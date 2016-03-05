<?php

namespace Admin;

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
            if (strpos($controller, 'Admin') === 0 && $controller !== 'Admin\Controller\Login') {
                if (empty($_COOKIE['userid'])) {
                    header('location:/admin/login');
                }
                $userid = (int)$_COOKIE['userid'];
                if ($userid < 1) {
                    header('location:/admin/login');
                }
                $user = $this->getUser($userid, $e);
                if (empty($user)) {
                    header('location:/admin/login');
                }

            }
        });
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
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
