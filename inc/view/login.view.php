<?php

declare(strict_types=1);

require_once __DIR__ . '/../contr/route.contr.php';

/**
 * Generates the HTML markup for the login form inputs (username/email, password) 
 * and displays any error messages related to login failures.
 */
function loginInputs()
{
    // Username or Email input and error handling
    $usernameOrEmail = $_SESSION["loginData"]["usernameOrEmail"] ?? '';
    $usernameOrEmailEscaped = htmlspecialchars($usernameOrEmail, ENT_QUOTES, 'UTF-8');
    $usernameOrEmailInput = '<input id="i1" type="text" name="usernameOrEmail" autocomplete="username" spellcheck="false" placeholder="" oninput="setDirection(this)" dir=""';

    $hasUserNotFoundError = isset($_SESSION["errorsLogin"]["userNotFound"]);
    $emptyInput = isset($_SESSION["errorsLogin"]["emptyInput"]);

    $usernameOrEmailInput .= $emptyInput || $hasUserNotFoundError ? ' class="no"' : '';
    $usernameOrEmailInput .= ' value="' . $usernameOrEmailEscaped . '">';

    $usernameOrEmailDisplayWrong = $hasUserNotFoundError ? 'style="display: block;"' : 'style="display: none;"';
    $usernameOrEmailDisplayEmpty = $emptyInput ? 'style="display: block;"' : 'style="display: none;"';

    $usernameOrEmailErrorMessages = '<div class="errorMessageDiv">';
    $usernameOrEmailErrorMessages .= '<p id="usernameOrEmailWrong" class="errorMessage" ' . $usernameOrEmailDisplayWrong . '></p>';
    $usernameOrEmailErrorMessages .= '<p id="usernameOrEmailEmpty" class="errorMessage" ' . $usernameOrEmailDisplayEmpty . '></p>';
    $usernameOrEmailErrorMessages .= '</div>';

    // Password input and error handling
    $passwordInput = '<div class="password-wrapper"><input id="i2" type="password" autocomplete="current-password" name="pwd" spellcheck="false" placeholder="" oninput="setDirection(this)" dir="ltr"';
    
    $passwordWrong = isset($_SESSION["errorsLogin"]["passwordWrong"]);

    $passwordInput .= $emptyInput || $passwordWrong ? ' class="no"' : '';
    $passwordInput .= '>';
    $passwordInput .= '<img class="showHideImage" id="toggleIcon" src="assets/images/heading.svg" alt="Show Password"></div>';

    $passwordDisplayWrong = $passwordWrong ? 'style="display: block;"' : 'style="display: none;"';
    $passwordDisplayEmpty = $emptyInput ? 'style="display: block;"' : 'style="display: none;"';

    $passwordErrorMessages = '<div class="errorMessageDiv">';
    $passwordErrorMessages .= '<p id="passwordWrong" class="errorMessage" ' . $passwordDisplayWrong . '></p>';
    $passwordErrorMessages .= '<p id="passwordEmpty" class="errorMessage" ' . $passwordDisplayEmpty . '></p>';
    $passwordErrorMessages .= '</div>';

    // Output all inputs and error messages
    echo $usernameOrEmailInput . $usernameOrEmailErrorMessages;
    echo $passwordInput . $passwordErrorMessages;
}

/**
 * Checks for login errors in the session and logs them to the console. 
 * If login is successful, logs success and redirects to the homepage.
 */
function checkErrors()
{
    if (isset($_SESSION['errorsLogin'])) {
        // Log all login errors to the console
        $errors = $_SESSION['errorsLogin'];
        echo '<script>';
        foreach ($errors as $key => $error) {
            $errorEscaped = addslashes($error);
            echo 'console.error("' . $errorEscaped . '");';
        }
        echo '</script>';
        unset($_SESSION['errorsLogin']);
    } elseif (isset($_SESSION['userId'])) {
        // Log success and redirect to the homepage after successful login
        echo '<script>';
        echo 'console.log("Login success!");';
        echo '</script>';
        redirect('/');
    }
}