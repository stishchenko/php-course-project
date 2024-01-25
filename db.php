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
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
    $params = compact('email', 'password');
    if ($statement->execute($params)) {
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    return false;
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