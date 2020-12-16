<?php

namespace Anax\Controller;
use Anax\Response\ResponseUtility;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Testing the IpCheckController
 */
class GeoTagControllerTest extends TestCase
{   
    private $di;

    /**
     * Testing the test route
     */
    public function testRouteGet()
    {
        $controller = new GeoTagController();
        $res = $controller->routeGet();
        $this->assertContains("test", $res);
    }

    public function GeoTagControllerTest()
    {
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $this->controller = new GeoTagController();
        $this->controller->setDI($this->di);

        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    // public function testValidateActionPost()
    // {
    //     $this->di = new DIFactoryConfig();
    //     $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
    //     $this->controller = new GeoTagController();
    //     $this->controller->setDI($this->di);

    //     // Do the test and assert it
    //     $res = $this->controller->validateActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);       
    // }

    public function testJsonActionGet()
    {
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Setup the controller
        $controller = new GeoTagController();
        $controller->setDI($di);

        // Do the test and assert it
        $res = $controller->jsonActionGet();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $this->assertContains("Var vänlig ange riktiga uppgifter.", $json["error"]);
    }

    // /**
    //  * Test the index route.
    //  */
    // public function testIndexAction()
    // {
    //     // Setup di
    //     $di = new DIFactoryConfig();
    //     $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

    //     // Use a different cache dir for unit test
    //     // $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

    //     // Setup the controller
    //     $controller = new GeoTagController();
    //     $controller->setDI($di);

    //     // Do the test and assert it
    //     $res = $controller->indexAction();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    // public function testValidateActionPost()
    // {
    //     // Setup di
    //     $di = new DIFactoryConfig();
    //     $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

    //     // Use a different cache dir for unit test
    //     // $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

    //     // Setup the controller
    //     $controller = new GeoTagController();
    //     $controller->setDI($di);

    //     // Do the test and assert it
    //     $res = $controller->validateActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);

        
    // }

    // public function testJsonActionGet()
    // {
    //     // Setup di
    //     $di = new DIFactoryConfig();
    //     $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

    //     // Use a different cache dir for unit test
    //     // $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

    //     // Setup the controller
    //     $controller = new GeoTagController();
    //     $controller->setDI($di);

    //     // Do the test and assert it
    //     $res = $controller->jsonActionGet();
    //     $this->assertInternalType("array", $res);

    //     $json = $res[0];
    //     $this->assertContains("Var vänlig ange riktiga uppgifter.", $json["error"]);
    // }
}