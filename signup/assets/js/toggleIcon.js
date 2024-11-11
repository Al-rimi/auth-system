document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('toggleIcon').addEventListener('click', function() {
        const passwordField = document.getElementById('i2');
        const toggleIcon = document.getElementById('toggleIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.src = 'assets/images/showing.svg';
            toggleIcon.alt = 'Hide Password';
        } else {
            passwordField.type = 'password';
            toggleIcon.src = 'assets/images/heading.svg';
            toggleIcon.alt = 'Show Password';
        }
    });
});
