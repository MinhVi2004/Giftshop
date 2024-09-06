<?php
// require (__DIR__ . "/../../Lib/Database.php");
class binhLuanModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `binhluan`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getAllByIdPhim($MaPhim) {
            $getPhimByIdQuery = "SELECT * from `binhluan`, `phim`, `taikhoan` WHERE `binhluan`.MaPhim = `phim`.MaPhim and `binhluan`.MaTaiKhoan = `taikhoan`.MaTaiKhoan and `binhluan`.MaPhim  = " . $MaPhim;
            $result = $this->db->select($getPhimByIdQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getBinhLuanById($MaBinhLuan) {
            $getPhimByIdQuery = "SELECT * from `binhluan` WHERE `binhluan`.MaBinhLuan  = " . $MaBinhLuan;
            $result = $this->db->select($getPhimByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getLastId() {
            return $this->db->getLastInsertId();
      }
}