<!DOCTYPE html>
<?php
require_once('db.php');
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add user</title>

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
    <div class="row justify-content-center">
        <div class="col-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>
            <?php
            if (!empty($_POST)):
                $pdo = getPDO();
                if (isset($_POST['delete_user'])) {
                    $idToDelete = $_POST['delete_user'];
                    deleteUser($pdo, $idToDelete);
                } elseif (isset($_POST['delete_all'])) {
                    deleteAllUsers($pdo);
                } else {
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
                        <?php else: ?>
                            <div class="mb-3 alert alert-success d-flex align-items-center" role="alert">
                                <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill"/>
                                </svg>
                                <div>
                                    <?php
                                    $used = false;
                                    foreach (getUsers($pdo) as $user) {
                                        if ($user['email'] == $_POST['email']) {
                                            $used = true;
                                            ?>
                                            You have <b>already</b> tried this email <b> <?= $_POST['email']; ?></b>
                                            <?php
                                            if (password_verify($_POST['password'], $user['password'])) {
                                                ?>
                                                <br>
                                                Used password is <b>correct</b>!
                                                <?php
                                            } else {
                                                ?>
                                                <br>
                                                Used password is <b>incorrect</b>!
                                                <?php
                                            }
                                            break;
                                        }
                                    }
                                    if (!$used) {
                                        addNewUser($pdo, htmlspecialchars($_POST['name']), htmlspecialchars($_POST['email']),
                                            password_hash($_POST['password'], PASSWORD_BCRYPT));
                                        ?>
                                        You have tried to sing up with email <b> <?= $_POST['email']; ?></b>
                                    <?php } ?>
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
                }
                $pdo = null; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row justify-content-center">
        <form method="POST" class="col-3 border border-primary border-2 rounded-4 p-3">
            <div class="mt-3 row justify-content-center">
                <label for="name" class="form-label col-9">Name
                    <?php if (empty($_POST) ||
                        (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name']))): ?>
                        <input type="text" name="name" placeholder="Name" class="form-control my-1">
                    <?php elseif (!empty($_POST['name'])): ?>
                        <input type="text" name="name" placeholder="Name" class="form-control my-1"
                               value="<?= $_POST['name']; ?>">
                    <?php else: ?>
                        <input type="text" name="name" placeholder="Name" class="form-control my-1">
                    <?php endif; ?>
                </label>
                <label for="email" class="form-label col-9">Email
                    <?php if (empty($_POST) || (!empty($_POST['email']) && !empty($_POST['password']))): ?>
                        <input type="text" name="email" placeholder="name@example.com" class="form-control my-1">
                    <?php elseif (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)): ?>
                        <input type="text" name="email" placeholder="name@example.com" class="form-control my-1"
                               value="<?= $_POST['email']; ?>">
                    <?php else: ?>
                        <input type="text" name="email" placeholder="name@example.com" class="form-control my-1">
                    <?php endif; ?>
                </label>
                <label for="password" class="form-label col-9">Password
                    <input type="password" name="password" class="form-control my-1">
                </label>
            </div>
            <div class="row justify-content-center my-3">
                <button type="submit" class="col-4 btn btn-primary">Sign up</button>
            </div>
        </form>
    </div>
    <?php
    $pdo = getPDO();
    $users = getUsers($pdo);
    $pdo = null;
    if (is_array($users)): ?>
        <div class="row justify-content-end mt-5">
            <div class="col-8 border border-primary border-2 rounded-4 p-3">
                <?php
                foreach ($users as $user) { ?>
                    <div class="row justify-content-center">
                        <form method="POST" class="col-1 my-auto">
                            <button type="submit" name="delete_user" value="<?= $user['id']; ?>"
                                    class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <div class="col">
                            <div class="col-10">
                                <b>Name:</b> <?= $user['name']; ?>
                            </div>
                            <div class="col-10">
                                <b>Email:</b> <?= $user['email']; ?>
                            </div>
                            <div class="col-10">
                                <b>Password:</b> <?= $user['password']; ?>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <div class="col-2 me-3">
                <form method="POST" class="mt-3">
                    <button type="submit" name="delete_all" class="btn btn-primary">Delete all</button>
                </form>
                <div class="mt-3">
                    <a href="task11.php" class="btn btn-outline-primary">Open chat</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>