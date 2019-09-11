<?php
namespace app\Controller;

use app\Services\TestService;

class TestController extends Controller
{
    private $testService;

    public function __construct()
    {
        parent::__construct();
        $this->testService = new TestService();
    }

    public function index()
    {
        $result = $this->request->getBody();

        return $this->output->toArray($result);
    }
}
