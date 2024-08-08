<?php
require (__DIR__ . "/../../Lib/Database.php");
class PhongChieuModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `phongchieu`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getPhongChieuById($MaPhongChieu) {
            $getPhongChieuByIdQuery = "SELECT * from `phongchieu` WHERE `phongchieu`.MaPhongChieu  = " . $MaPhongChieu;
            $result = $this->db->select($getPhongChieuByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function updatePhongChieu($MaPhongChieu, $TenPhongChieu, $SoLuongGhe) {
            $updatePhongChieuQuery = "UPDATE `phongchieu` SET `phongchieu`.`TenPhongChieu` = '$TenPhongChieu', `phongchieu`.`SoLuongGhe` = '$SoLuongGhe' WHERE `phongchieu`.`MaPhongChieu` = $MaPhongChieu";
            $result = $this->db->execute($updatePhongChieuQuery);
            if($result) {
                  return true;
            }
            return false;
      }
}