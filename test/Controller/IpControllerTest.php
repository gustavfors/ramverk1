<?php

namespace Gufo\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Anax\DI\DIMagic;

/**
 * Test the SampleController.
 */
class IpControllerTest extends TestCase
{
    // Create the di container.
    protected $di;
    protected $controller;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIMagic();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new IpController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testIpActionGet()
    {
        $res = $this->controller->ipActionGet();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testIpActionPostNoAddress()
    {
        $res = $this->controller->ipActionPost();

        $this->assertEquals($res, "no address specified.");
    }

    public function testIpActionPostAddress()
    {
        $this->di->request->setPost('address', '194.47.150.9');

        $res = $this->controller->ipActionPost();

        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
