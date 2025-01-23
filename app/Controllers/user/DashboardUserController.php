<?php

namespace App\Controllers\user;

use App\Core\Controller;
use App\Model\User\DashboardUser;
class DashboardUserController extends Controller {
    public static function getBiodataStatus() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getBiodataStatus();
    }
    public static function getBerkasStatus() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getBerkasStatus();
    }
    public static function getAbsensiTesTertulis() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getAbsensiTesTertulis();
    }
    public static function getAbsensiWawancaraI() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getAbsensiWawancaraI();
    }
    public static function getAbsensiWawancaraII() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getAbsensiWawancaraII();
    }
    public static function getAbsensiWawancaraIII() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getAbsensiWawancaraIII();
    }
    public static function getAbsensiPresentasi() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getAbsensiPresentasi();
    }
    public static function getPptStatus() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getStatusPpt();
    }
    public static function getPptJudulAccStatus() {
        $dashboardUser = new DashboardUser();
        return $dashboardUser->getPptAccStatus();
    }
    public static function getNumberTahapanSelesai() {
        $i = 0;
        if(self::getBiodataStatus()) {
            $i++;
        }
        if(self::getBerkasStatus()) {
            $i++;
        }
        if(self::getAbsensiTesTertulis()) {
            $i++;
        }
        if(self::getAbsensiWawancaraI()) {
            $i++;
        }
        if(self::getAbsensiWawancaraII()) {
            $i++;
        }
        if(self::getAbsensiWawancaraIII()) {
            $i++;
        }
        if(self::getAbsensiPresentasi()) {
            $i++;
        }
        if(self::getPptStatus()) {
            $i++;
        }
        if(self::getPptJudulAccStatus()) {
            $i++;
        }
        return $i;
    }
    public static function getPercentage() {
        if (self::getNumberTahapanSelesai() == 0) {
            return 0;
        }
        $i = floor((self::getNumberTahapanSelesai() / 9) * 100);
        return "$i%" ;
    }    
    public static function generateCircle($percentage) {
        $radius = 38; 
        $circumference = 2 * pi() * $radius; 
        $offset = $circumference * (1 - $percentage / 100); 
        return "
        <svg width=\"100\" height=\"100\">
            <circle cx=\"50\" cy=\"50\" r=\"$radius\" stroke=\"#e6e6e6\" stroke-width=\"4\" fill=\"none\"></circle>
            <circle 
                cx=\"50\" 
                cy=\"50\" 
                r=\"$radius\" 
                stroke=\"#00aaff\" 
                stroke-width=\"4\" 
                fill=\"none\" 
                stroke-dasharray=\"$circumference\" 
                stroke-dashoffset=\"$offset\"
                transform=\"rotate(-90 50 50)\"
            ></circle>
        </svg>";
    }
    
}