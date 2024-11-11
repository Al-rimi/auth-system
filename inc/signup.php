<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $email = $_POST["email"] ?? '';
    $pwd = $_POST["pwd"] ?? '';
    $errors = [];

    require_once __DIR__ . './contr/route.contr.php';
    require_once __DIR__ . './contr/signup.contr.php';

    if (!isInputEmpty($username, $email, $pwd)) {
        try {
            require_once __DIR__ . './config/db.config.php';
            require_once __DIR__ . './model/signup.model.php';


            if (isEmail($email)) {
                $errors["emailCheck"] = "Please enter a valid email address!";
            }
            if (isUsernameTaking($pdo, $username)) {
                $errors["usernameTaking"] = "Username already taken!";
            }
            if (isEmailTaking($pdo, $email)) {
                $errors["emailTaking"] = "Email already used!";
            }

            require_once __DIR__ . './config/signup_session.config.php';

            if (!$errors) {
                createUser($pdo, $username, $email, $pwd);

                session_regenerate_id(true);
                $newSessionId = session_id();
                $userId = bin2hex(random_bytes(16));
                $SessionId = $newSessionId . "_" . $userId;
                session_id($SessionId);

                $_SESSION["userId"] = $userId;
                redirect('/');
                exit();
            } else {
                $_SESSION['errorsSignup'] = $errors;
                $_SESSION['signupData'] = [
                    'username' => $username,
                    'email' => $email,
                    'pwd' => $pwd
                ];
                redirect('/signup');
                exit();
            }
        } catch (PDOException $e) {
            // Handle database connection errors
            die("Connection failed: " . $e->getMessage());
        }
    } else {
        require_once __DIR__ . './config/signup_session.config.php';

        $_SESSION['errorsSignup']['emptyInput'] = "Please fill in all the fields!";
        redirect('/signup');
        exit();
    }
} else {
    // Redirect if accessed directly without POST method
    redirect('/signup');
    exit();
}
