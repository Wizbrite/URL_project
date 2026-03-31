<?php

namespace app\controllers;

use core\Controller;
use app\models\Link;

/**
 * LinkController handles link creation, history viewing, and deletion.
 */
class LinkController extends Controller {
    /** @var Link Link model instance. */
    private $linkModel;

    /**
     * Constructor verifies user session, validates CSRF token, and initializes the link model.
     */
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/URL_project/public/login');
        }
        $this->validateCsrfToken();
        $this->linkModel = new Link();
    }

    /**
     * Redirects to the dashboard index (legacy/alias for dashboard view).
     * 
     * @return void
     */
    public function index() {
        $this->view('dashboard', ['title' => 'Dashboard', 'username' => $_SESSION['username']]);
    }

    /**
     * Processes the creation of a new short link.
     * 
     * Validates the long URL and custom alias, then generates or assigns the slug.
     * 
     * @return void
     */
    public function create() {
        $longUrl = $_POST['long_url'] ?? '';
        $customAlias = $_POST['custom_alias'] ?? '';
        $userId = $_SESSION['user_id'];

        if (empty($longUrl)) {
            $this->view('dashboard', ['error' => 'URL is required', 'title' => 'Dashboard']);
            return;
        }

        // Validate URL
        if (!filter_var($longUrl, FILTER_VALIDATE_URL)) {
             $this->view('dashboard', ['error' => 'Invalid URL format', 'title' => 'Dashboard']);
             return;
        }

        $slug = !empty($customAlias) ? $customAlias : $this->generateSlug();

        // Check if slug exists
        if ($this->linkModel->findBySlug($slug)) {
            if (!empty($customAlias)) {
                $this->view('dashboard', ['error' => 'Alias already taken', 'title' => 'Dashboard']);
            } else {
                // Highly unlikely for random slug, but handle it
                $slug = $this->generateSlug();
                $this->linkModel->create($userId, $longUrl, $slug);
                $this->redirect('/URL_project/public/history');
            }
            return;
        }

        if ($this->linkModel->create($userId, $longUrl, $slug)) {
            $this->redirect('/URL_project/public/history');
        } else {
            $this->view('dashboard', ['error' => 'Failed to create link', 'title' => 'Dashboard']);
        }
    }

    /**
     * Generates a random alphanumeric slug of a given length.
     * 
     * @param int $length The length of the slug.
     * @return string The generated slug.
     */
    protected function generateSlug($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $slug = '';
        for ($i = 0; $i < $length; $i++) {
            $slug .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $slug;
    }

    /**
     * Displays the history of links for the logged-in user with pagination.
     * 
     * @return void
     */
    public function history() {
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        
        $userId = $_SESSION['user_id'];
        $links = $this->linkModel->getByUserId($userId, $offset, $limit);
        $totalLinks = $this->linkModel->getCountByUserId($userId);
        $totalPages = ceil($totalLinks / $limit);

        $this->view('links/history', [
            'title' => 'History',
            'links' => $links,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * Deletes a link based on its ID.
     * 
     * @param array $params Route parameters containing the link ID ('id').
     * @return void
     */
    public function delete($params) {
        $id = $params['id'];
        $userId = $_SESSION['user_id'];
        
        if ($this->linkModel->delete($id, $userId)) {
            $this->redirect('/URL_project/public/history');
        } else {
            $this->redirect('/URL_project/public/history'); // Or show error
        }
    }
}
