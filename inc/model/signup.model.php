<?php

declare(strict_types=1);

/**
 * Fetches a user by username from the database.
 * Returns an associative array with the username if found, or null if not.
 *
 * @param object $pdo The PDO connection.
 * @param string $username The username to search for.
 * @return array|null The username array or null.
 */
function getUsername(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Fetches a user by email from the database.
 * Returns an associative array with the email if found, or null if not.
 *
 * @param object $pdo The PDO connection.
 * @param string $email The email to search for.
 * @return array|null The email array or null.
 */
function getEmail(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Inserts a new user into the database with a hashed password.
 * Uses bcrypt to hash the password before storing it.
 *
 * @param object $pdo The PDO connection.
 * @param string $username The user's username.
 * @param string $email The user's email.
 * @param string $pwd The user's password.
 * @return void
 */
function setUser(object $pdo, string $username, string $email, string $pwd)
{
    $query = "INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd);";
    $stmt = $pdo->prepare($query);
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, ['cost' => 10]);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->execute();
}
