<?php

declare(strict_types=1);

/**
 * Checks if any of the input fields (username, email, password) is empty.
 * Returns true if any input is empty, false otherwise.
 * 
 * @param string $username The username input from the form.
 * @param string $email The email input from the form.
 * @param string $pwd The password input from the form.
 * @return bool True if any of the inputs are empty, false otherwise.
 */
function isInputEmpty(string $username, string $email, string $pwd): bool
{
    return empty($username) || empty($email) || empty($pwd);
}

/**
 * Validates if the given string is a valid email format.
 * Returns true if the email is invalid, false otherwise.
 * 
 * @param string $email The email to validate.
 * @return bool True if the email format is invalid, false otherwise.
 */
function isEmail(string $email): bool
{
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Checks if the given username is already taken in the database.
 * Returns true if the username is taken, false otherwise.
 * 
 * @param object $pdo The PDO database connection object.
 * @param string $username The username to check for existence.
 * @return bool True if the username is found in the database, false otherwise.
 */
function isUsernameTaking(object $pdo, string $username): bool
{
    return getUsername($pdo, $username) !== false;
}

/**
 * Checks if the given email is already registered in the database.
 * Returns true if the email is taken, false otherwise.
 * 
 * @param object $pdo The PDO database connection object.
 * @param string $email The email to check for existence.
 * @return bool True if the email is found in the database, false otherwise.
 */
function isEmailTaking(object $pdo, string $email): bool
{
    return getEmail($pdo, $email) !== false;
}

/**
 * Creates a new user in the database.
 * Assumes username, email, and password are validated before calling this function.
 * 
 * @param object $pdo The PDO database connection object.
 * @param string $username The username to create for the new user.
 * @param string $email The email to associate with the new user.
 * @param string $pwd The password for the new user.
 * @return void
 */
function createUser(object $pdo, string $username, string $email, string $pwd)
{
    setUser($pdo, $username, $email, $pwd);
}