<?php
require (__DIR__ . "/../../Lib/Database.php");
class NguoiDungModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `taikhoan`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getNguoiDungById($MaTaiKhoan) {
            $getTaiKhoanByIdQuery = "SELECT * from `taikhoan` WHERE `taikhoan`.MaTaiKhoan  = " . $MaTaiKhoan;
            $result = $this->db->select($getTaiKhoanByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function khoaNguoiDungById($MaTaiKhoan) {
            $khoaTaiKhoanByIdQuery = "UPDATE `taikhoan` SET `taikhoan`.TrangThai = 'Đang Khóa' WHERE `taikhoan`.MaTaiKhoan  = " . $MaTaiKhoan;
            $result = $this->db->execute($khoaTaiKhoanByIdQuery);
            if($result){
                  return true;      
            }
            return false;
      }
      public function moKhoaNguoiDungById($MaTaiKhoan) {
            $moKhoaTaiKhoanByIdQuery = "UPDATE `taikhoan` SET `taikhoan`.TrangThai = 'Đang Hoạt Động' WHERE `taikhoan`.MaTaiKhoan  = " . $MaTaiKhoan;
            $result = $this->db->execute($moKhoaTaiKhoanByIdQuery);
            if($result){
                  return true;      
            }
            return false;
      }
}