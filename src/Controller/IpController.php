<?php

namespace Gufo\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

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
        $this->page->add('validate/ip/index');
      
        return $this->page->render(["title" => "IP Validator"]);
    }

    public function ipActionPost()
    {
        $ipAddress = new \Gufo\Model\IpAddress($this->di->request->getPost('address'));

        $this->page->add('validate/ip/show', ["data" => $ipAddress->data()]);
      
        return $this->page->render(["title" => "IP Validator"]);
    }
}
