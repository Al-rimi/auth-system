<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameOrEmail = htmlspecialchars($_POST["usernameOrEmail"] ?? '');
    $pwd = $_POST["pwd"] ?? '';
    $errors = [];

    require_once __DIR__ . './contr/route.contr.php';
    require_once __DIR__ . './contr/login.contr.php';



    if (!isInputEmpty($usernameOrEmail, $pwd)) {
        try {
            require_once __DIR__ . './config/db.config.php';
            require_once __DIR__ . './model/login.model.php';

            $result = getUsernameOrEmail($pdo, $usernameOrEmail);

            if (isUsernameOrEmailWrong($result)) {
                $errors["userNotFound"] = "Username don't exist";
            } elseif (isPasswordWrong($pwd, $result["pwd"])) {
                $errors["passwordWrong"] = "Incorrect password";
            }

            require_once __DIR__ . './config/login_session.config.php';
            if (empty($errors)) {
                session_regenerate_id(true);
                $newSessionId = session_id();
                $SessionId = $newSessionId . "_" . $result["id"];
                session_id($SessionId);

                $_SESSION["userId"] = $result["id"];
                redirect('/');
                $pdo = null;
                exit();
            } else {
                $_SESSION['errorsLogin'] = $errors;
                $_SESSION['loginData'] = [
                    'usernameOrEmail' => $usernameOrEmail,
                ];
                redirect('/login');
                exit();
            }
        } catch (PDOException $e) {
            // Handle database connection errors gracefully
            $_SESSION['errorsLogin'] = ["dbError" => "A database error occurred. Please try again later."];
            redirect('/login');
            exit();
        }
    } else {
        require_once __DIR__ . './config/login_session.config.php';
        $_SESSION['errorsLogin']['emptyInput'] = "Please fill in all the fields!";
        redirect('/login');
        exit();
    }
} else {
    // Redirect if accessed directly without POST method
    redirect('/login');
    exit();
}
