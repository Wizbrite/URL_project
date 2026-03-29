<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Link;
use App\Models\Click;

/**
 * DashboardController manages the user's dashboard view and high-level statistics.
 */
class DashboardController extends Controller {
    /** @var Link Link model instance. */
    private $linkModel;

    /**
     * Constructor verifies user session and initializes the link model.
     */
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/URL_project/public/login');
        }
        $this->linkModel = new Link();
    }

    /**
     * Displays the dashboard with user-specific statistics.
     * 
     * @return void
     */
    public function index() {
        $userId = $_SESSION['user_id'];
        $totalLinks = $this->linkModel->getCountByUserId($userId);
        
        // Sum all clicks for user's links
        $links = $this->linkModel->getByUserId($userId, 0, 1000);
        $totalClicks = 0;
        foreach ($links as $link) {
            $totalClicks += $link['clicks'];
        }

        $this->view('dashboard', [
            'title' => 'Dashboard',
            'totalLinks' => $totalLinks,
            'totalClicks' => $totalClicks
        ]);
    }
}
