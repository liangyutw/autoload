<?php
namespace Request;

use Request\Router;

class process
{
    public $router;
    private $routeFile;

    public function __construct()
    {
        $this->routeFile = $_SERVER['DOCUMENT_ROOT'].'/Route/route.php';
    }

    public function route()
    {
        $this->router = new Router(new \Request\Request());

        if (count(file($this->routeFile)) >= 4) {
            require_once $this->routeFile;
        }
    }
}
