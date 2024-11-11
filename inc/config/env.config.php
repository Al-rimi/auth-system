<?php

// Define the correct path to your .env file
$envPath = __DIR__ . '/../.env';

// Check if the .env file exists
if (file_exists($envPath)) {
    
    // Read the .env file line by line
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignore comments in the .env file
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Split each line into a key-value pair
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            
            // Remove whitespace and any enclosing quotes
            $name = trim($name);
            $value = trim($value, " \t\n\r\0\x0B\"");

            // Set the environment variable if not already set
            if (!array_key_exists($name, $_ENV)) {
                putenv("$name=$value");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
} 
