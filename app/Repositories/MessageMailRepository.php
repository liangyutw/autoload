<?php
namespace app\Repositories;

use Database\Db;

class MessageMailRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function createMessageMailForNoticeSupervisor(string $sqlSyntax)
    {
        $result = $this->db->conn->prepare($sqlSyntax);
        return $result->execute();
    }

    public function checkExistsMessageMail($supervisorIds)
    {
        $sql = "SELECT count(1) FROM als_message_mail WHERE to_name in (".implode(',', $supervisorIds).") and is_notice = :is_notice AND left(meg_date, 10) = '".date('Y-m-d')."'";
        $result = $this->db->conn->prepare($sql);
        $result->execute([
            ':is_notice' => 1,
        ]);
        return $result->fetch(\PDO::FETCH_NUM)[0];
    }
}
