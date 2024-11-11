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
    // Use the environment variable URL if no location is provided.
    $redirectUrl = $location ?? $_ENV['APP_DOMAIN'] ?? '/';

    // Perform the redirection.
    header("Location: $redirectUrl", true, $statusCode);
    exit();
}