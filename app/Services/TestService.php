<?php
namespace app\Services;

use app\Repositories\TestRepository;

class TestService
{
    private $testRepository;

    public function __construct()
    {
        $this->testRepository = new TestRepository();
    }

    public function getTaskData()
    {
        return $this->testRepository->getTaskData();
    }
}
