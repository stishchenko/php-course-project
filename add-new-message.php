<?php

require_once('db.php');
session_start();
$pdo = getPDO();

if (!empty($_POST['message'])) {
    if (isset($_SESSION['logged_user'])) {
        addNewMessage($pdo, htmlspecialchars($_POST['message']), $_SESSION['logged_user']['id']);
    } else {
        if (empty($_POST['name'])) {
            $_POST['name'] = ' ';
        }
        $messageToSave = $_POST['name'] . ':' . $_POST['message'];
        addNewMessage($pdo, htmlspecialchars($messageToSave));
    }
}

$pdo = null;