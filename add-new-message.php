<?php

require_once('db.php');
$pdo = getPDO();

if (!empty($_POST['message'])) {
    if (!empty($_POST['logged_id'])) {
        addNewMessage($pdo, htmlspecialchars($_POST['message']), $_POST['logged_id']);
    } else {
        if (empty($_POST['name'])) {
            $_POST['name'] = ' ';
        }
        $messageToSave = $_POST['name'] . ':' . $_POST['message'];
        addNewMessage($pdo, htmlspecialchars($messageToSave));
    }
}

$pdo = null;