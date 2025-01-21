<?php
namespace App\Controllers\user;
use App\Core\Controller;
use App\Model\Wawancara\Wawancara;
class WawancaraController extends Controller
{
    public static function getAll() {
        $wawancara = new Wawancara(0,0,0,0,0);
        $data = $wawancara->getAll();
        return $data;
    }

    public function save() {

    }
}