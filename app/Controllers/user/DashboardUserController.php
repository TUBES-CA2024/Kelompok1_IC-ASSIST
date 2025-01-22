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
}