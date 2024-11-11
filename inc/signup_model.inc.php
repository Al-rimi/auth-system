<?php

declare(strict_types=1);

/**
 * Fetches a user by username from the database.
 * Returns associative array containing username or null if not found.
 */
function getUsername(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

/**
 * Fetches a user by email from the database.
 * Returns associative array containing email or null if not found.
 */
function getEmail(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

/**
 * Inserts a new user into the database.
 */
function setUser(object $pdo, string $username, string $email, string $pwd)
{
    $query = "INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd);";
    $stmt = $pdo->prepare($query);

    // Hash the password securely
    $options = [
        'cost' => 10
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    // Bind parameters and execute query
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->execute();
}