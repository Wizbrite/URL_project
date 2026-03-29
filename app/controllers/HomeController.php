<?php

namespace App\Controllers;

use Core\Controller;

/**
 * HomeController manages the public landing page of the application.
 */
class HomeController extends Controller {
    /**
     * Displays the home page.
     * 
     * @return void
     */
    public function index() {
        $this->view('home/index', ['title' => 'Home']);
    }
}
