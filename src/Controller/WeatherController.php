<?php

namespace Gufo\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Model\Weather;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";

    public function initialize() : void
    {
        $this->db = "active";
        $this->page = $this->di->get("page");
    }

    public function indexActionGet()
    {
        if ($this->di->request->getGet('location')) {

            $weather = new Weather("213123", "3213123");

            $forecast = $weather->getForecast();

            $this->page->add('weather/show', [
                'forecast' => $forecast
            ]);

        } else {
            $this->page->add('weather/index');
        }

        return $this->page->render(["title" => "Weather"]);
    }
}
