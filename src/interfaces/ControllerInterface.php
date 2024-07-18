<?php
namespace Interfaces;

use Utils\Database;
use Utils\Logger;

interface ControllerInterface{
    protected $logger = Logger::getInstance();
    protected $db = Database::getInstance();
    function index();
}