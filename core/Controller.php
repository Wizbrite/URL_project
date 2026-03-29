<?php

namespace Core;

/**
 * Base Controller class for the MVC framework.
 * 
 * Provides common utility methods for children controllers, such as view rendering,
 * CSRF protection, and redirection.
 */
class Controller {
    /**
     * Renders a view file and extracts data into the view's scope.
     * 
     * @param string $name The name of the view file (without .php extension).
     * @param array $data Associative array of data to be made available in the view.
     * @return void
     */
    protected function view($name, $data = []) {
        extract($data);
        $viewFile = "../app/views/" . $name . ".php";
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View not found: " . $name);
        }
    }

    /**
     * Generates a CSRF token and stores it in the session if it doesn't exist.
     * 
     * @return string The generated or existing CSRF token.
     */
    protected function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validates the CSRF token provided in a POST request against the session token.
     * 
     * Terminates the script with a 403 error if validation fails.
     * 
     * @return void
     */
    protected function validateCsrfToken() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                header("HTTP/1.1 403 Forbidden");
                die("CSRF token validation failed.");
            }
        }
    }

    /**
     * Redirects the user to a specified URL.
     * 
     * @param string $url The destination URL.
     * @return void
     */
    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }
}
