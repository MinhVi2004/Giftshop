<?php
require (__DIR__ . "/../../Lib/Database.php");
class VeModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `ve`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getVeById($MaVe) {
            $getVeByIdQuery = "SELECT * from `ve` WHERE `ve`.MaVe  = " . $MaVe;
            $result = $this->db->select($getVeByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getVeByOrderId($OrderId) {
            $getVeByOrderIdQuery = "SELECT * from `ve` WHERE `ve`.orderId  LIKE '$OrderId'";
            $result = $this->db->select($getVeByOrderIdQuery);
            if(count($result) > 0){
                  return $result;//? không trả về $result[0] vì có nhiều vé có cùng orderId
            }
            return null;
      }
      public function getDetailByOrderId($OrderId) {
            $getDetailByOrderIdQuery = "SELECT `phim`.TenPhim, `phongchieu`.TenPhongChieu, `xuatchieu`.TenXuatChieu, `xuatchieu`.ThoiGianBatDau, `phim`.ThoiLuongPhim, `phim`.TuoiYeuCau, `loaive`.TenLoaiVe, `loaive`.DonGia, `ve`.Ghe, `ve`.TrangThai, `ve`.NgayBanVe, `lichchieu`.NgayChieu, `ve`.MaVe, `ve`.orderId  from `ve`, `loaive`, `lichchieu`, `phim`, `phongchieu`, `xuatchieu` WHERE `ve`.orderId  LIKE '$OrderId' and `ve`.MaLoaiVe = `loaive`.MaLoaiVe and `ve`.MaLichChieu = `lichchieu`.MaLichChieu and `lichchieu`.MaPhim = `phim`.MaPhim and `lichchieu`.MaPhongChieu = `phongchieu`.MaPhongChieu and `lichchieu`.MaXuatChieu = `xuatchieu`.MaXuatChieu";
            $result = $this->db->select($getDetailByOrderIdQuery);
            if(count($result) > 0){
                  return $result;//? không trả về $result[0] vì có nhiều vé có cùng orderId
            }
            return null;
      }
      public function getDetailByMaVe($MaVe) {
            $getDetailByMaVeQuery = "SELECT `phim`.TenPhim, `phongchieu`.TenPhongChieu, `xuatchieu`.TenXuatChieu, `xuatchieu`.ThoiGianBatDau, `phim`.ThoiLuongPhim, `phim`.TuoiYeuCau, `loaive`.TenLoaiVe, `loaive`.DonGia, `ve`.Ghe, `ve`.TrangThai, `ve`.NgayBanVe, `lichchieu`.NgayChieu, `ve`.MaVe  from `ve`, `loaive`, `lichchieu`, `phim`, `phongchieu`, `xuatchieu` WHERE `ve`.MaVe  LIKE '$MaVe' and `ve`.MaLoaiVe = `loaive`.MaLoaiVe and `ve`.MaLichChieu = `lichchieu`.MaLichChieu and `lichchieu`.MaPhim = `phim`.MaPhim and `lichchieu`.MaPhongChieu = `phongchieu`.MaPhongChieu and `lichchieu`.MaXuatChieu = `xuatchieu`.MaXuatChieu";
            $result = $this->db->select($getDetailByMaVeQuery);
            if(count($result) > 0){
                  return $result;//? không trả về $result[0] vì có nhiều vé có cùng orderId
            }
            return null;
      }
      public function setTrangThaiVeByMaVe($MaVe, $TrangThai) {
            $setTrangThaiVeByMaVeQuery = "UPDATE `ve` SET `TrangThai` = '$TrangThai' WHERE `ve`.`MaVe` = $MaVe;";
            $result = $this->db->execute($setTrangThaiVeByMaVeQuery);
            if($result){
                  return true;      
            }
            return false;
      }
      public function setTrangThaiVeByOrderId($OrderId, $TrangThai) {
            $setTrangThaiVeByOrderIdQuery = "UPDATE `ve` SET `TrangThai` = '$TrangThai' WHERE `ve`.`orderId` = $OrderId;";
            $result = $this->db->execute($setTrangThaiVeByOrderIdQuery);
            if($result){
                  return true;
            }
            return false;
      }
}