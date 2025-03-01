<?php
require_once (__DIR__ . "/../Lib/Database.php");
class HeaderModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAllLoaiSP() {
            //SELECT * FROM `thongbao`
            $getAllLoaiSPQuery = "SELECT * FROM `loaisanpham`";
            $result = $this->db->select($getAllLoaiSPQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getQuantityGioHangByMyTK($MaTK) {
            //SELECT * FROM `thongbao`
            $getAllGioHangByMyTKQuery = "SELECT * FROM `giohang` WHERE MaTK = '$MaTK'";
            $result = $this->db->select($getAllGioHangByMyTKQuery);
            if(count($result) > 0){
                  return count($result);
            }
            return 0;
      }
      public function getNotification($MaTK) {
            //SELECT * FROM `thongbao`
            $getNotificationQuery = "SELECT * FROM `thongbao` WHERE MaTK = '$MaTK' OR MaTK = ''   ORDER BY MaTB DESC; ";
            $result = $this->db->select($getNotificationQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function daDocNotification($MaTB) {
            $daDocNotificationQuery = "UPDATE `thongbao` SET `DaDoc` = 'Đã Đọc' WHERE `thongbao`.`MaTB` = '$MaTB';";
            return $this->db->execute($daDocNotificationQuery);
      }

}