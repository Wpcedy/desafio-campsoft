<?php

require_once __DIR__ . '/../../../api/Controller/UsersController.php';

$body = json_decode(file_get_contents('php://input'), true);
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$usersController = new UsersController($_SERVER['REQUEST_METHOD'], $id, $body);
echo $usersController->call();