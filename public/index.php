<?php

/**
 * Entry point for the URL Shortener application.
 * 
 * Handles class autoloading, session initialization, route definition, and dispatching.
 */

// Load environment variables from .env (must run before autoloader touches env vars)
require_once dirname(__DIR__) . '/core/Env.php';
\Core\Env::load(dirname(__DIR__));

// Autoload classes based on namespace
spl_autoload_register(function ($class) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Start user session
session_start();

// Initialize the core Router
use Core\Router;

$router = new Router();

/**
 * Define Application Routes
 */

// Public routes
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/login', 'AuthController@showLogin');
$router->add('POST', '/login', 'AuthController@login');
$router->add('GET', '/register', 'AuthController@showRegister');
$router->add('POST', '/register', 'AuthController@register');
$router->add('GET', '/logout', 'AuthController@logout');

// Protected Dashboard & Link management routes
$router->add('GET', '/dashboard', 'DashboardController@index');
$router->add('POST', '/links/create', 'LinkController@create');
$router->add('GET', '/history', 'LinkController@history');
$router->add('POST', '/links/delete/{id}', 'LinkController@delete');

// Protected Analytics & Profile routes
$router->add('GET', '/analytics/{id}', 'AnalyticsController@show');
$router->add('GET', '/profile', 'ProfileController@index');
$router->add('POST', '/profile/update', 'ProfileController@update');

// Support Pages
$router->add('GET', '/privacy', 'SupportController@privacy');
$router->add('GET', '/terms', 'SupportController@terms');
$router->add('GET', '/api', 'SupportController@api');
$router->add('GET', '/contact', 'SupportController@contact');

// Dynamic redirection route (catch-all for short slugs)
$router->add('GET', '/{slug}', 'RedirectController@handle');

// Dispatch the request to the matched controller method
$router->dispatch();
