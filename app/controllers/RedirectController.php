<?php

namespace app\controllers;

use core\Controller;
use app\models\Link;
use app\models\Click;

/**
 * RedirectController handles the core functionality of redirecting short slugs to long URLs.
 * 
 * It tracks clicks and records analytics data before redirection.
 */
class RedirectController extends Controller {
    /** @var Link Link model instance. */
    private $linkModel;
    /** @var Click Click model instance. */
    private $clickModel;

    /**
     * Constructor initializes the Link and Click models.
     */
    public function __construct() {
        $this->linkModel = new Link();
        $this->clickModel = new Click();
    }

    /**
     * Handles the redirection of a short slug.
     * 
     * Increments the click count, records visitor details, and redirects to the long URL.
     * Redirects to the home page with an error if the slug is not found.
     * 
     * @param array $params Route parameters containing the 'slug'.
     * @return void
     */
    public function handle($params) {
        $slug = $params['slug'];
        $link = $this->linkModel->findBySlug($slug);

        if ($link) {
            // Track click
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            
            $this->linkModel->incrementClicks($link['id']);
            $this->clickModel->create($link['id'], $ipAddress, $userAgent);

            // Redirect
            header("Location: " . $link['long_url']);
            exit();
        } else {
            // Handle 404
            $this->redirect('/URL_project/public/?error=Link+not+found');
        }
    }
}
