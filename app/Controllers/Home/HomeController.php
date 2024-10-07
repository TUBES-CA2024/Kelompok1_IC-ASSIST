<?php

namespace App\Controllers\Home;

use App\Core\Controller;
use App\Core\View;
use App\Model\User\UserModel;


class HomeController extends Controller {
    public function index() {
        // Check if the user is logged in
            View::render('main', 'Templates');
        
    }

    public function loadContent($page) {
        // Handle AJAX requests to load different content
        if (is_array($page)) {
            $page = $page['page'];  
        }
        switch ($page) {
            case 'dashboard':
                View::render('dashboard', 'Templates');  
                break;
            case 'biodata':
                View::render('biodata', 'Templates');
                break;
            case 'pengumuman':
                View::render('pengumuman', 'Templates');
                break;
            case 'presentasi' :
                View::render('presentasi', 'Templates');
                break;
            case 'tesTulis' :
                View::render('tesTulis', 'Templates');
                break;
            case 'uploadBerkas' :
                View::render('uploadBerkas', 'Templates');
                break;
            case 'wawancara' :
                View::render('wawancara', 'Templates');
                break;
        }
    }

    private function isLoggedIn() {
        return isset($_SESSION['user']);
    }
}
