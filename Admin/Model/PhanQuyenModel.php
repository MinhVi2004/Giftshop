<?php
require (__DIR__ . "/../../Lib/Database.php");
class PhanQuyenModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `phanquyen`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getAllTaiKhoan() {
            $getAllQuery = "SELECT * from `taikhoan`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getTaiKhoanByID($MaTaiKhoan) {
            $getAllQuery = "SELECT * from `taikhoan` WHERE `taikhoan`.MaTaiKhoan = " . $MaTaiKhoan;
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result[0];
            }
            return null;
      }
      public function getPhanQuyenByVaiTro($VaiTro) {
            $getPhanQuyenByVaiTroQuery = "SELECT * from `phanquyen` WHERE `phanquyen`.VaiTro LIKE '$VaiTro'";
            $result = $this->db->select($getPhanQuyenByVaiTroQuery);
            if(count($result) > 0){
                  return $result[0];
            }
            return null;
      }
      public function suaPhanQuyenTaiKhoan($MaTaiKhoan, $VaiTro) {
            $getAllQuery = "UPDATE `taikhoan` SET `taikhoan`.VaiTro = '$VaiTro' WHERE `taikhoan`.MaTaiKhoan = " . $MaTaiKhoan;
            $result = $this->db->execute($getAllQuery);
            if($result){
                  return true;
            }
            return false;
      }
      public function suaChiTietPhanQuyen($VaiTro, $Phim, $NguoiDung, $PhanQuyen, $LichChieu, $PhongChieu, $DoanhThu, $BinhLuan, $Ve) {
            $suaChiTietPhanQuyenQuery = "UPDATE `phanquyen` SET `phanquyen`.Phim = '$Phim', `phanquyen`.`Người Dùng` = '$NguoiDung',`phanquyen`.`Phân Quyền` = '$PhanQuyen',`phanquyen`.`Lịch Chiếu` = '$LichChieu',`phanquyen`.`Phòng Chiếu` = '$PhongChieu',`phanquyen`.`Doanh Thu` = '$DoanhThu',`phanquyen`.`Bình Luận` = '$BinhLuan',`phanquyen`.`Vé` = '$Ve' WHERE `phanquyen`.VaiTro = '$VaiTro'";
            $result = $this->db->execute($suaChiTietPhanQuyenQuery);
            if($result){
                  return true;
            }
            return false;
      }
}