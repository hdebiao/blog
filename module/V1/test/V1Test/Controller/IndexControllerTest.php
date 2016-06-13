<?php

namespace V1Test\Controller;

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
        $this->dispatch('/v1');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('V1');
        $this->assertControllerName('V1\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('v1');
    }
}