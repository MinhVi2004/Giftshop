<?php
require (__DIR__ . "/../../Lib/Database.php");
class LichChieuModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAllPhim() {
            $getAllQuery = "SELECT * from `phim`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `lichchieu`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getLichChieuById($MaLichChieu) {
            $getLichChieuByIdQuery = "SELECT * from `lichchieu` WHERE `lichchieu`.`MaLichChieu`  = " . $MaLichChieu;
            $result = $this->db->select($getLichChieuByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getPhimById($MaPhim) {
            $getPhimByIdQuery = "SELECT * from `phim` WHERE `phim`.`MaPhim`  = " . $MaPhim;
            $result = $this->db->select($getPhimByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getAllPhongChieu() {
            $getAllPhongChieuQuery = "SELECT * from `phongchieu`";
            $result = $this->db->select($getAllPhongChieuQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getAllXuatChieu() {
            $getAllXuatChieuQuery = "SELECT * from `xuatchieu`";
            $result = $this->db->select($getAllXuatChieuQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getXuatChieuByNgayChieu_PhongChieu($NgayChieu, $PhongChieu) {
            //SELECT * from lichchieu where lichchieu.NgayChieu = "06/27/2024" and lichchieu.MaPhongChieu = 4
            $xuatChieu = $this->getAllXuatChieu();
            $getXuatChieuByNgayChieu_PhongChieuQuery = "SELECT * from `lichchieu` where `lichchieu`.`NgayChieu` = '$NgayChieu' and `lichchieu`.`MaPhongChieu` = $PhongChieu";
            $result = $this->db->select($getXuatChieuByNgayChieu_PhongChieuQuery);
            if(count($result) == 0) {
                  return $xuatChieu;
            }
            foreach($result as $temp) {
                  foreach ($xuatChieu as $key => $temp2) { // Use $key to reference the array key
                        if ($temp2['MaXuatChieu'] == $temp['MaXuatChieu']) {
                            unset($xuatChieu[$key]); // Remove the element from xuatChieu
                        }
                  }
            }
            $xuatChieu = array_values($xuatChieu);
            return $xuatChieu;
      }
      public function updateLichChieu($MaPhongChieu, $MaPhim, $MaXuatChieu, $NgayChieu) {
            //INSERT INTO `lichchieu` (`MaPhongChieu`, `MaPhim`, `MaXuatChieu`, `NgayChieu`) VALUES ('1', '1', '1', '2024-06-28');
            $updateLichChieuQuery = "INSERT INTO `lichchieu` (`MaPhongChieu`, `MaPhim`, `MaXuatChieu`, `NgayChieu`) VALUES ('$MaPhongChieu', '$MaPhim', '$MaXuatChieu', '$NgayChieu');";
            $result = $this->db->execute($updateLichChieuQuery);
            if($result){
                  return true;
            }
            return false;
      }
}