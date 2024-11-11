<?php

// Sessions use cookies only and strict mode
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// Session cookie parameters
session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']), // Only if HTTPS
    'httponly' => true
]);

// Start the session if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Regenerate session ID if needed
if (!isset($_SESSION['last_regeneration'])) {
    regenerate_session_id();
} else {
    $interval = 60 * 30; // 30 minutes
    if (time() - $_SESSION['last_regeneration'] >= $interval) {
        regenerate_session_id();
    }
}

/**
 * Regenerates the session ID and updates the regeneration time.
 */
function regenerate_session_id() {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
