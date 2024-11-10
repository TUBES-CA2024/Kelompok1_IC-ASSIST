<?php

namespace App\Controllers\Home;

use App\Core\Controller;
use App\Core\View;


class HomeController extends Controller {
    public function index() {
        if ($this->isLoggedIn()) {
            View::render('main', 'Templates');
        } else {
            View::render('index', 'login');
            exit();
        }
    }

    public function loadContent($page) {
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
            case 'profile':
                View::render('profile', 'Templates');
                break;
            case 'editprofile':
                View::render('editprofile', 'Templates');
                break;
            case 'notifcation' :
                View::render('notification', 'Templates');
                break;
                    
        }
    }

    private function isLoggedIn() {
        return isset($_SESSION['user']);
    }
}
