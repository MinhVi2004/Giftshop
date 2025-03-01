<?php
require (__DIR__ . "/../Model/TaiKhoanModel.php");
class TaiKhoanController {
      private $TaiKhoanModel;

      public function __construct() {
            $this->TaiKhoanModel = new TaiKhoanModel();
      }
      public function showNguoiDungView() {
            $listTaiKhoan = $this->TaiKhoanModel->getAll();
            require(__DIR__."/../View/TaiKhoanView.php");
      }
      public function getTaiKhoanByMaTK() {
            $MaTK = $_POST['MaTK'];
            if($result = $this->TaiKhoanModel->getTaiKhoanById($MaTK)) {
                  echo json_encode(['status' => 'success', 'data' => $result]);
            } else {
                  echo json_encode(['status' => 'success', 'data' => []]);
            }
      }
      public function suaTaiKhoan() {
            $MaTK = $_POST['MaTK'];
            $TrangThai = $_POST['TrangThai'];
            if($this->TaiKhoanModel->updateTrangThaiTaiKhoan($MaTK, $TrangThai)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function khoiPhucMatKhau() {
            $MaTK = $_POST['MaTK'];
            if($this->TaiKhoanModel->changePasswordAccount($MaTK, "123456")){
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$TaiKhoanController = new TaiKhoanController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "khoiPhucMatKhau":
                  $TaiKhoanController->khoiPhucMatKhau();
                  break;
            case "getTaiKhoanByMaTK":
                  $TaiKhoanController->getTaiKhoanByMaTK();
                  break;
            case "suaTaiKhoan":
                  $TaiKhoanController->suaTaiKhoan();
                  break;
            default:
                  break;
      }
} else {
      $TaiKhoanController->showNguoiDungView();
}
