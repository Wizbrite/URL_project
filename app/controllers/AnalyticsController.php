<?php

namespace app\controllers;

use core\Controller;
use app\models\Link;
use app\models\Click;

/**
 * AnalyticsController provides detailed click statistics for specific links.
 */
class AnalyticsController extends Controller {
    /** @var Link Link model instance. */
    private $linkModel;
    /** @var Click Click model instance. */
    private $clickModel;

    /**
     * Constructor verifies user session and initializes the Link and Click models.
     */
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/URL_project/public/login');
        }
        $this->linkModel = new Link();
        $this->clickModel = new Click();
    }

    /**
     * Displays the analytics page for a specific link.
     * 
     * Verifies that the link belongs to the logged-in user before showing data.
     * 
     * @param array $params Route parameters containing the link 'id'.
     * @return void
     */
    public function show($params) {
        $linkId = $params['id'];
        $userId = $_SESSION['user_id'];
        
        // Verify link belongs to user
        $link = $this->linkModel->findBySlug($this->getSlugById($linkId)); // Simplification
        if (!$link || $link['user_id'] != $userId) {
            $this->redirect('/URL_project/public/history');
        }

        $clicks = $this->clickModel->getByLinkId($linkId);
        $stats = $this->clickModel->getStatsByLinkId($linkId);

        $this->view('links/analytics', [
            'title' => 'Analytics',
            'link' => $link,
            'clicks' => $clicks,
            'stats' => $stats
        ]);
    }

    /**
     * Helper method to retrieve a slug by its link ID.
     * 
     * @param int $id The link ID.
     * @return string The short slug, or an empty string if not found.
     */
    private function getSlugById($id) {
        // Simple helper since findBySlug is what we have
        $stmt = \Config\Database::getConnection()->prepare("SELECT short_slug FROM links WHERE id = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch();
        return $res['short_slug'] ?? '';
    }
}
