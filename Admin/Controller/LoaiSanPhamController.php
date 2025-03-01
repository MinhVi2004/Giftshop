<?php
require (__DIR__ . "/../Model/LoaiSanPhamModel.php");
class LoaiSanPhamController {
      private $LoaiSanPhamModel;

      public function __construct() {
            $this->LoaiSanPhamModel = new LoaiSanPhamModel();
      }
      public function showLoaiSanPhamView() {
            $listLoaiSanPham = $this->LoaiSanPhamModel->getAll();
            require(__DIR__."/../View/LoaiSanPhamView.php");
      }
      public function themLoaiSP() {
            $TenLoaiSP = $_POST['TenLoaiSP'];
            if($this->LoaiSanPhamModel->checkTenLoaiSP($TenLoaiSP)) {
                  echo "error_existedTen";
                  exit();
            }
            $MoTaLoaiSP = $_POST['MoTaLoaiSP'];
            if($this->LoaiSanPhamModel->themLoaiSanPham($TenLoaiSP, $MoTaLoaiSP)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function suaLoaiSP() {
            $MaLoaiSP = $_POST['MaLoaiSP'];
            $TenLoaiSP = $_POST['TenLoaiSP'];
            if($this->LoaiSanPhamModel->checkSuaTenLoaiSP($MaLoaiSP,$TenLoaiSP)) {
                  echo "error_existedTen";
                  exit();
            }
            $MoTaLoaiSP = $_POST['MoTaLoaiSP'];
            if($this->LoaiSanPhamModel->suaLoaiSanPham($MaLoaiSP, $TenLoaiSP, $MoTaLoaiSP)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function xoaLoaiSP() {
            $MaLoaiSP = $_POST['MaLoaiSP'];
            if($this->LoaiSanPhamModel->xoaLoaiSanPham($MaLoaiSP)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$LoaiSanPhamController = new LoaiSanPhamController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "add_loaiSP":
                  $LoaiSanPhamController->themLoaiSP();
                  break; 
            case "update_loaiSP":
                  $LoaiSanPhamController->suaLoaiSP();
                  break; 
            case "delete_loaiSP":
                  $LoaiSanPhamController->xoaLoaiSP();
                  break; 
      }
} else if(isset($_GET['move'])){
      switch ($_GET['move']) {

      }
} else {
      $LoaiSanPhamController->showLoaiSanPhamView();
}
