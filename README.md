# Overview

This is a simple and fully functional login and signup system built with raw PHP, JavaScript, HTML, CSS, and JSON for client-side translations. This project offers multilingual authentication, with robust client-side and server-side validation, enhancing both user experience and security.

## Live Preview

Check out the [Live Demo](https://auth.demo.syalux.com) to see the login and signup system in action.

## Features

- **Client-Side Validation**: Provides instant feedback for a smooth user experience.
- **Server-Side Validation**: Ensures secure data handling and prevents unauthorized access.
- **Multi-language Support**: Currently supports nine languages: English, Arabic, French, Chinese, Russian, German, Spanish, Italian, and Portuguese.
- **Customizable & Lightweight**: Modular design with minimal dependencies for easy customization and fast performance.

## Supported Languages

This system dynamically switches between the following languages:

```javascript
const supportedLanguages = ['en', 'ar', 'fr', 'zh', 'ru', 'de', 'es', 'it', 'pt'];
```

## Project Structure

- **PHP**: Handles server-side authentication and secure data processing.
- **JavaScript**: Manages client-side validation and translations.
- **HTML/CSS**: Provides the basic layout and styling for a clean, user-friendly interface.
- **JSON**: Stores language files for easy access to client-side translations.

## Getting Started

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Al-rimi/auth-system.git
   ```

2. **Set up your server environment:**
   - Ensure PHP is installed (version 7 or above is recommended).
   - Run the project on a local server (e.g., XAMPP, WAMP, or MAMP).

3. **Configure the project settings:**
   - Create a MySQL database and table:
     ```sql
     CREATE DATABASE IF NOT EXISTS auth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
     USE auth;

     CREATE TABLE IF NOT EXISTS users (
         id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(50) NOT NULL UNIQUE,
         email VARCHAR(100) NOT NULL UNIQUE,
         pwd VARCHAR(255) NOT NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```

   - Update your `.env` file to set up domain and database configurations:

     ```bash
     # Application domain or IP address.
     APP_DOMAIN=localhost

     # Database connection settings.
     DB_HOST=localhost
     DB_NAME=auth
     DB_USER=root
     DB_PASSWORD=
     ```

## Usage

1. **Signup**: Register by providing a username, email, and password.
2. **Login**: Log in with your credentials to access protected content.
3. **Language Selection**: Use the language selector to switch between supported languages.

## Project Roadmap

- **OAuth Integration**: Add Google and Facebook login options.
- **Enhanced UI**: Improve accessibility and visual themes.
- **Error Handling**: Extend validation for enhanced security and user experience.

## Contributing

Pull requests are welcome! Please update or add tests as needed to maintain code quality.
