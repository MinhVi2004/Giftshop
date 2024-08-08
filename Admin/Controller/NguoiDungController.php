<?php
require (__DIR__ . "/../Model/NguoiDungModel.php");
class NguoiDungController {
      private $NguoiDungModel;

      public function __construct() {
            $this->NguoiDungModel = new NguoiDungModel();
      }
      public function showNguoiDungView() {
            $listNguoiDung = $this->NguoiDungModel->getAll();
            require(__DIR__."/../View/NguoiDung/NguoiDungView.php");
      }
      public function khoaNguoiDung($MaTaiKhoan) {
            $result = $this->NguoiDungModel->khoaNguoiDungById($MaTaiKhoan);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function moKhoaNguoiDung($MaTaiKhoan) {
            $result = $this->NguoiDungModel->moKhoaNguoiDungById($MaTaiKhoan);
            if($result) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$NguoiDungController = new NguoiDungController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "khoa_nguoiDung":
                  $NguoiDungController->khoaNguoiDung($_POST['MaTaiKhoan']);
                  break;
            case "moKhoa_nguoiDung":
                  $NguoiDungController->moKhoaNguoiDung($_POST['MaTaiKhoan']);
                  break;
            default:
                  break;
      }
} else {
      $NguoiDungController->showNguoiDungView();
}
