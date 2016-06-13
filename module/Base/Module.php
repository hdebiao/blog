<?php


namespace Base;

use Zend\Db\Adapter\Adapter;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'db' => function (ServiceManager $sm) {
                    $c = (array)$sm->get('config');
                    return new Adapter($c['db']);
                },
                'redis' => function (ServiceManager $sm) {
                    $c = (array)$sm->get('config');
                    $redis = new \Redis();
                    $redis->connect($c['redis']['host'], $c['redis']['port']);
                    return $redis;
                }
            ]
        ];
    }
}
