<?php

namespace App\Controllers\presentasi;
use App\Core\Controller;
use App\Model\presentasi\Ruangan;
class RuanganController extends Controller {

    public static function viewAllRuangan() {
        $ruangan = new Ruangan();
        $ruangan = $ruangan->getAll();
        return $ruangan == null ? [] : $ruangan;
    }
}