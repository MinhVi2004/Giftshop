<?php
require_once (__DIR__ . "/../../Lib/Database.php");
class KhuyenMaiModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `khuyenmai`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getKhuyenMaiByMaKM($MaKM) {
            $getKhuyenMaiByIdQuery = "SELECT * from `khuyenmai` WHERE `khuyenmai`.`MaKM`  = '$MaKM'";
            $result = $this->db->select($getKhuyenMaiByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getLastMaKM() {
            // SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 1;
            $getLastMaKMQuery = "SELECT * FROM khuyenmai ORDER BY MaKM DESC LIMIT 1";
            $result = $this->db->select($getLastMaKMQuery);
            if (empty($result)) {
                  return null;  // Hoặc giá trị mặc định khác như 'SP000' nếu bạn cần
            } else {
                  return $result[0]['MaKM'];
            }
      }
      public function createNewMaKM() {
            $lastMaKM = "KM000";
            if($this->getLastMaKM() !== null) {
                  $lastMaKM = $this->getLastMaKM();
            }
            // Tách phần chữ và phần số
            $prefix = preg_replace('/\d+/', '', $lastMaKM); // Lấy phần chữ (KM)
            $number = preg_replace('/\D+/', '', $lastMaKM); // Lấy phần số (001)

            // Tăng giá trị số lên 1
            $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

            // Kết hợp lại
            return $prefix . $newNumber;
      }
      public function themKhuyenMai($Ten, $Mota, $PhanTram, $NgayBatDau, $NgayKetThuc) {
            $themKhuyenMaiQuery = "INSERT INTO `khuyenmai` (`MaKM`, `TenKM`, `MoTaKM`, `PhanTramGiamGia`, `NgayBatDau`, `NgayKetThuc`, `TrangThaiKM`) VALUES ('".$this->createNewMaKM()."', '$Ten', '$Mota', '$PhanTram', '$NgayBatDau', '$NgayKetThuc', 'Bình Thường');";
            return $this->db->execute($themKhuyenMaiQuery);
      }
      public function suaKhuyenMai($Ma, $Ten, $Mota, $PhanTram, $NgayBatDau, $NgayKetThuc) {
            $suaKhuyenMaiQuery = "UPDATE `khuyenmai` SET `TenKM` = '$Ten',`MoTaKM` = '$Mota',`PhanTramGiamGia` = '$PhanTram', `NgayBatDau` = '$NgayBatDau', `NgayKetThuc` = '$NgayKetThuc' WHERE `khuyenmai`.`MaKM` = '$Ma'   ;";
            return $this->db->execute($suaKhuyenMaiQuery);
      }
      public function xoaKhuyenMai($Ma) {
            $xoaKhuyenMaiQuery = "UPDATE `khuyenmai` SET `TrangThaiKM` = 'Vô Hiệu Hóa' WHERE `khuyenmai`.`MaKM` = '$Ma';";
            return $this->db->execute($xoaKhuyenMaiQuery);
      }
      public function getAllLoaiSP() {
            $getAllLoaiSPQuery = "SELECT * from `khuyenmai`";
            $result = $this->db->select($getAllLoaiSPQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function checkTenKM($TenKM) {
            $checkTenKMQuery = "SELECT * FROM `khuyenmai` where `khuyenmai`.`TenKM` = '$TenKM' and `khuyenmai`.`trangthaiKM` = 'Bình Thường';";
            $result = $this->db->select($checkTenKMQuery);
            if(count($result) > 0) {
                  return true;
            }
            return false;
      }
      public function checkSuaTenKM($MaKM, $TenKM) {
            $checkTenKMQuery = "SELECT * FROM `khuyenmai` where `khuyenmai`.`TenKM` = '$TenKM' and `khuyenmai`.`trangthaiKM` = 'Bình Thường';";
            $result = $this->db->select($checkTenKMQuery);
            if(count($result) > 0) {
                  if($result[0]['MaKM'] == $MaKM) return false;  
                  return true;
            }
            return false;
      }
}