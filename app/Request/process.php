<?php
namespace app\Request;

use app\Request\Router;

class process
{
    public $router;
    private $routeFile;

    function __construct()
    {
        $this->routeFile = $_SERVER['DOCUMENT_ROOT'].'/app/Route/route.php';
    }

    public function route()
    {
        $this->router = new Router(new \app\Request\Request());

        if (count(file($this->routeFile)) >= 4) {
            require_once $this->routeFile;
        }
    }
}
