<?php

namespace ApiTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include '/home/wk/workspace/www/blog/config/application.config.php'
        );
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/api');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Api');
        $this->assertControllerName('Api\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('api');
    }
}