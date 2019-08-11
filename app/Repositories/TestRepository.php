<?php
namespace app\Repositories;

use Database\Db;

class TestRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getTaskData()
    {
        $obj = $this->db->conn->prepare('SELECT * FROM `task`');
        // $obj->bindValue(1, $_GET['id']);
        $obj->execute();
        return $obj->fetchAll(\PDO::FETCH_ASSOC);
    }
}
