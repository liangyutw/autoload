<?php
namespace app\Services;

use app\Repositories\MessageMailRepository;

class MessageMailService
{
    private $messageMailRepository;

    public function __construct()
    {
        $this->messageMailRepository = new MessageMailRepository();
    }

    public function createMessageMailForNoticeSupervisor($condition)
    {
        $defaultSyntax = '
        insert into
            als_message_mail
        set ';
        $insertColumn = $sqlSyntax = '';

        if (isset($condition['to_name']) && !empty($condition['to_name'])) {
            $toName = $condition['to_name'];
            unset($condition['to_name']);
        }

        foreach ($condition as $column => $val) {
            if (!is_int($val)) {
                $insertColumn .= $column." = '". trim($val)."', ";
            } else {
                $insertColumn .= $column." = ". trim($val).", ";
            }
        }

        foreach ($toName as $supervisorId) {

            //組合成一大包語法執行
            $sqlSyntax .= $defaultSyntax.$insertColumn.'to_name = '. trim($supervisorId).';';
            $supervisorIds[] = $supervisorId;
        }

        /**
         * 檢查是否有資料
         * 全部ID一次檢查，全部都沒有資料，才能新增
         */
        $checkResult = $this->messageMailRepository->checkExistsMessageMail($supervisorIds);
        // 已有值則不新增
        if (!empty($checkResult)) {
            return false;
        }

        return $this->messageMailRepository->createMessageMailForNoticeSupervisor($sqlSyntax);
    }
}
