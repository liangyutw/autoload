<?php
namespace Request;

use Request\IRequest;
use Exception;

class Router
{
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    public function __call($name, $args)
    {
        list($route, $method) = $args;

        if (!is_object($method) && is_string($method)) {
            /*
            取代作用，將代入的 TestController@index 換成
            function () use ($class, $functionName) {
                return $class->{$functionName}();
            };
             */
            $method = $this->getFunctionContent($method);
            $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
        }

        if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    private function getFunctionContent($closure)
    {
        $className = $functionName = [];
        if (strpos($closure, '@') > 0 && strpos($closure, '@') != false) {
            list($className, $functionName) = explode('@', $closure);
        }
        $d1 = "\\";
        $d2 = "\\";
        $className  = str_replace($d1, $d2, $className);
        $classPath  = $this->getClassPath($className);
        $class      = new $classPath();

        return function () use ($class, $functionName) {
            return $class->{$functionName}();
        };
    }

    private function getClassPath($className)
    {
        $folderAry = ['Entity', 'Service', 'Controller', 'Repository'];
        foreach ($folderAry as $val) {
            $folderName = strrchr($className, $val);
            if (!empty($folderName)) {
                return 'app\\'.$folderName.'\\'.$className;
            }
        }
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param route (string)
     */
    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler()
    {
        return 'Method Not Allowed';
    }

    private function defaultRequestHandler()
    {
        // return 'Not Found The Route';
        return;
    }

    /**
     * Resolves a route
     */
    public function resolve()
    {
        try {
            $methodDictionary = $this->{strtolower($this->request->requestMethod)};
            $formatedRoute = $this->formatRoute($this->request->requestUri);
            $formatedRoute = str_replace('/index.php','/', $formatedRoute);
            $closureObj = $methodDictionary[$formatedRoute];

            if (is_null($closureObj)) {
                throw new Exception($this->defaultRequestHandler());
            }

            echo call_user_func_array($closureObj, array($this->request));
        } catch (Exception $e) {
            echo '<pre>';
            print_r($e->getMessage());
            exit;
        }
    }

    public function __destruct()
    {
        $this->resolve();
    }
}
