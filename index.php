<?php
include_once __DIR__ . "/autoload.php";

$process = new \app\Request\process();
$process->route();
