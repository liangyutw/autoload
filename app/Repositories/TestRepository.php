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

    public function getTaskData($data)
    {
        echo 'ww';
        echo '<pre>';
        print_r($data);
        exit;
        $obj = $this->db->conn->prepare('SELECT * FROM `task`');
        // $obj->bindValue(1, $_GET['id']);
        $obj->execute();
        return $obj->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function login()
    {
        return [
            'userData' => $this->getUserData(),
            'userDataCount' => $this->getUserDataCount()
        ];
    }

    private function getUserCondition()
    {
        $request    = $this->request->getBody();
        $account    = $request['account'];
        $password   = md5($request['password']);

        $sql = "SELECT *,TO_DAYS(CURDATE())-TO_DAYS(`pasw`) as 'paswdate' FROM als_user WHERE `account` = :account AND `password` = :password AND del = '0'";
        $result = $this->db->conn->prepare($sql);
        $result->execute([
            'account' => $account,
            'password' => $password
        ]);

        return $result;
    }

    private function getUserData()
    {
        return $this->getUserCondition()->fetch(\PDO::FETCH_ASSOC);
    }

    private function getUserDataCount()
    {
        return $this->getUserCondition()->rowCount();
    }
}
