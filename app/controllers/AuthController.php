<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;

/**
 * AuthController handles user authentication: login, registration, and logout.
 */
class AuthController extends Controller {
    /** @var User User model instance. */
    private $userModel;

    /**
     * Constructor initializes the user model and validates CSRF tokens for POST requests.
     */
    public function __construct() {
        $this->validateCsrfToken();
        $this->userModel = new User();
    }

    /**
     * Displays the login page. Redirects to dashboard if already logged in.
     * 
     * @return void
     */
    public function showLogin() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect(base_url('dashboard'));
        }
        $this->view('auth/login', ['title' => 'Login']);
    }

    /**
     * Processes the login request.
     * 
     * Verifies credentials and starts a session on success.
     * 
     * @return void
     */
    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $this->redirect(base_url('dashboard'));
        } else {
            $this->view('auth/login', ['error' => 'Invalid email or password', 'title' => 'Login']);
        }
    }

    /**
     * Displays the registration page. Redirects to dashboard if already logged in.
     * 
     * @return void
     */
    public function showRegister() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect(base_url('dashboard'));
        }
        $this->view('auth/register', ['title' => 'Register']);
    }

    /**
     * Processes the registration request.
     * 
     * Validates input, checks for existing email, and creates a new user.
     * 
     * @return void
     */
    public function register() {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($password !== $confirmPassword) {
            $this->view('auth/register', ['error' => 'Passwords do not match', 'title' => 'Register']);
            return;
        }

        if ($this->userModel->findByEmail($email)) {
            $this->view('auth/register', ['error' => 'Email already exists', 'title' => 'Register']);
            return;
        }

        if ($this->userModel->create($username, $email, $password)) {
            $this->redirect(base_url('login'));
        } else {
            $this->view('auth/register', ['error' => 'Something went wrong', 'title' => 'Register']);
        }
    }

    /**
     * Logs the user out by destroying the session.
     * 
     * @return void
     */
    public function logout() {
        session_destroy();
        $this->redirect(base_url('login'));
    }
}
