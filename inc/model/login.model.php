<?php

declare(strict_types=1);

function getUsernameOrEmail(object $pdo, string $usernameOremail)
{
    $query = "SELECT * FROM users WHERE username = :usernameOremail OR email = :usernameOremail;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":usernameOremail", $usernameOremail);  // Correct binding
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}