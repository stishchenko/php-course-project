<?php
require_once('db.php');

$pdo = getPDO();

$messages = getMessages($pdo);

$pdo = null;

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['data' => $messages]);