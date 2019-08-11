<?php
namespace app\Constants;

class DbConstant
{
    public $info = [];
    public function __construct()
    {
        $this->info = [
            "host"      => 'mysql8',
            "port"      => '3306',
            "dbname"    => 'test',
            "user"      => 'root',
            "password"  => 'password',
        ];
    }
}
