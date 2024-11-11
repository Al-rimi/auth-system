<?php

declare(strict_types=1);

/**
 * Fetches a user by either their username or email from the database.
 * Returns an associative array with user data if found, or null if not.
 *
 * @param object $pdo The PDO connection.
 * @param string $usernameOremail The username or email to search for.
 * @return array|null The user data array or null.
 */
function getUsernameOrEmail(object $pdo, string $usernameOremail)
{
    $query = "SELECT * FROM users WHERE username = :usernameOremail OR email = :usernameOremail;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":usernameOremail", $usernameOremail);  // Correct binding
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);  // Fetches user data or null
}
