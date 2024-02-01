<?php
require_once('db.php');
session_start();
$_SESSION['has_error'] = false;
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Incorrect email field!';
        $_SESSION['has_error'] = true;
    }
} else {
    if (empty($_POST['email']) && !empty($_POST['password'])) {
        $_SESSION['error_message'] = 'Email field is required!';
        $_SESSION['has_error'] = true;
    } elseif (!empty($_POST['email']) && empty($_POST['password'])) {
        $incorrect = false;
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = 'Incorrect email field!';
            $incorrect = true;
        }
        $_SESSION['error_message'] = $incorrect ? $_SESSION['error_message'] .
            ' Password field is required!' : 'Password field is required!';
        $_SESSION['has_error'] = true;
    } else {
        $_SESSION['error_message'] = 'Email and password fields are required!';
        $_SESSION['has_error'] = true;
    }
}

if ($_SESSION['has_error']) {
    $_SESSION['logged_user'] = null;
    $_SESSION['no_user'] = null;
    echo json_encode(['data' =>['has_error' => true, 'error_message' => $_SESSION['error_message']]]);
} else {
    $pdo = getPDO();
    $user = checkUser($pdo, htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
    if ($user) {
        $_SESSION['logged_user'] = $user;
        $_SESSION['no_user'] = null;
        echo json_encode(['data' =>['has_error' => false, 'logged_user' => $_SESSION['logged_user']]]);
    } else {
        $_SESSION['logged_user'] = null;
        $_SESSION['no_user'] = 'Such user don`t exits!';
        echo json_encode(['data' =>['has_error' => true, 'error_message' => $_SESSION['no_user']]]);
    }
}