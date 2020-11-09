<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Anax\DI\DIMagic;

/**
 * Test the SampleController.
 */
class ApiControllerTest extends TestCase
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
        $this->controller = new ApiController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testIpActionPostNoAddress()
    {
        $res = $this->controller->ipActionPost();

        $this->assertEquals($res, "no address specified.");
    }

    public function testIpActionPostAddressIPv4()
    {
        $this->di->request->setPost('address', '194.47.150.9');

        $this->di->url->setBaseUrl('http://localhost:8080/dbwebb/ramverk1/me/redovisa/htdocs/');

        $res = $this->controller->ipActionPost();

        $this->assertEquals('IPv4', $res[0]['protocol']);

        $this->assertInternalType("array", $res);
    }

    public function testIpActionPostAddressIPv6()
    {
        $this->di->request->setPost('address', '2001:0db8:85a3:0000:0000:8a2e:0370:7334');

        $this->di->url->setBaseUrl('http://localhost:8080/dbwebb/ramverk1/me/redovisa/htdocs/');

        $res = $this->controller->ipActionPost();

        $this->assertEquals('IPv6', $res[0]['protocol']);

        $this->assertInternalType("array", $res);
    }

    public function testIpActionPostAddressInvalid()
    {
        $this->di->request->setPost('address', 'dsadsafgasgfasf');

        $this->di->url->setBaseUrl('http://localhost:8080/dbwebb/ramverk1/me/redovisa/htdocs/');

        $res = $this->controller->ipActionPost();

        $this->assertEquals(null, $res[0]['protocol']);

        $this->assertInternalType("array", $res);
    }
}
