<?php

namespace Gufo\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Model\IpAddress;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";

    public function initialize() : void
    {
        $this->db = "active";
        $this->page = $this->di->get("page");
    }

    public function ipActionGet()
    {
        $userIp = "127.0.0.1";

        if (isset($_SERVER['REMOTE_ADDR'])) {
            $userIp = $_SERVER['REMOTE_ADDR'];
        }

        $this->page->add('validate/ip/index', ['userIp' => $userIp]);

        return $this->page->render(["title" => "IP Validator"]);
    }

    public function ipActionPost()
    {
        if ($this->di->request->getPost('address')) {
            $ipAddress = new IpAddress($this->di->request->getPost('address'));

            $this->page->add('validate/ip/show', ["data" => $ipAddress->data()]);

            return $this->page->render(["title" => "IP Validator"]);
        }

        return "no address specified.";
    }
}
