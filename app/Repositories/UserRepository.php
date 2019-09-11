<?php
namespace app\Repositories;

use Database\Db;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function login()
    {
        return [
            'userData' => $this->getUserData(),
            'userDataCount' => $this->getUserDataCount()
        ];
    }

    public function getUserForSupervisor(array $positionId)
    {
        $sql = "
        SELECT
        `id`
        FROM als_user
        WHERE  `position` in (SELECT `id` FROM als_position WHERE `id` NOT IN (".implode(',', $positionId).") AND del = :del)
        AND del = :del";

        $result = $this->db->conn->prepare($sql);
        $result->execute([
            ':del'          => 0,
        ]);

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}
