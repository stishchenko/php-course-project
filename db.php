<?php
function getPDO(): PDO
{
    $host = 'localhost';
    $username = 'root';
    $password = '12345678';
    $db = 'users_board';

    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

function getUsers(PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM users');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function checkUser(PDO $pdo, string $email, string $password): array|false
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    if ($statement->execute(['email' => $email])) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }
    }
    return false;
}

function addNewUser(PDO $pdo, string $name, string $email, string $password): void
{
    $statement = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $params = compact('name', 'email', 'password');
    if (!$statement->execute($params)) {
        echo 'User was not added';
    }
}

function deleteUser(PDO $pdo, int $user_id): void
{
    $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');
    if (!$statement->execute(['id' => $user_id])) {
        echo 'User was not deleted';
    }
}

function deleteAllUsers(PDO $pdo): void
{
    $statement = $pdo->prepare('DELETE FROM users');
    if (!$statement->execute()) {
        echo 'Users were not deleted';
    }
}

function getMessages(PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT messages.id as id, name, message, date FROM messages left join users on messages.user_id = users.id');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function addNewMessage(PDO $pdo, string $message, int $user_id = null): void
{
    $statement = $pdo->prepare('INSERT INTO messages (user_id, message) VALUES (:user_id, :message)');
    $params = compact('user_id', 'message');
    if (!$statement->execute($params)) {
        echo 'Message was not added';
    }
}

function deleteMessage(PDO $pdo, int $message_id): void
{
    $statement = $pdo->prepare('DELETE FROM messages WHERE id = :id');
    if (!$statement->execute(['id' => $message_id])) {
        echo 'Message was not deleted';
    }
}

function deleteAllMessages(PDO $pdo): void
{
    $statement = $pdo->prepare('DELETE FROM messages');
    if (!$statement->execute()) {
        echo 'Messages were not deleted';
    }
}