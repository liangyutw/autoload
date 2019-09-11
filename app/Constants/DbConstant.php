<?php
namespace app\Constants;
require '/var/www/html/PHPFunction/PHP_function.php';

class DbConstant
{
    public $info = [];
    public function __construct()
    {
        $this->info = [
            "host"      => env('DB_HOST'),
            "port"      => env('DB_PORT'),
            "dbname"    => env('DB_NAME'),
            "user"      => env('DB_USER'),
            "password"  => env('DB_PASSWORD'),
        ];
    }
}
