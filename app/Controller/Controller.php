<?php
namespace app\Controller;

use Response\Output;

class Controller
{
    protected $output;

    public function __construct()
    {
        $this->output = new Output();
    }
}
