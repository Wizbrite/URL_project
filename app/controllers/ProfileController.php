<?php

namespace app\controllers;

use core\Controller;
use app\models\User;
use app\models\Link;

/**
 * ProfileController manages the user's profile information and account statistics.
 */
class ProfileController extends Controller {
    /** @var User User model instance. */
    private $userModel;
    /** @var Link Link model instance. */
    private $linkModel;

    /**
     * Constructor verifies user session, validates CSRF token, and initializes models.
     */
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/URL_project/public/login');
        }
        $this->validateCsrfToken();
        $this->userModel = new User();
        $this->linkModel = new Link();
    }

    /**
     * Displays the user's profile and summary statistics.
     * 
     * @return void
     */
    public function index() {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->findById($userId);
        $totalLinks = $this->linkModel->getCountByUserId($userId);
        
        // Sum clicks across all user's links
        $links = $this->linkModel->getByUserId($userId, 0, 1000);
        $totalClicks = 0;
        foreach ($links as $link) {
            $totalClicks += $link['clicks'];
        }

        $this->view('profile/index', [
            'title' => 'My Profile',
            'user' => $user,
            'totalLinks' => $totalLinks,
            'totalClicks' => $totalClicks
        ]);
    }

    /**
     * Processes profile update requests (username and password).
     * 
     * @return void
     */
    public function update() {
        $userId = $_SESSION['user_id'];
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (!empty($password) && $password !== $confirmPassword) {
            $this->redirect('/URL_project/public/profile?error=Passwords+do not+match');
            return;
        }

        $success = $this->userModel->update($userId, $username, !empty($password) ? $password : null);

        if ($success) {
            $_SESSION['username'] = $username;
            $this->redirect('/URL_project/public/profile?success=Profile+updated+successfully');
        } else {
            $this->redirect('/URL_project/public/profile?error=Failed+to+update+profile');
        }
    }
}
