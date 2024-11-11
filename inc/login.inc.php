<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameOrEmail = htmlspecialchars($_POST["usernameOrEmail"] ?? '');
    $pwd = $_POST["pwd"] ?? '';
    $errors = [];

    require_once 'login_contr.inc.php';

    if (!isInputEmpty($usernameOrEmail, $pwd)) {
        try {
            require_once 'dbh.inc.php';
            require_once 'login_model.inc.php';

            $result = getUsernameOrEmail($pdo, $usernameOrEmail);

            if (isUsernameOrEmailWrong($result)) {
                $errors["userNotFound"] = "Username don't exist";
            } elseif (isPasswordWrong($pwd, $result["pwd"])) {
                $errors["passwordWrong"] = "Incorrect password";
            }

            require_once 'config_session.inc.php';
            if (empty($errors)) {
                session_regenerate_id(true);
                $newSessionId = session_id();
                $SessionId = $newSessionId . "_" . $result["id"];
                session_id($SessionId);

                $_SESSION["userId"] = $result["id"];
                $_SESSION["userUsername"] = htmlspecialchars($result["username"]);
                $_SESSION['last_regeneration'] = time();

                header("Location: ../?login=success");
                $pdo = null;
                exit();
            } else {
                $_SESSION['errorsLogin'] = $errors;
                $_SESSION['loginData'] = [
                    'usernameOrEmail' => $usernameOrEmail,
                ];
                header("Location: ../");
                exit();
            }
        } catch (PDOException $e) {
            // Handle database connection errors gracefully
            $_SESSION['errorsLogin'] = ["dbError" => "A database error occurred. Please try again later."];
            header("Location: ../");
            exit();
        }
    } else {
        require_once 'config_session.inc.php';
        $_SESSION['errorsLogin']['emptyInput'] = "Please fill in all the fields!";
        header("Location: ../");
        exit();
    }
} else {
    // Redirect if accessed directly without POST method
    header("Location: ../");
    exit();
}
