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
class IpController implements ContainerInjectableInterface
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

    public function ipActionGet()
    {
        $page = $this->di->get("page");

        $page->add('validate/ip/index');
      
        return $page->render([
            "title" => "IP Validator",
        ]);

        // return "cow";
    }

    public function ipActionPost()
    {
        if ($this->di->request->getPost('address')) {
            $page = $this->di->get("page");

            // $url = "{$this->di->request->getBaseUrl()}/api/ip";
            $url = $this->di->get("url")->create("api/ip");

            $data = array('address' => $this->di->request->getPost('address'));
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );

            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);

            $result = json_decode($result);

            $page->add('validate/ip/show', [
                "result" => $result
            ]);
        
            return $page->render([
                "title" => "IP Validator",
            ]);
        }
        return "no address specified.";
    }
}
