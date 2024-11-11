<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $email = $_POST["email"] ?? '';
    $pwd = $_POST["pwd"] ?? '';
    $errors = [];

    require_once 'signup_contr.inc.php';

    if (!isInputEmpty($username, $email, $pwd)) {
        try {
            require_once 'dbh.inc.php';
            require_once 'signup_model.inc.php';


            if (isEmail($email)) {
                $errors["emailCheck"] = "Please enter a valid email address!";
            }
            if (isUsernameTaking($pdo, $username)) {
                $errors["usernameTaking"] = "Username already taken!";
            }
            if (isEmailTaking($pdo, $email)) {
                $errors["emailTaking"] = "Email already used!";
            }

            require_once 'config_session.inc.php';

            if (!$errors) {
                createUser($pdo, $username, $email, $pwd);

                header("Location: ../?signup=success");
                exit();
            } else {
                $_SESSION['errorsSignup'] = $errors;
                $_SESSION['signupData'] = [
                    'username' => $username,
                    'email' => $email,
                    'pwd' => $pwd
                ];
                header("Location: ../");
                exit();
            }
        } catch (PDOException $e) {
            // Handle database connection errors
            die("Connection failed: " . $e->getMessage());
        }
    } else {
        require_once 'config_session.inc.php';

        $_SESSION['errorsSignup']['emptyInput'] = "Please fill in all the fields!";
        header("Location: ../");
        exit();
    }
} else {
    // Redirect if accessed directly without POST method
    header("Location: ../");
    exit();
}
