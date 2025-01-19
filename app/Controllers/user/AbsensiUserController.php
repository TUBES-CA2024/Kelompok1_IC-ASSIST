<?php
namespace App\Controllers\user;
use App\Model\User\Absensi;
use App\Core\Controller;
class AbsensiUserController extends Controller {
    public static function viewAbsensi() {
        $absensi = new Absensi();
        $data = $absensi->getAbsensi();
        return $data;
    }
}