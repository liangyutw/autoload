<?php
namespace app\Controller\User;

use app\Services\UserService;
use Response\Output;
use Exception;
use Request\Request;

class UserController
{
    private $userService;
    protected $output;
    protected $request;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->output = new Output();
        $this->request = new Request();
    }

    public function login()
    {
        try {
            $excludeId = $this->request->getBody()['excludeId'];
            $result = $this->userService->getUserForSupervisor($excludeId);
            // return $result;
            return $this->output->toJson($result);
        } catch (Exception $e) {
            echo '<pre>';
            print_r($e->getMessage());
            exit;
        }
    }
}
