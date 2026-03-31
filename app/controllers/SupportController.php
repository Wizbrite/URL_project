<?php

namespace app\controllers;

use core\Controller;

/**
 * SupportController handles informational and legal pages.
 */
class SupportController extends Controller {
    /**
     * Displays the Privacy Policy page.
     */
    public function privacy() {
        $this->view('support/privacy', ['title' => 'Privacy Policy']);
    }

    /**
     * Displays the Terms of Service page.
     */
    public function terms() {
        $this->view('support/terms', ['title' => 'Terms of Service']);
    }

    /**
     * Displays the Developer API documentation page.
     */
    public function api() {
        $this->view('support/api', ['title' => 'Developer API']);
    }

    /**
     * Displays the Contact Us page.
     */
    public function contact() {
        $this->view('support/contact', ['title' => 'Contact Us']);
    }
}
