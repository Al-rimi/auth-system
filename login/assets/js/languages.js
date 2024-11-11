// Determine the user's language preference
var userLanguage = (navigator.language || navigator.userLanguage).substring(0, 2);
const supportedLanguages = ['en', 'ar', 'fr', 'zh', 'ru', 'de', 'es', 'it', 'pt'];
const rtlLanguages = ['ar', 'he', 'fa', 'ur'];
const language = supportedLanguages.includes(userLanguage) ? userLanguage : 'en';

// Function to set attribute content
function setAttributeContent(id, attribute, content) {
    const element = document.getElementById(id);
    if (element) {
        element.setAttribute(attribute, content || '');
    }
}

// Function to set direction based on text
function setDirection(input) {
    const textToCheck = input.value || input.placeholder;
    const isArabic = /[\u0600-\u06FF\u0750-\u077F]/.test(textToCheck.charAt(0));
    
    input.dir = isArabic ? 'rtl' : 'ltr';

    // Adjust the toggle icon based on the direction of password input
    if (input.id === 'i2') {
        const toggleIcon = document.getElementById('toggleIcon');
        if (isArabic) {
            toggleIcon.classList.add("showHideImageRtl");
        } else {
            toggleIcon.classList.remove("showHideImageRtl");
        }
    }
}

// Fetch language data from JSON file
fetch(`./assets/languages/${language}.json`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        // Set HTML document language
        document.documentElement.lang = language;
        document.title = data.head.title || document.title;
        document.body.style.fontFamily = data.body.font || '';

        // Update meta tags and other elements
        document.querySelectorAll('.description').forEach(meta => {
            meta.setAttribute('content', data.head.description);
        });
        document.querySelectorAll('.keywords').forEach(meta => {
            meta.setAttribute('content', data.head.keywords);
        });
        document.querySelectorAll('.siteName').forEach(meta => {
            meta.setAttribute('content', data.head.siteName);
        });
        document.querySelectorAll('.title').forEach(meta => {
            meta.setAttribute('content', data.head.title);
        });
        document.querySelectorAll('.siteLanguage').forEach(meta => {
            meta.setAttribute('content', data.head.siteLanguage);
        });

        // Update form placeholders and directions
        document.getElementById('h1').textContent = data.body.h1 || '';
        document.getElementById('b1').textContent = data.body.b1 || '';
        document.getElementById('b2').textContent = data.body.b2 || '';
        document.getElementById('b3').textContent = data.body.b3 || '';

        const inputs = ['i1', 'i2'];
        inputs.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.placeholder = data.body[id] || '';
                input.dir = rtlLanguages.includes(language) ? 'rtl' : 'ltr';
            }
        });

        // Update error messages
        const errors = {
            usernameOrEmailWrong: data.body.username?.usernameOrEmailWrong,
            passwordWrong: data.body.password?.passwordWrong
        };

        Object.entries(errors).forEach(([key, value]) => {
            const element = document.getElementById(key);
            if (element) {
                element.textContent = value || '';
            }
        });

        // Adjust RTL for Right to left languages
        const isRtl = rtlLanguages.includes(language);
        document.getElementById('toggleIcon').classList.toggle('showHideImageRtl', isRtl);

        document.querySelectorAll('.errorMessageDiv .errorMessage').forEach(message => {
            message.dir = isRtl ? 'rtl' : 'ltr';
        });

        // Flip direction for inputs, buttons, and other relevant elements
        const elementsToFlip = document.querySelectorAll('input, button, textarea, select');
        elementsToFlip.forEach(element => {
            element.dir = isRtl ? 'rtl' : 'ltr';
        });

        // Optionally, adjust the text alignment if needed
        document.body.style.textAlign = isRtl ? 'right' : 'left';
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });

// Set direction for input fields based on their content
document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
    inputs.forEach(input => {
        input.addEventListener('focus', () => setDirection(input));
    });
});
