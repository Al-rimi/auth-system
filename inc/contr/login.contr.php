<?php

declare(strict_types=1);

function isInputEmpty(string $usernameOrEmail, string $pwd): bool
{
    return empty($usernameOrEmail) || empty($pwd);
}

function isUsernameOrEmailWrong(bool|array $result){
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

function isPasswordWrong(string $pwd, string $hashedPwd){
    if (!password_verify($pwd, $hashedPwd)) {
        return true;
    } else {
        return false;
    }
}