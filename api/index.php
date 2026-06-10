<?php

// Fix for Vercel routing: Prevent Laravel from stripping '/api' prefix
// because this file is located inside the 'api/' directory.
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';

// Forward to Laravel's public entry point for serverless deployment on Vercel
require __DIR__ . '/../public/index.php';
