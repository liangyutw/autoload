<?php
namespace Database;

use app\Constants\DbConstant;

class Db
{
    private $constant;
    public $conn;

    public function __construct()
    {
        $this->constant = new DbConstant();
        $this->conn = new \PDO('mysql:host='.$this->constant->info['host'].';dbname='.$this->constant->info['dbname'].';port='.$this->constant->info['port'], $this->constant->info['user'], $this->constant->info['password']);
    }
}
