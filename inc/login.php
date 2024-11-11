<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameOrEmail = htmlspecialchars($_POST["usernameOrEmail"] ?? '');
    $pwd = $_POST["pwd"] ?? '';
    $errors = [];

    require_once 'contr/login.contr.php';

    if (!isInputEmpty($usernameOrEmail, $pwd)) {
        try {
            require_once 'config/db.config.php';
            require_once 'model/login.model.php';

            $result = getUsernameOrEmail($pdo, $usernameOrEmail);

            if (isUsernameOrEmailWrong($result)) {
                $errors["userNotFound"] = "Username don't exist";
            } elseif (isPasswordWrong($pwd, $result["pwd"])) {
                $errors["passwordWrong"] = "Incorrect password";
            }

            require_once 'config/login_session.config.php';
            if (empty($errors)) {
                session_regenerate_id(true);
                $newSessionId = session_id();
                $SessionId = $newSessionId . "_" . $result["id"];
                session_id($SessionId);

                $_SESSION["userId"] = $result["id"];
                $_SESSION["userUsername"] = htmlspecialchars($result["username"]);
                $_SESSION['last_regeneration'] = time();

                header("Location: ../login/?login=success");
                $pdo = null;
                exit();
            } else {
                $_SESSION['errorsLogin'] = $errors;
                $_SESSION['loginData'] = [
                    'usernameOrEmail' => $usernameOrEmail,
                ];
                header("Location: ../login");
                exit();
            }
        } catch (PDOException $e) {
            // Handle database connection errors gracefully
            $_SESSION['errorsLogin'] = ["dbError" => "A database error occurred. Please try again later."];
            header("Location: ../login");
            exit();
        }
    } else {
        require_once 'config/login_session.config.php';
        $_SESSION['errorsLogin']['emptyInput'] = "Please fill in all the fields!";
        header("Location: ../login");
        exit();
    }
} else {
    // Redirect if accessed directly without POST method
    header("Location: ../login");
    exit();
}