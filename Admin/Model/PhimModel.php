<?php
require (__DIR__ . "/../../Lib/Database.php");
class PhimModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `phim`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getAllLoaiPhim() {
            $getAllLoaiPhimQuery = "SELECT * from `loaiphim`";
            $result = $this->db->select($getAllLoaiPhimQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getPhimById($MaPhim) {
            $getPhimByIdQuery = "SELECT * from `phim` WHERE `phim`.MaPhim  = " . $MaPhim;
            $result = $this->db->select($getPhimByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getLoaiPhimById($MaLoaiPhim) {
            $getLoaiPhimByIdQuery = "SELECT * from `loaiphim` WHERE `loaiphim`.MaLoaiPhim  = " . $MaLoaiPhim;
            $result = $this->db->select($getLoaiPhimByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getLoaiPhimByMaPhim($MaPhim) {
            $getLoaiPhimByIdQuery = "SELECT * from `phim_loaiphim`, `loaiphim` WHERE `phim_loaiphim`.`MaLoaiPhim` = `loaiphim`.`MaLoaiPhim` and `phim_loaiphim`.`MaPhim`  = " . $MaPhim;
            $result = $this->db->select($getLoaiPhimByIdQuery);
            if(count($result) > 0){
                  return $result;      
            }
            return null;
      }
      public function updatePhim($MaPhim, $TenPhim, $AnhPhimNho, $AnhPhimLon, $Trailer, $ThongTin, $TuoiYeuCau, $ThoiLuongPhim, $NgayKhoiChieu, $XuatXu, $NhaSanXuat, $TrangThai) {
            $updatePhimQuery = "UPDATE `phim` SET `phim`.`TenPhim` = '$TenPhim', `phim`.`AnhPhimNho` = '$AnhPhimNho', `phim`.`AnhPhimLon` = '$AnhPhimLon', `phim`.`Trailer` = '$Trailer', `phim`.`ThongTin` = '$ThongTin', `phim`.`TuoiYeuCau` = '$TuoiYeuCau', `phim`.`ThoiLuongPhim` = '$ThoiLuongPhim', `phim`.`NgayKhoiChieu` = '$NgayKhoiChieu', `phim`.`XuatXu` = '$XuatXu', `phim`.`NhaSanXuat` = '$NhaSanXuat', `phim`.`TrangThai` = '$TrangThai' WHERE `phim`.`MaPhim` = '$MaPhim' ";
            $result = $this->db->execute($updatePhimQuery);
            if($result) {
                  return true;
            }
            return false;
      }
      public function updateLoaiPhim($MaLoaiPhim, $TenLoaiPhim, $MoTa) {
            $updateLoaiPhimQuery = "UPDATE `loaiphim` SET `loaiphim`.`TenLoaiPhim` = '$TenLoaiPhim', `loaiphim`.`MoTa` = '$MoTa' WHERE `loaiphim`.`MaLoaiPhim` = '$MaLoaiPhim' ";
            $result = $this->db->execute($updateLoaiPhimQuery);
            if($result) {
                  return true;
            }
            return false;
      }
      public function addPhim($TenPhim, $AnhPhimNho, $AnhPhimLon, $Trailer, $ThongTin, $TuoiYeuCau, $ThoiLuongPhim, $NgayKhoiChieu, $XuatXu, $NhaSanXuat, $TrangThai) {
            $addPhimQuery = "INSERT INTO `phim` (`TenPhim`, `AnhPhimNho`, `AnhPhimLon`, `Trailer`, `ThongTin`, `TuoiYeuCau`, `ThoiLuongPhim`, `NgayKhoiChieu`, `XuatXu`, `NhaSanXuat`, `TrangThai`) VALUES ('$TenPhim', '$AnhPhimNho', '$AnhPhimLon', '$Trailer', '$ThongTin', '$TuoiYeuCau', '$ThoiLuongPhim', '$NgayKhoiChieu', '$XuatXu', '$NhaSanXuat', '$TrangThai');";
            $result = $this->db->execute($addPhimQuery);
            if($result) {
                  return true;
            }
            return false;
      }
      public function addLoaiPhim($TenLoaiPhim, $MoTa) {
            $addLoaiPhimQuery = "INSERT INTO `loaiphim`(`TenLoaiPhim`, `MoTa`) VALUES ('$TenLoaiPhim', '$MoTa')";
            $result = $this->db->execute($addLoaiPhimQuery);
            if($result) {
                  return true;
            }
            return false;
      }
      public function addPhim_LoaiPhim($DSMaLoaiPhim) {
            $MaPhim = $this->getLastId();
            $addPhim_LoaiPhimQuery = "INSERT INTO `phim_loaiphim` (`MaPhim`, `MaLoaiPhim`) VALUES ";
            foreach($DSMaLoaiPhim as $MaLoaiPhim) {
                  $addPhim_LoaiPhimQuery .= "('$MaPhim', '$MaLoaiPhim'),";
            }
            $addPhim_LoaiPhimQuery = substr($addPhim_LoaiPhimQuery, 0, -1);
            $addPhim_LoaiPhimQuery .= ";";
            $result = $this->db->execute($addPhim_LoaiPhimQuery);
            if($result) {
                  return true;
            }
            return false;
      }
      public function getLastId() {
            return $this->db->getLastInsertId();
      }
}