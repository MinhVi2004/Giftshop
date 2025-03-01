<?php

require_once (__DIR__ . "/../Lib/Database.php");
class GioHangModel {
      private $db;

      public function __construct() {
            $this->db = new Database();
      }
      public function getAllByMaTK($MaTK) {
            $getAllQuery = "SELECT * from `giohang`,`sanpham` WHERE `giohang`.`MaTK` = '$MaTK' and `giohang`.`MaSP` = `sanpham`.`MaSP`;";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function giamSoLuongGioHang($MaTK, $MaSP) {
            $giamSoLuongGioHangQuery = "UPDATE `giohang` SET `giohang`.`SoLuong` = GREATEST(`giohang`.`SoLuong` - 1, 1) WHERE `giohang`.`MaTK` = '$MaTK' and `giohang`.`MaSP` = '$MaSP'";
            return $this->db->execute($giamSoLuongGioHangQuery);
      }
      public function tangSoLuongGioHang($MaTK, $MaSP) {
            $tangSoLuongGioHangQuery = "UPDATE `giohang` SET `giohang`.`SoLuong` = `giohang`.`SoLuong` + 1 WHERE `giohang`.`MaTK` = '$MaTK' and `giohang`.`MaSP` = '$MaSP'";
            return $this->db->execute($tangSoLuongGioHangQuery);
      }
      public function xoaSanPhamGioHang($MaTK, $MaSP) {
            $xoaSanPhamGioHangQuery = "DELETE FROM `giohang` WHERE `giohang`.`MaTK` = '$MaTK' and `giohang`.`MaSP` = '$MaSP'";
            return $this->db->execute($xoaSanPhamGioHangQuery);
      }
      public function getQuantitySanPham($MaTK) {
            $getAllQuery = "SELECT * from `giohang`WHERE `giohang`.`MaTK` = '$MaTK';";
            $result = $this->db->select($getAllQuery);
            return count($result);
      }
      public function checkExistSanPham($MaTK,$MaSP) {
            //SELECT * FROM `giohang`
            $checkExistSanPhamQuery = "SELECT * from `giohang` WHERE `giohang`.MaTK = '$MaTK' and `giohang`.MaSP = '$MaSP';";
            $result = $this->db->select($checkExistSanPhamQuery);
            if(count($result) > 0){
                  return $result[0]['SoLuong'];
            }
            return null;
      }
      public function themGioHang($MaTK, $MaSP, $SoLuong) {
            //INSERT INTO `giohang` (`MaTK`, `MaSP`, `SoLuong`) VALUES ('TK001', 'SP001', '1');
            if($this->checkExistSanPham($MaTK, $MaSP) !== null) {
                  $SoLuong = $SoLuong + $this->checkExistSanPham($MaTK, $MaSP);
                  return $this->suaGioHang($MaTK, $MaSP, $SoLuong);
            } else {
                  $themGioHangQuery = "INSERT INTO `giohang` (`MaTK`, `MaSP`, `SoLuong`) VALUES ('$MaTK', '$MaSP', '$SoLuong');";
                  return $this->db->execute($themGioHangQuery);
            }
      }
      public function suaGioHang($MaTK, $MaSP, $SoLuong) {
            //UPDATE `giohang` SET `SoLuong` = '$SoLuong' WHERE `giohang`.`MaSP` = '$MaSP' and `giohang`.`MaTK` = '$MaTK';
            $suaGioHangQuery = "UPDATE `giohang` SET `SoLuong` = '$SoLuong' WHERE `giohang`.`MaSP` = '$MaSP' and `giohang`.`MaTK` = '$MaTK';";
            return $this->db->execute($suaGioHangQuery);
      }
}