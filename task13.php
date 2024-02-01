<!DOCTYPE html>
<?php
require_once('db.php');
session_start();
$pdo = getPDO();
/*if (isset($_POST['add_message'])) {
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
}*/

/*if (isset($_POST['become_user'])) {
    $user = checkUser($pdo, htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
    if ($user) {
        $_SESSION['logged_user'] = $user;
        $_SESSION['no_user'] = null;
    } else {
        $_SESSION['logged_user'] = null;
        $_SESSION['no_user'] = 'Such user don`t exits!';
    }
}*/

/*if (isset($_POST['logout'])) {
    $_SESSION['logged_user'] = null;
}*/

if (!empty($_GET['delete_message'])) {
    deleteMessage($pdo, $_GET['delete_message']);
}

if (isset($_POST['clear_messages'])) {
    deleteAllMessages($pdo);
}

//$messages = getMessages($pdo);
$pdo = null;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 13</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
        .icon-small {
            width: 20px;
            height: 20px;
        }

    </style>
    <script>
        function getCurrentDateTime() {
            var date = new Date();
            var year = date.getFullYear();
            var month = ("0" + (date.getMonth() + 1)).slice(-2);
            var day = ("0" + date.getDate()).slice(-2);
            var hours = ("0" + date.getHours()).slice(-2);
            var minutes = ("0" + date.getMinutes()).slice(-2);
            var seconds = ("0" + date.getSeconds()).slice(-2);

            return year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
        }

        function checkLoggedUser() {
            if (localStorage.getItem('logged_user') == null) {
                $('#become-user-form').show();
                $('#logout-form').hide();
            } else {
                $('#become-user-form').hide();
                $('#logout-form').show();
            }
        }

        function appendComment(name, message, date) {
            let message_line = '';
            if (message.toLowerCase().includes('заборона') || message.toLowerCase().includes('decline')) {
                message_line = "<li class='list-group-item'><strong>" + name + "</strong> at " + date + ": <i style='filter: blur(3px);'>" + message + "</i></li>"
            } else {
                message_line = "<li class='list-group-item'><strong>" + name + "</strong> at " + date + ": <i>" + message + "</i></li>"
            }
            /*if (localStorage.getItem('logged_user') != null && localStorage.getItem('logged_user_role') == 'admin') {

                let delete_message = '<a href="#" id="delete_message_ref" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>'
                message_line = message_line + delete_message;
            }*/
            $("#list-of-messages").append(message_line);
        }

        $(document).ready(function () {
            $('#label-for-name').text('Name: ');
            $.ajax({
                url: 'messages.php',
                method: 'GET',
                success: function (request) {
                    checkLoggedUser();
                    if (request.data) {
                        request.data.map(function (comment) {
                            if (comment.name == null) {
                                let messageArray = comment.message.split(":");
                                comment.name = messageArray[0];
                                comment.message = messageArray[1];
                            }
                            appendComment(comment.name, comment.message, comment.date);
                        })
                    } else {
                        $('#list-of-messages').append('<li class="list-group-item">No messages yet</li>');
                    }
                }
            });

            $('#add-message-form').submit(function (event) {
                event.preventDefault();

                let data = {
                    name: $(this).find('input[name="name"]').val(),
                    message: $(this).find('input[name="message"]').val(),
                    date: getCurrentDateTime(),
                    logged_id: localStorage.getItem('logged_user_id')
                };

                $.ajax({
                    url: 'add-new-message.php',
                    method: 'POST',
                    data: data,
                    success: function (request) {
                        let user_name = data.name;
                        if (data.name == '' && localStorage.getItem('logged_user') != null) {
                            user_name = localStorage.getItem('logged_user_name');
                        }
                        appendComment(user_name, data.message, data.date);
                        $('#add-message-form').trigger("reset");
                    }
                });
            });

            $('#become-user-form').submit(function (event) {
                    event.preventDefault();
                    let data = {
                        email: $(this).find('input[name="email"]').val(),
                        password: $(this).find('input[name="password"]').val()
                    };

                    $.ajax({
                        url: 'become-user.php',
                        method: 'POST',
                        data: data,
                        success: function (request) {
                            const data = JSON.parse(request).data;
                            console.log(data);
                            let has_error = data.has_error;
                            if (!has_error) {
                                localStorage.setItem('logged_user', data.logged_user);
                                localStorage.setItem('logged_user_name', data.logged_user.name);
                                localStorage.setItem('logged_user_id', data.logged_user.id);
                                //localStorage.setItem('logged_user_role', data.logged_user.role);
                                $('#label-for-name').html('Name: <strong>' + data.logged_user.name + '</strong>');
                                $('input[name="name"]').hide();
                                $("#error-div").addClass('d-none');
                            } else {
                                $("#error-div").removeClass('d-none');
                                document.getElementById("error-message").innerText = data.error_message;
                            }
                            checkLoggedUser();
                        }
                    });
                }
            );

            $('#logout-form').submit(function (event) {
                event.preventDefault();
                localStorage.removeItem('logged_user');
                localStorage.removeItem('logged_user_name');
                localStorage.removeItem('logged_user_id');
                //localStorage.removeItem('logged_user_role');
                $('#label-for-name').text('Name: ');
                $('input[name="name"]').show();
                checkLoggedUser();
            });
        });
    </script>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-8 me-3">
            <div class="card">
                <div class="card-header">
                    Chat
                </div>
                <ul class="list-group list-group-flush" id="list-of-messages">

                </ul>
            </div>
            <?php /*if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['role'] == 'admin'): */ ?><!--
                <div class="row justify-content-end mt-3">
                    <form method="POST" class="col-3">
                        <button type="submit" name="clear_messages" class="btn btn-primary">Clear messages</button>
                    </form>
                </div>
            --><?php /*endif; */ ?>
            <form method="post" class="mt-3" id="add-message-form">
                <div class="mb-3">
                    <?php /*if (isset($_SESSION['logged_user'])): */ ?><!--
                        <label class="form-label">Name:
                            <strong><?php /*= $_SESSION['logged_user']['name']; */ ?></strong></label>
                    <?php /*else: */ ?>
                        <label for="name" class="form-label">Name:</label>
                        <input
                                type="text"
                                class="form-control"
                                name="name"
                        >
                    --><?php /*endif; */ ?>
                    <label for="name" class="form-label" id="label-for-name"></label>
                    <input
                            type="text"
                            class="form-control"
                            name="name"
                    >
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
                        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                    </svg>
                    <div id="error-div" class="mb-3 alert alert-warning d-flex align-items-center d-none" role="alert">
                        <svg class="icon-small bi flex-shrink-0 me-2" role="img" aria-label="Warning:">
                            <use xlink:href="#exclamation-triangle-fill"/>
                        </svg>
                        <div id="error-message">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php /*if (!isset($_SESSION['logged_user'])): */ ?>
                <form method="POST" class="col-8 border border-primary border-2 rounded-4 p-3"
                      id="become-user-form">
                    <div class="mt-3 row justify-content-center">
                        <label for="email" class="form-label col-9">Email
                            <?php /*if (empty($_POST) || (!empty($_POST['email']) && !empty($_POST['password']))): */ ?><!--
                                    <input type="text" name="email" placeholder="name@example.com"
                                           class="form-control my-1">
                                <?php /*elseif (!empty($_POST['email']) &&
                                    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)): */ ?>
                                    <input type="text" name="email" placeholder="name@example.com"
                                           class="form-control my-1"
                                           value="<?php /*= $_POST['email']; */ ?>">
                                <?php /*else: */ ?>
                                    <input type="text" name="email" placeholder="name@example.com"
                                           class="form-control my-1">
                                --><?php /*endif; */ ?>
                            <input type="text" name="email" placeholder="name@example.com"
                                   class="form-control my-1">
                        </label>
                        <label for="password" class="form-label col-9">Password
                            <input type="password" name="password" class="form-control my-1">
                        </label>
                    </div>
                    <div class="row justify-content-center my-3">
                        <button type="submit" name="become_user" class="col-7 btn btn-primary">Continue</button>
                    </div>
                </form>
                <?php /*else: */ ?>
                <form method="POST" class="mb-2" id="logout-form">
                    <button type="submit" name="logout" class="col-7 btn btn-primary">Logout</button>
                </form>
                <?php /*endif; */ ?>
            </div>
        </div>
    </div>
</div>
</body>

