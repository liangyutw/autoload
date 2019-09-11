<?php
namespace app\Services;

use app\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getUserForSupervisor($excludeId)
    {
        return $this->userRepository->getUserForSupervisor($excludeId);
    }
}
