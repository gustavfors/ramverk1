<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

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



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }

    public function ipActionPost()
    {
        if ($this->di->request->getPost('address')) {
            $ipAddress = $this->di->request->getPost('address');
            $valid = false;
            $protocol = null;
            $domain = null;
            
            if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
                $valid = true;
                $domain = gethostbyaddr($ipAddress);
                if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                    $protocol = "IPv6";
                } else if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $protocol = "IPv4";
                }
            }

            $data = [
                "ip" => $ipAddress,
                "valid" => $valid,
                "protocol" => $protocol,
                "domain" => $domain
            ];

            return [$data];
        }
        return "no address specified.";
    }
}
