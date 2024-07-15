<?php

namespace Src\Controllers;

use Src\Interfaces\ControllerInterface;

class HomeController implements ControllerInterface{


    public function index(){
        $this->logger->info_log("Index page accessed");
        echo "hello world";
    }
}