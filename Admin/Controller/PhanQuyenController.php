<?php
require (__DIR__ . "/../Model/PhanQuyenModel.php");
class PhanQuyenController {
      private $PhanQuyenModel;

      public function __construct() {
            $this->PhanQuyenModel = new PhanQuyenModel();
      }
      public function showPhanQuyenView() {
            $listNguoiDung = $this->PhanQuyenModel->getAllTaiKhoan();
            require(__DIR__."/../View/PhanQuyen/PhanQuyenView.php");
      }
      public function showSuaPhanQuyenView() {
            $listPhanQuyen = $this->PhanQuyenModel->getAll();
            $nguoiDung = $this->PhanQuyenModel->getTaiKhoanByID($_GET['id']);
            require(__DIR__."/../View/PhanQuyen/SuaPhanQuyenView.php");
      }
      public function showChiTietPhanQuyenView() {
            $listPhanQuyen = $this->PhanQuyenModel->getAll();
            require(__DIR__."/../View/PhanQuyen/ChiTietPhanQuyenView.php");
      }
      public function showSuaChiTietPhanQuyenView() {
            $listPhanQuyen = $this->PhanQuyenModel->getAll();
            $phanQuyen = $this->PhanQuyenModel->getPhanQuyenByVaiTro($_GET['VaiTro']);
            require(__DIR__."/../View/PhanQuyen/SuaChiTietPhanQuyenView.php");
      }
      public function suaPhanQuyenTaiKhoan() {
            $maTaiKhoan = $_POST['MaTaiKhoan'];
            $vaiTro = $_POST['VaiTro'];
            $result = $this->PhanQuyenModel->suaPhanQuyenTaiKhoan($maTaiKhoan, $vaiTro);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function suaChiTietPhanQuyen() {
            $vaitro = $_POST['vaitro'];
            $phim = $_POST['phim'];
            $nguoidung = $_POST['nguoidung'];
            $phanquyen = $_POST['phanquyen'];
            $lichchieu = $_POST['lichchieu'];
            $phongchieu = $_POST['phongchieu'];
            $doanhthu = $_POST['doanhthu'];
            $binhluan = $_POST['binhluan'];
            $ve = $_POST['ve'];
            $result = $this->PhanQuyenModel->suaChiTietPhanQuyen($vaitro, $phim, $nguoidung, $phanquyen, $lichchieu, $phongchieu, $doanhthu, $binhluan, $ve);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$PhanQuyenController = new PhanQuyenController();
if(isset($_POST['action'])) { //?Chức năng
      switch ($_POST['action']) {
            case "suaPhanQuyen":
                  $PhanQuyenController->suaPhanQuyenTaiKhoan();
                  break;
            case "suaChiTietPhanQuyen":
                  $PhanQuyenController->suaChiTietPhanQuyen();
                  break;
            
      }
} else if(isset($_GET['move'])) { //? VIEW
      switch ($_GET['move']) {
            case "SuaPhanQuyen":
                  $PhanQuyenController->showSuaPhanQuyenView();
                  break;
            case "ChiTietPhanQuyen":
                  $PhanQuyenController->showChiTietPhanQuyenView();
                  break;
            case "SuaChiTietPhanQuyen":
                  $PhanQuyenController->showSuaChiTietPhanQuyenView();
                  break;
      }
} else {
      $PhanQuyenController->showPhanQuyenView();
}
