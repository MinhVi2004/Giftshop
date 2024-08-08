<?php
require (__DIR__ . "/../Model/PhongChieuModel.php");
class PhongChieuController {
      private $PhongChieuModel;

      public function __construct() {
            $this->PhongChieuModel = new PhongChieuModel();
      }
      public function showPhongChieuView() {
            $listPhongChieu = $this->PhongChieuModel->getAll();
            require(__DIR__."/../View/PhongChieu/PhongChieuView.php");
      }
      public function showSuaPhongChieuView() {
            $phongChieu = $this->PhongChieuModel->getPhongChieuById($_GET['id']);
            require(__DIR__."/../View/PhongChieu/SuaPhongChieuView.php");
      }
      public function suaPhongChieu() {
            $MaPhongChieu = $_POST['MaPhongChieu'];
            $TenPhongChieu = $_POST['TenPhongChieu'];
            $SoLuongGhe = $_POST['SoLuongGhe'];
            $result = $this->PhongChieuModel->updatePhongChieu($MaPhongChieu, $TenPhongChieu, $SoLuongGhe);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$PhongChieuController = new PhongChieuController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "suaPhongChieu":
                  $PhongChieuController->suaPhongChieu();
                  break;

      }
} else if(isset($_GET['move'])) { //? VIEW
      switch ($_GET['move']) {
            case "SuaPhongChieu":
                  $PhongChieuController->showSuaPhongChieuView();
                  break;
      }
}else {
      $PhongChieuController->showPhongChieuView();
}
