<?php

declare(strict_types=1);

/**
 * Checks if either the username/email or password input fields are empty.
 * Returns true if any input is empty, false otherwise.
 *
 * @param string $usernameOrEmail The username or email input.
 * @param string $pwd The password input.
 * @return bool True if either input is empty, false otherwise.
 */
function isInputEmpty(string $usernameOrEmail, string $pwd): bool
{
    return empty($usernameOrEmail) || empty($pwd);
}

/**
 * Checks if the result of a username/email lookup is incorrect.
 * Returns true if the result is false (indicating an incorrect username or email).
 *
 * @param bool|array $result The result of the username or email lookup, typically a boolean or an array if found.
 * @return bool True if the username or email is incorrect, false otherwise.
 */
function isUsernameOrEmailWrong(bool|array $result): bool
{
    return !$result;
}

/**
 * Checks if the provided password does not match the stored hashed password.
 * Returns true if the password is incorrect, false otherwise.
 *
 * @param string $pwd The plain text password provided by the user.
 * @param string $hashedPwd The hashed password stored in the database.
 * @return bool True if the password is incorrect, false otherwise.
 */
function isPasswordWrong(string $pwd, string $hashedPwd): bool
{
    return !password_verify($pwd, $hashedPwd);
}
