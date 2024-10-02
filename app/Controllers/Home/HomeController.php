<?php

namespace App\Controllers\Home;

use App\Core\Controller;
use App\Core\View;
use App\Model\User\UserModel;


class HomeController extends Controller {
    public function index() {

        View::render('main', 'Templates');
    }

    public function loadContent($page) {
        switch ($page) {
            case 'dashboard':
                View::render('dashboard', 'Templates'); // Render halaman dashboard
                break;
            case 'biodata':
                View::render('biodata', 'Templates'); // Render halaman biodata
                break;
            case 'uploadBerkas':
                View::render('uploadBerkas', 'Templates'); // Render halaman upload berkas
                break;
            case 'tesTulis':
                View::render('tesTulis', 'Templates'); // Render halaman tes tulis
                break;
            case 'presentasi':
                View::render('presentasi', 'Templates'); // Render halaman presentasi
                break;
            case 'wawancara':
                View::render('wawancara', 'Templates'); // Render halaman wawancara
                break;
            case 'pengumuman':
                View::render('pengumuman', 'Templates'); // Render halaman pengumuman
                break;
            default:
                echo "Halaman tidak ditemukan"; // Halaman tidak ditemukan
                break;
        }
    }
}
