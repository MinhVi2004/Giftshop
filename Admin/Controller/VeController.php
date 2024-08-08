<?php
require (__DIR__ . "/../Model/VeModel.php");
/* file tạo mã QR */
require "C:\\xampp\\htdocs\\Galaxy\\Lib\\phpqrcode-2010100721_1.1.4\\phpqrcode\\qrlib.php";
class VeController {
      private $VeModel;

      public function __construct() {
            $this->VeModel = new VeModel();
      }
      public function showVeView() {
            $listVe = $this->VeModel->getAll();
            require(__DIR__."/../View/Ve/VeView.php");
      }
      public function searchVe($input) {
            $result = $this->VeModel->getDetailByOrderId($input);
            if($result) {
                  echo "success".json_encode($result);
                  return;
            } else {
                  $result = $this->VeModel->getDetailByMaVe($input);
                  if($result) {
                        echo "success".json_encode($result);
                        return;
                  }
            }
            echo "error";
      }
      public function updateTrangThaiVe($orderId, $TrangThai) {
            $result = $this->VeModel->setTrangThaiVeByOrderId($orderId, $TrangThai);
            if($result) 
                  echo "success";
            else 
                  echo "error";
      }
      public function saveTicket() {
            $data = $_POST['Image'];
            // Xóa phần đầu của dữ liệu URL để lấy phần hình ảnh nhị phân
            $data = str_replace('data:image/png;base64,', '', $data);
            $data = base64_decode($data);

            // Đặt tên và đường dẫn cho tệp ảnh
            $filePath = 'C:\\xampp\\htdocs\\Galaxy\\IMG\\VeXemPhim\\' . time() . '.png';

            // Lưu ảnh vào thư mục
            if (file_put_contents($filePath, $data)) {
                  echo 'success';
            } else {
                  echo 'error';
            }
      }
}
$VeController = new VeController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "searchVe":
                  $input = $_POST['input'];
                  $VeController->searchVe($input);
                  break;
            case "changeTrangThaiVe":
                  $orderId = $_POST['orderId'];
                  $TrangThai = $_POST['TrangThai'];
                  $VeController->updateTrangThaiVe($orderId, $TrangThai);
                  break;
            case "SaveTicket":
                  $VeController->saveTicket();
                  break;
            default:
                  break;
      }
} else if(isset($_GET['move'])){
      switch ($_GET['move']) {
            case "VeView":
                  $VeController->showVeView();
                  break; 
            default:
                  $VeController->showVeView();
                  break;
      }
} else {
      $VeController->showVeView();
}
