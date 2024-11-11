let typingTimer;
const doneTypingInterval = 100;
const submitButton = document.getElementById("b1");

submitButton.addEventListener("click", function () {
    if (submitButton.classList.contains("mainbNo")) {
        submitButton.disabled = true;
        submitButton.classList.add("shakeb");

        setTimeout(() => {
            submitButton.disabled = false;
            submitButton.classList.remove("shakeb");
        }, 500);

        const inputs = document.querySelectorAll('input');
        let firstInvalidInput = null;

        inputs.forEach(input => {
            if (!input.value) {
                input.classList.add("no");
                if (!firstInvalidInput) {
                    firstInvalidInput = input;
                }
            }
        });

        if (firstInvalidInput) {
            firstInvalidInput.focus();
        }
    }
});

function setValid(element) {
    element.classList.remove("no");
}

function setInvalid(element) {
    element.classList.add("no");
}

function clearInvalid(element) {
    element.classList.remove("no");
}

function toggleButtonState(isFormValid) {
    if (isFormValid) {
        submitButton.classList.remove("mainbNo");
        submitButton.classList.add("mainb");
    } else {
        submitButton.classList.remove("mainb");
        submitButton.classList.add("mainbNo");
    }
}

function validateUsername(username) {
    const isValidCharacters = /^[\p{L}\p{N}_\-\s]+$/u.test(username.value);
    const isValidLengthLong = username.value.length > 0 && username.value.length <= 30;
    const isValidLengthShort = username.value.length >= 3;

    document.getElementById("usernameTaking").style.display = "none";
    document.getElementById("usernameNotValidCharacters").style.display = isValidCharacters ? "none" : "block";
    document.getElementById("usernameNotValidLengthLong").style.display = isValidLengthLong ? "none" : "block";
    document.getElementById("usernameNotValidLengthShort").style.display = isValidLengthShort ? "none" : "block";

    return isValidCharacters && isValidLengthLong && isValidLengthShort;
}

function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email.value);
    document.getElementById("emailTaking").style.display = "none";
    document.getElementById("emailNotValidPattern").style.display = emailPattern ? "none" : "block";

    return emailPattern;
}

function validatePassword(password) {
    const length = /^.{8,}$/.test(password.value);
    const uppercase = /[A-Z]/.test(password.value);
    const lowercase = /[a-z]/.test(password.value);

    document.getElementById("passwordNotValidLength").style.display = length ? "none" : "block";
    document.getElementById("passwordNoUppercaselowercase").style.display = (uppercase && lowercase) ? "none" : "block";

    return length && uppercase && lowercase;
}

function validate() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
}

function doneTyping() {
    let isFormValid = true;
    const username = document.getElementById("i1");
    const email = document.getElementById("i3");
    const password = document.getElementById("i2");
    const confirmPassword = document.getElementById("i4");

    if (username.value) {
        if (validateUsername(username)) {
            setValid(username);
        } else {
            setInvalid(username);
            isFormValid = false;
        }
    } else {
        clearInvalid(username);
        isFormValid = false;
    }

    if (email.value) {
        if (validateEmail(email)) {
            setValid(email);
        } else {
            setInvalid(email);
            isFormValid = false;
        }
    } else {
        clearInvalid(email);
        isFormValid = false;
    }

    if (password.value) {
        if (validatePassword(password)) {
            setValid(password);
        } else {
            setInvalid(password);
            isFormValid = false;
        }
    } else {
        clearInvalid(password);
        isFormValid = false;
    }

    if (password.value && confirmPassword.value && validatePassword(password)) {
        if (password.value === confirmPassword.value) {
            setValid(confirmPassword);
            document.getElementById("passwordsMatch").style.display = "none";
        } else {
            setInvalid(confirmPassword);
            isFormValid = false;
            document.getElementById("passwordsMatch").style.display = "block";
        }
    } else {
        clearInvalid(confirmPassword);
        document.getElementById("passwordsMatch").style.display = "none";
        isFormValid = false;
    }

    toggleButtonState(isFormValid);
}

document.getElementById("i1").addEventListener("input", validate);
document.getElementById("i2").addEventListener("input", validate);
document.getElementById("i3").addEventListener("input", validate);
document.getElementById("i4").addEventListener("input", validate);
