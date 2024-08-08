<?php
require (__DIR__ . "/../Model/LichChieuModel.php");
class LichChieuController {
      private $LichChieuModel;

      public function __construct() {
            $this->LichChieuModel = new LichChieuModel();
      }
      public function showLichChieuView() {
            $listPhim = $this->LichChieuModel->getAllPhim();
            require(__DIR__."/../View/LichChieu/LichChieuView.php");
      }
      public function showUpdateLichChieuView() {
            $phim = $this->LichChieuModel->getPhimById($_GET['id']);
            $phongChieu = $this->LichChieuModel->getAllPhongChieu();
            require(__DIR__."/../View/LichChieu/UpdateLichChieuView.php");
      }
      public function getXuatChieu($NgayChieu, $PhongChieu) {
            $result = $this->LichChieuModel->getXuatChieuByNgayChieu_PhongChieu($NgayChieu, $PhongChieu);
            if($result) {
                  echo "success".json_encode($result);
            } else {
                  echo "error".json_encode($result);
            }
      }
      public function updateLichChieu($PhongChieu, $MaPhim, $XuatChieu, $NgayChieu) {
            $result = $this->LichChieuModel->updateLichChieu($PhongChieu, $MaPhim, $XuatChieu, $NgayChieu);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$LichChieuController = new LichChieuController();
if(isset($_POST['action'])) { //? ACTION
      switch ($_POST['action']) {
            case "getXuatChieu":
                  $NgayChieu = $_POST['NgayChieu'];
                  $PhongChieu = $_POST['PhongChieu'];
                  $LichChieuController->getXuatChieu($NgayChieu, $PhongChieu);
                  break;
            case "updateLichChieu":
                  $PhongChieu = $_POST['PhongChieu'];
                  $MaPhim = $_POST['MaPhim'];
                  $XuatChieu = $_POST['XuatChieu'];
                  $NgayChieu = $_POST['NgayChieu'];
                  $LichChieuController->updateLichChieu($PhongChieu, $MaPhim, $XuatChieu, $NgayChieu);
                  break;
      }
} else if(isset($_GET['move'])) { //? VIEW
      switch ($_GET['move']) {
            case "UpdateLichChieuView":
                  $LichChieuController->showUpdateLichChieuView();
                  break;
      }
}else { //? MẶC ĐỊNH LÀ GIAO DIỆN CHÍNH QL LỊCH CHIẾU
      $LichChieuController->showLichChieuView();
}
