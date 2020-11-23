<?php

namespace Gufo\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Model\IpAddress;
use Gufo\Model\Weather;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";

    public function initialize() : void
    {
        $this->db = "active";
    }

    public function ipActionPost()
    {
        if ($this->di->request->getPost('address')) {
            $ipAddress = new IpAddress($this->di->request->getPost('address'));
            return [$ipAddress->data()];
        }
        
        return [["message" => 'no ip address specified.']];
    }

    public function weatherActionGet()
    {
        if ($this->di->request->getGet('ipAddress')) {
            $ipAddress = new IpAddress($this->di->request->getGet('ipAddress'));
            $data = $ipAddress->data();

            if (!$data['valid']) {
                return [["message" => 'not a valid ip address.']];
            }

            $weather = new Weather($data['latitude'], $data['longitude']);

            return [$weather->getAll()];
        }

        return [["message" => 'no ip address specified.']];
    }
}
