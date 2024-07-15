<?php
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? UserRoles::Anonymous;