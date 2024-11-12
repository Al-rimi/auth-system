<?php

require_once __DIR__ . '/../config/env.config.php';

/**
 * Redirects to a given URL, defaulting to the URL specified in the .env file.
 *
 * @param string|null $location The custom location to redirect to.
 * @param int $statusCode HTTP status code for the redirection (default 302).
 */
function redirect(?string $location = null, int $statusCode = 302): void
{
    // Set the home base URL from the environment variable or default to '/'.
    $home = $_ENV['APP_DOMAIN'] ?? '/';

    // Ensure the base URL starts with a protocol (http or https).
    if (!preg_match('#^https?://#', $home)) {
        $home = 'http://' . $home;
    }

    // Combine the home URL with the provided location (or default to the home itself if $location is null).
    $redirectUrl = rtrim($home, '/') . '/' . ltrim($location ?? '', '/');

    // Perform the redirection.
    header("Location: $redirectUrl", true, $statusCode);
    exit();
}
