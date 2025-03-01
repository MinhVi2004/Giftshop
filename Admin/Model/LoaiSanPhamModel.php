<?php
require_once (__DIR__ . "/../../Lib/Database.php");
class LoaiSanPhamModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `loaisanpham` WHERE trangthailoaisp = 'Bình Thường';";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getLastMaLoaiSP() {
            // SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 1;
            $getLastMaSPQuery = "SELECT * FROM loaisanpham ORDER BY MaLoaiSP DESC LIMIT 1";
            $result = $this->db->select($getLastMaSPQuery);
            if (empty($result)) {
                  return null;  // Hoặc giá trị mặc định khác như 'SP000' nếu bạn cần
            } else {
                  return $result[0]['MaLoaiSP'];
            }
      }
      public function createNewMaLoaiSP() {
            $lastMaLSP = "LSP000";
            if($this->getLastMaLoaiSP() !== null) {
                  $lastMaLSP = $this->getLastMaLoaiSP();
            }
            // Tách phần chữ và phần số
            $prefix = preg_replace('/\d+/', '', $lastMaLSP); // Lấy phần chữ (LSP)
            $number = preg_replace('/\D+/', '', $lastMaLSP); // Lấy phần số (001)

            // Tăng giá trị số lên 1
            $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

            // Kết hợp lại
            return $prefix . $newNumber;
      }
      public function themLoaiSanPham($Ten, $Mota) {
            //INSERT INTO `loaisanpham` (`MaLoaiSP`, `TenLoaiSP`, `MoTaLoaiSP`, `TrangThaiLoaiSP`) VALUES ('LSP001', 'Gấu bông', 'Gấu bông là một loại đồ chơi nhồi bông mang hình dạng con gấu.', 'Bình Thường');
            $themLoaiSanPhamQuery = "INSERT INTO `loaisanpham` (`MaLoaiSP`, `TenLoaiSP`, `MoTaLoaiSP`, `TrangThaiLoaiSP`) VALUES ('".$this->createNewMaLoaiSP()."', '$Ten', '$Mota', 'Bình Thường');";
            return $this->db->execute($themLoaiSanPhamQuery);
      }
      public function suaLoaiSanPham($Ma, $Ten, $Mota) {
            //UPDATE `loaisanpham` SET `MoTaLoaiSP` = 'Gấu bông bằng bông.' WHERE `loaisanpham`.`MaLoaiSP` = 'LSP001';
            $suaLoaiSanPhamQuery = "UPDATE `loaisanpham` SET `TenLoaiSP` = '$Ten',`MoTaLoaiSP` = '$Mota' WHERE `loaisanpham`.`MaLoaiSP` = '$Ma';";
            return $this->db->execute($suaLoaiSanPhamQuery);
      }
      public function xoaLoaiSanPham($Ma) {
            //UPDATE `loaisanpham` SET `MoTaLoaiSP` = 'Gấu bông bằng bông.' WHERE `loaisanpham`.`MaLoaiSP` = 'LSP001';
            $xoaLoaiSanPhamQuery = "UPDATE `loaisanpham` SET `TrangThaiLoaiSP` = 'Vô Hiệu Hóa' WHERE `loaisanpham`.`MaLoaiSP` = '$Ma';";
            return $this->db->execute($xoaLoaiSanPhamQuery);
      }
      public function getLoaiSanPhamById($MaLoaiSP) {
            $getLoaiSanPhamByIdQuery = "SELECT * from `loaisanpham` WHERE `sanpham`.MaLoaiSP  = " . $MaLoaiSP;
            $result = $this->db->select($getLoaiSanPhamByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getAllLoaiSP() {
            $getAllLoaiSPQuery = "SELECT * from `loaisanpham`";
            $result = $this->db->select($getAllLoaiSPQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function checkTrangThaiSP($MaSP) {
            $checkTrangThaiSPQuery = "SELECT * FROM `sanpham` where `sanpham`.`MaSP` = '$MaSP'";
            $result = $this->db->select($checkTrangThaiSPQuery);
            if($result[0]['TrangThai'] !== "Vô Hiệu Hóa") {
                  return true;
            }
            return false;
      }
      public function checkTenLoaiSP($TenLoaiSP) {
            $checkTenLoaiSPQuery = "SELECT * FROM `loaisanpham` where `loaisanpham`.`TenLoaiSP` = '$TenLoaiSP' and `loaisanpham`.`trangthailoaisp` = 'Bình Thường';";
            $result = $this->db->select($checkTenLoaiSPQuery);
            if(count($result) > 0) {
                  return true;
            }
            return false;
      }
      public function checkSuaTenLoaiSP($MaLoaiSP, $TenLoaiSP) {
            $checkTenLoaiSPQuery = "SELECT * FROM `loaisanpham` where `loaisanpham`.`TenLoaiSP` = '$TenLoaiSP' and `loaisanpham`.`trangthailoaisp` = 'Bình Thường';";
            $result = $this->db->select($checkTenLoaiSPQuery);
            if(count($result) > 0) {
                  if($result[0]['MaLoaiSP'] == $MaLoaiSP) return false;  
                  return true;
            }
            return false;
      }
}