<?php
require (__DIR__ . "/../Model/ThongBaoModel.php");
class ThongBaoController {
      private $ThongBaoModel;

      public function __construct() {
            $this->ThongBaoModel = new ThongBaoModel();
      }
      public function showThongBaoView() {
            $listThongBao = $this->ThongBaoModel->getAll();
            require(__DIR__."/../View/ThongBaoView.php");
      }
      public function getThongBaoByMaTB() {
            $MaTB = $_POST['MaTB'];
            if($result = $this->ThongBaoModel->getThongBaoByMaTB($MaTB)) {
                  echo json_encode(['status' => 'success', 'data' => $result]);
            } else {
                  echo json_encode(['status' => 'success', 'data' => []]);
            }
      }
      public function themThongBao() {
            $TieuDe =  $_POST['TieuDe'];
            $NoiDung =  $_POST['NoiDung'];
            if($this->ThongBaoModel->themThongBao($TieuDe, $NoiDung)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function xoaThongBao() {
            $MaTB =  $_POST['MaTB'];
            if($this->ThongBaoModel->xoaThongBao($MaTB)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$ThongBaoController = new ThongBaoController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "add_TB":
                  $ThongBaoController->themThongBao();
                  break;
            case "delete_TB":
                  $ThongBaoController->xoaThongBao();
                  break;
            case "getThongBaoByMaTB":
                  $ThongBaoController->getThongBaoByMaTB();
                  break;
            default:
                  break;
      }
} else {
      $ThongBaoController->showThongBaoView();
}
