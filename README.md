# AuthEase (or auth-system)

A simple and fully functional login and signup system built using raw PHP, JavaScript, HTML, CSS, and JSON for client-side translations. This project supports multilingual authentication, with both client-side and server-side validation, enhancing user experience and security.

## Features

- **Client-Side Authentication**: For quick user feedback and seamless user experience.
- **Server-Side Authentication**: Ensures secure data handling and prevents unauthorized access.
- **Multi-language Support**: Supports nine languages (English, Arabic, French, Chinese, Russian, German, Spanish, Italian, and Portuguese).
- **Customizable & Lightweight**: Minimal dependencies and modular design.

## Supported Languages

To provide a smooth, multilingual experience, this system can dynamically switch between the following languages:

```javascript
const supportedLanguages = ['en', 'ar', 'fr', 'zh', 'ru', 'de', 'es', 'it', 'pt'];
```

## Project Structure

- **PHP**: Handles server-side authentication and secure data processing.
- **JavaScript**: Manages client-side validation and translations.
- **HTML/CSS**: Basic layout and styling for a clean UI.
- **JSON**: Language files that store translation strings for easy client-side access.

## Getting Started

1. **Clone the repository:**
   ```bash
   git clone https://github.com/YourUsername/auth-system.git
   ```
2. **Set up your server environment:**
   - Ensure you have PHP installed (v7 or above is recommended).
   - Run the project on a local server (e.g., XAMPP, WAMP, or MAMP).
3. **Configure the project settings:**
   - Add your database details in the `config.php` file.
4. **Add language translations**: 
   - Modify JSON files in the `languages` directory to adjust language strings as needed.

## Usage

1. **Signup**: Register a new account by providing the required information.
2. **Login**: Log in with your credentials to access protected areas.
3. **Language Selection**: Switch between languages using the provided language selector.

## Project Roadmap

- **OAuth Integration**: Plan to add Google and Facebook login options.
- **Enhanced UI**: Explore additional themes for improved accessibility.
- **Error Handling**: Expand validation for improved security and user experience.

## Contributing

Pull requests are welcome. Please make sure to update tests as appropriate.