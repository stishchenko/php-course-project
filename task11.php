<!DOCTYPE html>
<?php
require_once('db.php');
session_start();
$pdo = getPDO();
if (isset($_POST['add_message'])) {
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
}
if (isset($_POST['become_user'])) {
    $user = checkUser($pdo, htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
    if ($user) {
        $_SESSION['logged_user'] = $user;
        $_SESSION['no_user'] = null;
    } else {
        $_SESSION['logged_user'] = null;
        $_SESSION['no_user'] = 'Such user don`t exits!';
    }
}

if (isset($_POST['logout'])) {
    $_SESSION['logged_user'] = null;
}

if (!empty($_GET['delete_message'])) {
    deleteMessage($pdo, $_GET['delete_message']);
}

if (isset($_POST['clear_messages'])) {
    deleteAllMessages($pdo);
}

$messages = getMessages($pdo);
$pdo = null;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 11</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <style>
        .icon-small {
            width: 20px;
            height: 20px;
        }

    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-8 me-3">
            <div class="card">
                <div class="card-header">
                    Chat
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    if (count($messages) == 0) {
                        echo '<li class="list-group-item">No messages yet</li>';
                    }
                    foreach ($messages as $message) : ?>
                        <li class="list-group-item">
                            <?php
                            if ($message['name'] == null) {
                                $data = explode(':', $message['message']);
                                $message['name'] = $data[0];
                                $message['message'] = $data[1];
                            }
                            ?>
                            <strong><?= $message['name']; ?></strong> at
                            <?= $message['date']; ?> :
                            <i><?= $message['message']; ?></i>
                            <?php if (isset($_SESSION['logged_user']) &&
                                $_SESSION['logged_user']['role'] == 'admin'): ?>
                                <a href="?delete_message=<?= $message['id']; ?>" class="btn btn-outline-danger"><i
                                            class="fas fa-trash"></i></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['role'] == 'admin'): ?>
                <div class="row justify-content-end mt-3">
                    <form method="POST" class="col-3">
                        <button type="submit" name="clear_messages" class="btn btn-primary">Clear messages</button>
                    </form>
                </div>
            <?php endif; ?>
            <form method="post" class="mt-3">
                <div class="mb-3">
                    <?php if (isset($_SESSION['logged_user'])): ?>
                        <label class="form-label">Name:
                            <strong><?= $_SESSION['logged_user']['name']; ?></strong></label>
                    <?php else: ?>
                        <label for="name" class="form-label">Name</label>
                        <input
                                type="text"
                                class="form-control"
                                name="name"
                        >
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <input
                            type="text"
                            class="form-control"
                            name="message"
                    >
                </div>
                <button type="submit" name="add_message" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col">
            <div class="row justify-content-center">
                <div class="col-7">
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                        <symbol id="check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                    </svg>
                    <?php
                    if (isset($_POST['become_user'])):
                        if (!empty($_POST['email']) && !empty($_POST['password'])):
                            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):?>
                                <div class="mb-3 alert alert-warning d-flex align-items-center" role="alert">
                                    <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Warning:">
                                        <use xlink:href="#exclamation-triangle-fill"/>
                                    </svg>
                                    <div>
                                        Incorrect email field!
                                    </div>
                                </div>
                            <?php elseif (isset($_SESSION['no_user'])): ?>
                                <div class="mb-3 alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                                        <use xlink:href="#exclamation-triangle-fill"/>
                                    </svg>
                                    <div>
                                        <?= $_SESSION['no_user']; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if (empty($_POST['email']) && !empty($_POST['password'])) {
                                $_SESSION['error_message'] = 'Email field is required!';
                            } elseif (!empty($_POST['email']) && empty($_POST['password'])) {
                                $incorrect = false;
                                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                                    $_SESSION['error_message'] = 'Incorrect email field!';
                                    $incorrect = true;
                                }
                                $_SESSION['error_message'] = $incorrect ? $_SESSION['error_message'] .
                                    '<br>Password field is required!' : 'Password field is required!';
                            } else {
                                $_SESSION['error_message'] = 'Email and password fields are required!';
                            }
                            ?>
                            <div class="mb-3 alert alert-warning d-flex align-items-center" role="alert">
                                <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Warning:">
                                    <use xlink:href="#exclamation-triangle-fill"/>
                                </svg>
                                <div>
                                    <?= $_SESSION['error_message']; ?>
                                </div>
                            </div>
                        <?php
                        endif;
                    endif; ?>

                </div>
            </div>
            <div class="row justify-content-center">
                <?php if (!isset($_SESSION['logged_user'])): ?>
                    <form method="POST" class="col-8 border border-primary border-2 rounded-4 p-3">
                        <div class="mt-3 row justify-content-center">
                            <label for="email" class="form-label col-9">Email
                                <?php if (empty($_POST) || (!empty($_POST['email']) && !empty($_POST['password']))): ?>
                                    <input type="text" name="email" placeholder="name@example.com"
                                           class="form-control my-1">
                                <?php elseif (!empty($_POST['email']) &&
                                    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)): ?>
                                    <input type="text" name="email" placeholder="name@example.com"
                                           class="form-control my-1"
                                           value="<?= $_POST['email']; ?>">
                                <?php else: ?>
                                    <input type="text" name="email" placeholder="name@example.com"
                                           class="form-control my-1">
                                <?php endif; ?>
                            </label>
                            <label for="password" class="form-label col-9">Password
                                <input type="password" name="password" class="form-control my-1">
                            </label>
                        </div>
                        <div class="row justify-content-center my-3">
                            <button type="submit" name="become_user" class="col-7 btn btn-primary">Continue</button>
                        </div>
                    </form>
                <?php else: ?>
                    <form method="POST" class="mb-2">
                        <button type="submit" name="logout" class="col-7 btn btn-primary">Logout</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>

