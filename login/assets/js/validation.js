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

function toggleButtonState(isFormValid) {
    if (isFormValid) {
        submitButton.classList.remove("mainbNo");
        submitButton.classList.add("mainb");
    } else {
        submitButton.classList.remove("mainb");
        submitButton.classList.add("mainbNo");
    }
}

function validateusernameOrEmail(usernameOrEmail) {
    const isValidLengthLong = usernameOrEmail.value.length > 0 && usernameOrEmail.value.length <= 30;
    const isValidLengthShort = usernameOrEmail.value.length >= 3;

    document.getElementById("usernameOrEmailWrong").style.display = "none";

    return isValidLengthLong && isValidLengthShort;
}

function validatePassword(password) {
    const length = password.value.length >= 8;

    document.getElementById("passwordWrong").style.display = "none";

    return length;
}

function validate() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
}

function doneTyping() {
    let isFormValid = true;
    const usernameOrEmail = document.getElementById("i1");
    const password = document.getElementById("i2");

    if (usernameOrEmail.value) {
        if (validateusernameOrEmail(usernameOrEmail)) {
            setValid(usernameOrEmail);
        } else {
            isFormValid = false;
        }
    } else {
        setValid(usernameOrEmail);
        isFormValid = false;
    }

    if (password.value) {
        if (validatePassword(password)) {
            setValid(password);
        } else {
            isFormValid = false;
        }
    } else {
        setValid(usernameOrEmail);
        isFormValid = false;
    }

    toggleButtonState(isFormValid);
}

document.getElementById("i1").addEventListener("input", validate);
document.getElementById("i2").addEventListener("input", validate);
