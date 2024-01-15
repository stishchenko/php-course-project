<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 8</title>

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
            if (empty($_SESSION['user'])) {
                $_SESSION['user'] = [];
            }
            if (!empty($_POST)):
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
                                foreach ($_SESSION['user'] as $user) {
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
                                    $id = count($_SESSION['user']);
                                    $_SESSION['user'][$id] = [
                                        'email' => $_POST['email'],
                                        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
                                    ];
                                    ?>
                                    You have tried to sing up with email <b> <?= $_POST['email']; ?></b>
                                <?php } ?>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php elseif (empty($_POST['email']) && !empty($_POST['password'])): ?>
                    <div class="mb-3 alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Warning:">
                            <use xlink:href="#exclamation-triangle-fill"/>
                        </svg>
                        <div>
                            Email field is required!
                        </div>
                    </div>
                <?php elseif (!empty($_POST['email']) && empty($_POST['password'])):
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):?>
                        <div class="mb-3 alert alert-warning d-flex align-items-center" role="alert">
                            <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Warning:">
                                <use xlink:href="#exclamation-triangle-fill"/>
                            </svg>
                            <div>
                                Incorrect email field!
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3 alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Warning:">
                            <use xlink:href="#exclamation-triangle-fill"/>
                        </svg>
                        <div>
                            Password field is required!
                        </div>
                    </div>
                <?php else: ?>
                    <div class="mb-3 alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill"/>
                        </svg>
                        <div>
                            Email and password fields are required!
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row justify-content-center">
        <form method="POST" class="col-3 border border-primary border-2 rounded-4 p-3">
            <div class="mt-3 row justify-content-center">
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
    <?php if (!empty($_SESSION['user'])): ?>
        <div class="row justify-content-center mt-5">
            <div class="col-7 border border-primary border-2 rounded-4 p-3">
                <?php
                foreach ($_SESSION['user'] as $user):
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <b>Email:</b> <?= $user['email']; ?>
                        </div>
                        <div class="col-10">
                            <b>Password:</b> <?= $user['password']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>