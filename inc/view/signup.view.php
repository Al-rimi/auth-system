<?php

declare(strict_types=1);

function signupInputs()
{
    // Username input and error handling
    $usernameInput = '<input id="i1" type="text" autocomplete="username" name="username" spellcheck="false" placeholder="" oninput="setDirection(this)" dir="';
    $usernameValue = isset($_SESSION["signupData"]["username"]) ? $_SESSION["signupData"]["username"] : '';
    if (isset($_SESSION["signupData"]["username"])) {
        $usernameInput .= !isset($_SESSION["errorsSignup"]["usernameTaking"]) ? '" value="' . $usernameValue . '">' : '" class="no" value="' . $usernameValue . '">';
        $usernameDisplay = isset($_SESSION["errorsSignup"]["usernameTaking"]) ? 'style="display: block;"' : 'style="display: none;"';
    } else {
        $usernameInput .= '">';
        $usernameDisplay = 'style="display: none;"';
    }
    $usernameErrorMessages = '<div class="errorMessageDiv">';
    $usernameErrorMessages .= '<p id="usernameTaking" class="errorMessage" ' . $usernameDisplay . '></p>';
    $usernameErrorMessages .= '<p id="usernameNotValidLengthLong" class="errorMessage" style="display: none;"></p>';
    $usernameErrorMessages .= '<p id="usernameNotValidLengthShort" class="errorMessage" style="display: none;"></p>';
    $usernameErrorMessages .= '<p id="usernameNotValidCharacters" class="errorMessage" style="display: none;"></p>';
    $usernameErrorMessages .= '</div>';

    // Email input and error handling
    $emailInput = '<input id="i3" type="text" autocomplete="email" name="email" spellcheck="false" placeholder="" oninput="setDirection(this)" dir="ltr"';
    $emailValue = isset($_SESSION["signupData"]["email"]) ? $_SESSION["signupData"]["email"] : '';
    if (isset($_SESSION["signupData"]["email"])) {
        $emailInput .= !isset($_SESSION["errorsSignup"]["emailTaking"]) && !isset($_SESSION["errorsSignup"]["emailCheck"]) ? ' value="' . $emailValue . '">' : ' class="no" value="' . $emailValue . '">';
        $emailDisplay = isset($_SESSION["errorsSignup"]["emailTaking"]) ? 'style="display: block;"' : 'style="display: none;"';
    } else {
        $emailInput .= '>';
        $emailDisplay = 'style="display: none;"';
    }
    $emailErrorMessages = '<div class="errorMessageDiv">';
    $emailErrorMessages .= '<p id="emailTaking" class="errorMessage" ' . $emailDisplay . '></p>';
    $emailErrorMessages .= '<p id="emailNotValidPattern" class="errorMessage" style="display: none;"></p>';
    $emailErrorMessages .= '</div>';

    // Password input and error handling
    $passwordInput = '<div class="password-wrapper"><input id="i2" type="password" autocomplete="new-password" name="pwd" spellcheck="false" placeholder="" oninput="setDirection(this)" dir="ltr"';
    $passwordValue = isset($_SESSION["signupData"]["pwd"]) ? $_SESSION["signupData"]["pwd"] : '';
    $passwordInput .= ' value="' . $passwordValue . '">';
    $passwordInput .= '<img class="showHideImage" id="toggleIcon" src="assets/images/heading.svg" alt="Show Password"></div>';
    $passwordErrorMessages = '<div class="errorMessageDiv">';
    $passwordErrorMessages .= '<p id="passwordNoUppercaselowercase" class="errorMessage" style="display: none;"></p>';
    $passwordErrorMessages .= '<p id="passwordNotValidLength" class="errorMessage" style="display: none;"></p>';
    $passwordErrorMessages .= '</div>';

    // Confirm password input
    $confirmPasswordInput = '<input id="i4" type="password" autocomplete="off" name="conpwd" spellcheck="false" placeholder="" oninput="setDirection(this)" dir="">';
    $confirmPasswordErrorMessages = '<div class="errorMessageDiv">';
    $confirmPasswordErrorMessages .= '<p id="passwordsMatch" class="errorMessage" style="display: none;"></p>';
    $confirmPasswordErrorMessages .= '</div>';

    // Output all inputs and error messages
    echo $usernameInput . $usernameErrorMessages;
    echo $emailInput . $emailErrorMessages;
    echo $passwordInput . $passwordErrorMessages;
    echo $confirmPasswordInput . $confirmPasswordErrorMessages;
}

function checkErrors()
{
    if (isset($_SESSION['errorsSignup'])) {
        $errors = $_SESSION['errorsSignup'];
        echo '<script>';
        foreach ($errors as $key => $error) {
            echo 'console.error("' . addslashes($error) . '");';
        }
        echo '</script>';
        unset($_SESSION['errorsSignup']);
    } elseif (isset($_SESSION['userID'])) {
        echo '<script>';
        echo 'console.log("Signup success!");';
        echo '</script>';

        header("Location: ../");
    }
}