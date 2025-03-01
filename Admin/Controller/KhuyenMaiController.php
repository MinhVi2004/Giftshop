<?php
require (__DIR__ . "/../Model/KhuyenMaiModel.php");
class KhuyenMaiController {
      private $KhuyenMaiModel;

      public function __construct() {
            $this->KhuyenMaiModel = new KhuyenMaiModel();
      }
      public function showKhuyenMaiView() {
            $listKhuyenMai = $this->KhuyenMaiModel->getAll();
            require(__DIR__."/../View/KhuyenMaiView.php");
      }
      public function getKhuyenMaiByMaKM() {
            // $MaKM = $_POST['MaKM'];
            // if($result = $this->KhuyenMaiModel->getKhuyenMaiByMaKM($MaKM)) {
            //       echo json_encode(['status' => 'success', 'data' => $result]);
            // } else {
            //       echo json_encode(['status' => 'success', 'data' => []]);
            // }
      }
      public function themKhuyenMai() {
            $TenKM =  $_POST['TenKM'];
            $PhanTram= $_POST['PhanTram'];
            $NgayBatDau= $_POST['NgayBatDau'];
            $NgayKetThuc= $_POST['NgayKetThuc'];
            $MoTaKM =  $_POST['MoTaKM'];
            if($this->KhuyenMaiModel->checkTenKM($TenKM)) {
                  echo "error_existedTen";
                  exit();
            }
            if($this->KhuyenMaiModel->themKhuyenMai($TenKM, $MoTaKM, $PhanTram, $NgayBatDau, $NgayKetThuc)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function suaKhuyenMai() {
            $MaKM =  $_POST['MaKM'];
            $TenKM =  $_POST['TenKM'];
            $PhanTram= $_POST['PhanTram'];
            $NgayBatDau= $_POST['NgayBatDau'];
            $NgayKetThuc= $_POST['NgayKetThuc'];
            $MoTaKM =  $_POST['MoTaKM'];
            if($this->KhuyenMaiModel->checkSuaTenKM($MaKM, $TenKM)) {
                  echo "error_existedTen";
                  exit();
            }
            if($this->KhuyenMaiModel->suaKhuyenMai($MaKM,$TenKM, $MoTaKM, $PhanTram, $NgayBatDau, $NgayKetThuc)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function xoaKhuyenMai() {
            $MaKM =  $_POST['MaKM'];
            if($this->KhuyenMaiModel->xoaKhuyenMai($MaKM)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$KhuyenMaiController = new KhuyenMaiController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "add_KM":
                  $KhuyenMaiController->themKhuyenMai();
                  break;
            case "update_KM":
                  $KhuyenMaiController->suaKhuyenMai();
                  break;
            case "delete_KM":
                  $KhuyenMaiController->xoaKhuyenMai();
                  break;
            case "getKhuyenMaiByMaKM":
                  $KhuyenMaiController->getKhuyenMaiByMaKM();
                  break;
            default:
                  break;
      }
} else {
      $KhuyenMaiController->showKhuyenMaiView();
}
