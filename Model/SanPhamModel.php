<?php
require_once (__DIR__ . "/../Lib/Database.php");
class SanPhamModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `sanpham` WHERE trangthaisp = 'Bình Thường';";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      
      public function getAllByTenLoaiSP($TenLoaiSP) {
            $getAllByTenLoaiSPQuery = "SELECT * from `sanpham` sp,`loaisp_sp` lsp_sp,`loaisanpham` lsp WHERE sp.trangthaisp = 'Bình Thường' and sp.MaSP = lsp_sp.MaSP and lsp_sp.MaLoaiSP = lsp.MaLoaiSP and lsp.TenLoaiSP = '$TenLoaiSP'";
            $result = $this->db->select($getAllByTenLoaiSPQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getLastMaSP() {
            // SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 1;
            $getLastMaSPQuery = "SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 1";
            $result = $this->db->select($getLastMaSPQuery);
            // Kiểm tra nếu mảng result rỗng
            if (empty($result)) {
                  return null;  // Hoặc giá trị mặc định khác như 'SP000' nếu bạn cần
            } else {
                  return $result[0]['MaSP'];
            }
      }
      public function createNewMaSP() {
            $lastMaSP = "SP000";
            if($this->getLastMaSP() !== null) {
                  $lastMaSP = $this->getLastMaSP();
            }
            // Tách phần chữ và phần số
            $prefix = preg_replace('/\d+/', '', $lastMaSP); // Lấy phần chữ (SP)
            $number = preg_replace('/\D+/', '', $lastMaSP); // Lấy phần số (001)

            // Tăng giá trị số lên 1
            $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

            // Kết hợp lại
            return $prefix . $newNumber;
      }
      public function themSanPham($Ten, $Anh, $Gia, $Mota) {
            //INSERT INTO `sanpham` (`MaSP`, `TenSP`, `AnhSP` `MoTaSP`,`GiaSP`, `TrangThaiSP`) VALUES ('SP001', 'Gấu bông', 'Gấu bông là một loại đồ chơi nhồi bông mang hình dạng con gấu.', 'Bình Thường');
            $themSanPhamQuery = "INSERT INTO `sanpham` (`MaSP`, `TenSP`, `AnhSP`, `MoTaSP`,`GiaSP`, `TrangThaiSP`) VALUES ('".$this->createNewMaSP()."', '$Ten', '$Anh', '$Mota', '$Gia', 'Bình Thường');";
            return $this->db->execute($themSanPhamQuery);
      }
        
      public function themLoaiSP($MaSP, $MaLoaiSP) {
            $themLoaiSPQuery = "INSERT INTO `loaisp_sp` (`MaSP`, `MaLoaiSP`) VALUES ('$MaSP', '$MaLoaiSP');";
            return $this->db->execute($themLoaiSPQuery);
      }
      public function xoaLoaiSPByMaSP($MaSP) {
            $xoaLoaiSPByMaSPQuery = "DELETE FROM `loaisp_sp` WHERE `loaisp_sp`.`MaSP` = '$MaSP';";
            return $this->db->execute($xoaLoaiSPByMaSPQuery);
      }
      public function suaSanPham($Ma, $Ten, $Anh, $Gia, $Mota) {
            //UPDATE `sanpham` SET `MoTaSP` = 'Gấu bông bằng bông.' WHERE `sanpham`.`MaSP` = 'SP001';
            $suaSanPhamQuery = "UPDATE `sanpham` SET `TenSP` = '$Ten',`MoTaSP` = '$Mota', `AnhSP` = '$Anh', `GiaSP` = '$Gia'   WHERE `sanpham`.`MaSP` = '$Ma';";
            return $this->db->execute($suaSanPhamQuery);
      }
      public function suaSanPhamKhongDoiAnh($Ma, $Ten, $Gia, $Mota) {
            //UPDATE `sanpham` SET `MoTaSP` = 'Gấu bông bằng bông.' WHERE `sanpham`.`MaSP` = 'SP001';
            $suaSanPhamKhongDoiAnhQuery = "UPDATE `sanpham` SET `TenSP` = '$Ten',`MoTaSP` = '$Mota', `GiaSP` = '$Gia'   WHERE `sanpham`.`MaSP` = '$Ma';";
            return $this->db->execute($suaSanPhamKhongDoiAnhQuery);
      }
      public function xoaSanPham($Ma) {
            //UPDATE `sanpham` SET `MoTaSP` = 'Gấu bông bằng bông.' WHERE `sanpham`.`MaSP` = 'SP001';
            $xoaSanPhamQuery = "UPDATE `sanpham` SET `TrangThaiSP` = 'Vô Hiệu Hóa' WHERE `sanpham`.`MaSP` = '$Ma';";
            return $this->db->execute($xoaSanPhamQuery);
      }
      public function getSanPhamById($MaSP) {
            $getSanPhamByIdQuery = "SELECT * from `sanpham` WHERE `sanpham`.MaSP  = " . $MaSP;
            $result = $this->db->select($getSanPhamByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getAllLoaiSP() {
            $getAllLoaiSPQuery = "SELECT * from `loaisanpham` WHERE trangthailoaisp = 'Bình Thường';";
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
      public function getLoaiSPByMaSP($MaSP) {
            $getLoaiSPByMaSPQuery = "SELECT * FROM `loaisp_sp` where `loaisp_sp`.`MaSP` = '$MaSP'";
            $result = $this->db->select($getLoaiSPByMaSPQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
}