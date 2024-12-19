<?php

namespace App\Controllers\user;

use App\Core\Controller;
use App\Core\View;
use App\Model\User\Mahasiswa;
class MahasiswaController extends Controller {
    public static function viewAllMahasiswa() {
        $mahasiswa = new Mahasiswa();
        $mahasiswa = $mahasiswa->getAll();
        return $mahasiswa == null ? [] : $mahasiswa;
    }
}