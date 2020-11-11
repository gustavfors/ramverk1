<?php

namespace Gufo\Controller;

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

        // $validator = \Gufo\validator\IpValidator::test();

        // die(var_dump($validator));

        $page = $this->di->get("page");

        $page->add('validate/ip/index');
      
        return $page->render([
            "title" => "IP Validator",
        ]);
    }

    public function ipActionPost()
    {
        if ($this->di->request->getPost('address')) {
            
            $url = $this->di->get("url")->create("api/ip");
            $data = array('address' => $this->di->request->getPost('address'));
            $result = \Gufo\RequestMaker\MakeRequest::post($url, $data);

            $page = $this->di->get("page");

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
