<?php
namespace app\Controller;

use app\Services\NoticeService;
use Exception;

class NoticeController extends Controller
{
    private $noticeService;

    public function __construct()
    {
        parent::__construct();
        $this->noticeService = new NoticeService();
    }

    public function schedule()
    {
        try {
            $result = $this->noticeService->createMessageMail();
            return $this->output->toJson($result);
        } catch (Exception $e) {
            echo '<pre>';
            print_r($e->getMessage());
            exit;
        }
    }
}
