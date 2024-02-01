<?php
require_once('db.php');

$has_error = false;
$error_message = null;
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Incorrect email field!';
        $has_error = true;
    }
} else {
    if (empty($_POST['email']) && !empty($_POST['password'])) {
        $error_message = 'Email field is required!';
        $has_error = true;
    } elseif (!empty($_POST['email']) && empty($_POST['password'])) {
        $incorrect = false;
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error_message = 'Incorrect email field!';
            $incorrect = true;
        }
        $error_message = $incorrect ? $error_message .
            ' Password field is required!' : 'Password field is required!';
        $has_error = true;
    } else {
        $error_message = 'Email and password fields are required!';
        $has_error = true;
    }
}

if ($has_error) {
    echo json_encode(['data' => ['has_error' => true, 'error_message' => $error_message]]);
} else {
    $pdo = getPDO();
    $user = checkUser($pdo, htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
    if ($user) {
        echo json_encode(['data' => ['has_error' => false, 'logged_user' => $user]]);
    } else {
        $error_message = 'Such user don`t exits!';
        echo json_encode(['data' => ['has_error' => true, 'error_message' => $error_message]]);
    }
}