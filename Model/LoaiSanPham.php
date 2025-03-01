<?php
require_once (__DIR__ . "/../Lib/Database.php");
class LoaiSanPhamModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `loaisanpham`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getLastMaLoaiSP() {
            // SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 1;
            $getLastMaSPQuery = "SELECT * FROM loaisanpham ORDER BY MaSP DESC LIMIT 1";
            $result = $this->db->select($getLastMaSPQuery);
            return $result[0]['MaSP'];
      }
      public function createNewMaSP() {
            // LSP001
            $lastMaLoaiSP = $this->getLastMaLoaiSP();
            // Tách phần chữ và phần số
            $prefix = preg_replace('/\d+/', '', $lastMaLoaiSP); // Lấy phần chữ (LSP)
            $number = preg_replace('/\D+/', '', $lastMaLoaiSP); // Lấy phần số (001)

            // Tăng giá trị số lên 1
            $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

            // Kết hợp lại
            return $prefix . $newNumber;
      }
      public function themLoaiSanPham($TenLoaiSP, $MoTaLoaiSP) {
            $themLoaiSanPhamQuery = "INSERT INTO `loaisanpham` (`MaLoaiSP`, `TenLoaiSP`, `MoTaLoaiSP`, `TrangThaiLoaiSP`) VALUES ('".$this->getLastMaLoaiSP()."', '$TenLoaiSP', '$MoTaLoaiSP', 'Bình Thường');";
            $result = $this->db->execute($themLoaiSanPhamQuery);
            if($result) {
                  return true;
            }
            return false;
      }
      public function getLoaiSanPhamById($MaLoaiSP) {
            $getLoaiSanPhamByIdQuery = "SELECT * from `loaisanpham` WHERE `loaisanpham`.MaLoaiSP  = " . $MaLoaiSP;
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
      public function checkTrangThaiLoaiSP($MaLoaiSP) {
            $checkTrangThaiLoaiSPQuery = "SELECT * FROM `loaisanpham` where `loaisanpham`.`MaLoaiSP` = '$MaLoaiSP'";
            $result = $this->db->select($checkTrangThaiLoaiSPQuery);
            if($result[0]['TrangThai'] !== "Vô Hiệu Hóa") {
                  return true;
            }
            return false;
      }
}