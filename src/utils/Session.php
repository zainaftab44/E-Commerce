<?php
namespace Utils;
use Enums\UserRoles;

session_start();
$_SESSION['role'] = $_SESSION['role'] ?? UserRoles::Anonymous;