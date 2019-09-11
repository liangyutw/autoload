<?php
namespace app\Services;

use app\Services\MessageMailService;
use app\Services\UserService;
use app\Constants\NoticeConstant;

class NoticeService
{
    private $messageMailService;
    private $userService;
    private $noticeConstant;

    public function __construct()
    {
        $this->messageMailService = new MessageMailService();
        $this->userService = new UserService();
        $this->noticeConstant = new NoticeConstant();
    }

    public function createMessageMail()
    {
        /*  取得組長以上的管理人員
        *   排除董事長、職員
        */
        $excludeId = [1, 15];
        $userOriginData = $this->userService->getUserForSupervisor($excludeId);

        $userData = array_map(function ($item) {
            return $item['id'];
        }, $userOriginData);

        // $userData = [12, 19, 2344]; // 測試用

        $insertData = [
            'title' => $this->noticeConstant->content['title'],
            'contents' => $this->noticeConstant->content['content'],
            'to_name' => $userData,
            'from_name' => 1,
            'is_notice' => 1,
        ];

        $createResult = $this->messageMailService->createMessageMailForNoticeSupervisor($insertData);
        if (!$createResult) {
            return ['error' => 'The data repeat to insert DB'];
        }
        return ['success' => true];
    }
}
