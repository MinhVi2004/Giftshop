<?php
require (__DIR__ . "/../Model/PhimModel.php");
class PhimController {
      private $PhimModel;

      public function __construct() {
            $this->PhimModel = new PhimModel();
      }
      public function showPhimDetailView($MaPhim) {
            $loaiPhim = $this->PhimModel->getLoaiPhimByMaPhim($MaPhim);
            $phim = $this->PhimModel->getPhimById($MaPhim);
            require(__DIR__ . "/../View/Phim/PhimDetailView.php");
      }
      public function showPhimUpdateView($MaPhim) {
            $phim = $this->PhimModel->getPhimById($MaPhim);
            require(__DIR__ . "/../View/Phim/PhimUpdateView.php");
      }
      public function showPhimAddView() {
            $loaiphim = $this->PhimModel->getAllLoaiPhim();
            require(__DIR__ . "/../View/Phim/PhimAddView.php");
      }
      public function showTypePhimAddView() {
            require(__DIR__ . "/../View/Phim/TypePhimAddView.php");
      }
      public function showTypePhimView() {
            $listTypePhim = $this->PhimModel->getAllLoaiPhim();
            require(__DIR__ . "/../View/Phim/TypePhimView.php");
      }
      public function showTypePhimUpdateView($MaLoaiPhim) {
            $typePhim = $this->PhimModel->getLoaiPhimById($MaLoaiPhim);
            require(__DIR__ . "/../View/Phim/TypePhimUpdateView.php");
      }
      public function showPhimView() {
            $listPhim = $this->PhimModel->getAll();
            require(__DIR__."/../View/Phim/PhimView.php");
      }
      public function updatePhim() {
            $MaPhim = $_POST['MaPhim'];
            $TenPhim = $_POST['TenPhim'];
            $AnhPhimNho = $_POST['AnhPhimNho'];
            $AnhPhimLon = $_POST['AnhPhimLon'];
            $Trailer = $_POST['Trailer'];
            $ThongTin = $_POST['ThongTin'];
            $TuoiYeuCau = $_POST['TuoiYeuCau'];
            $ThoiLuongPhim = $_POST['ThoiLuongPhim'];
            $NgayKhoiChieu = $_POST['NgayKhoiChieu'];
            $XuatXu = $_POST['XuatXu'];
            $NhaSanXuat = $_POST['NhaSanXuat'];
            $TrangThai = $_POST['TrangThai'];

            $result = $this->PhimModel->updatePhim($MaPhim, $TenPhim, $AnhPhimNho, $AnhPhimLon, $Trailer, $ThongTin, $TuoiYeuCau, $ThoiLuongPhim, $NgayKhoiChieu, $XuatXu, $NhaSanXuat, $TrangThai);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function updateLoaiPhim() {
            $MaLoaiPhim = $_POST['MaLoaiPhim'];
            $TenLoaiPhim = $_POST['TenLoaiPhim'];
            $MoTa = $_POST['MoTa'];

            $result = $this->PhimModel->updateLoaiPhim($MaLoaiPhim, $TenLoaiPhim, $MoTa);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function addPhim() {
            $TenPhim = $_POST['TenPhim'];
            $AnhPhimNho = $_POST['AnhPhimNho'];
            $AnhPhimLon = $_POST['AnhPhimLon'];
            $Trailer = $_POST['Trailer'];
            $ThongTin = $_POST['ThongTin'];
            $TuoiYeuCau = $_POST['TuoiYeuCau'];
            $ThoiLuongPhim = $_POST['ThoiLuongPhim'];
            $NgayKhoiChieu = $_POST['NgayKhoiChieu'];
            $XuatXu = $_POST['XuatXu'];
            $NhaSanXuat = $_POST['NhaSanXuat'];
            $TheLoai = $_POST['TheLoai'];
            $TrangThai = $_POST['TrangThai'];
            
            $result = $this->PhimModel->addPhim($TenPhim, $AnhPhimNho, $AnhPhimLon, $Trailer, $ThongTin, $TuoiYeuCau, $ThoiLuongPhim, $NgayKhoiChieu, $XuatXu, $NhaSanXuat, $TrangThai);
            if($result) {
                  $result = $this->PhimModel->addPhim_LoaiPhim($TheLoai);
                  if($result) {
                        echo "success";
                  } else {
                        echo "error";
                  }
            } else {
                  echo "error";
            }
      }
      public function addLoaiPhim() {
            $TenLoaiPhim = $_POST['TenLoaiPhim'];
            $MoTa = $_POST['MoTa'];
            
            $result = $this->PhimModel->addLoaiPhim($TenLoaiPhim, $MoTa);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$PhimController = new PhimController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "update_phim":
                  $PhimController->updatePhim();
                  break;
            case "update_typePhim":
                  $PhimController->updateLoaiPhim();
                  break;
            case "add_phim":
                  $PhimController->addPhim();
                  break;
            case "add_typePhim":
                  $PhimController->addLoaiPhim();
                  break;
            default:
                  break;
      }
} else if(isset($_GET['move'])){
      switch ($_GET['move']) {
            case "PhimDetailView":
                  $PhimController->showPhimDetailView($_GET['id']);
                  break; 
            case "PhimUpdateView":
                  $PhimController->showPhimUpdateView($_GET['id']);
                  break; 
            case "PhimAddView":
                  $PhimController->showPhimAddView();
                  break; 
            case "TypePhimAddView":
                  $PhimController->showTypePhimAddView();
                  break; 
            case "TypePhimView":
                  $PhimController->showTypePhimView();
                  break; 
            case "TypePhimUpdateView":
                  $PhimController->showTypePhimUpdateView($_GET['id']);
                  break; 
            default:
                  $PhimController->showPhimView();
                  break;
      }
} else {
      $PhimController->showPhimView();
}
