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
      public function getAllByMaVe($MaVe) {//? Chỉ sử dụng cho khách hàng, bởi vì nhân viên không cần nhận Email thông báo
            $this->db->commit();
            $getAllByMaVeQuery = "SELECT * FROM `ve`,`lichchieu`, `taikhoan`,`phim`,`xuatchieu`,`loaive`,`phongchieu` where `ve`.`MaLichChieu` = `lichchieu`.`MaLichChieu` and `lichchieu`.`MaPhim` = `phim`.`MaPhim` and `ve`.`MaKhachHang` = `taikhoan`.`MaTaiKhoan` and `lichchieu`.`MaXuatChieu` = `xuatchieu`.`MaXuatChieu` and `ve`.`MaLoaiVe` = `loaive`.`MaLoaiVe` and `lichchieu`.`MaPhongChieu` = `phongchieu`.`MaPhongChieu` and `ve`.`MaVe` = $MaVe;";
            $result = $this->db->select($getAllByMaVeQuery);
            if(count($result) > 0){
                  return $result[0];
            }
            return "ALo";
      }
      public function getLastId() {
            return $this->db->getLastInsertId();
      }
      public function getPhimById($MaPhim) {
            $getPhimByIdQuery = "SELECT * from `phim` WHERE `phim`.MaPhim  = " . $MaPhim;
            $result = $this->db->select($getPhimByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getVeByOrderId($orderId) {
            $getVeByOrderIdQuery = "SELECT * from `ve` WHERE `ve`.`orderId` LIKE '$orderId'";
            $result = $this->db->select($getVeByOrderIdQuery);
            if(count($result) > 0){
                  return true;
            }
            return null;
      }
      public function getAllLoaiVe() {
            $getAllLoaiVeQuery = "SELECT * from `loaive` ";
            $result = $this->db->select($getAllLoaiVeQuery);
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
      public function checkTrangThaiPhim($MaPhim) {
            $checkTrangThaiPhimQuery = "SELECT * FROM `phim` where `phim`.`MaPhim` = '$MaPhim'";
            $result = $this->db->select($checkTrangThaiPhimQuery);
            if($result[0]['TrangThai'] !== "Ẩn phim") {
                  return true;
            }
            return false;
      }
      public function getLichChieuByPhim($MaPhim) {
            $getPhimByIdQuery = "SELECT * from `phim`, `lichchieu`, `xuatchieu` WHERE `phim`.`MaPhim`  = $MaPhim and `phim`.`MaPhim` = `lichchieu`.`MaPhim` and  `xuatchieu`.`MaXuatChieu` = `lichchieu`.`MaXuatChieu` and `lichchieu`.`NgayChieu` >= now() ORDER BY `lichchieu`.`NgayChieu` ASC";
            $result = $this->db->select($getPhimByIdQuery);
            if($result){
                  return $result;      
            }
            return null;
      }
      public function getPhongChieuByMaLichChieu($MaLichChieu) {
            $getPhongChieuByMaLichChieuQuery = "SELECT * FROM `lichchieu`,`phongchieu`,`xuatchieu`,`phim` WHERE `lichchieu`.`MaLichChieu` = $MaLichChieu and `lichchieu`.`MaPhongChieu` = `phongchieu`.`MaPhongChieu` and `lichchieu`.`MaXuatChieu` = `xuatchieu`.`MaXuatChieu` and `lichchieu`.`MaPhim` = `phim`.`MaPhim`;";
            $result = $this->db->select($getPhongChieuByMaLichChieuQuery);
            if(count($result) > 0){
                  //MaLichChieu, MaPhongChieu, MaLichChieu, MaPhim, XuatChieu, NgayChieu, MaPhongChieu, TenPhongChieu, SoLuongGhe, MaXuatChieu, TenXuatChieu, ThoiGianBatDau, ThoiGianKetThuc, SoLuongGheConLai
                  return $result[0];
            }
            return null;
      }
      public function getVeByMaLichChieu($MaLichChieu) {
            $dsGheDaMua = [];
            $getVeByMaLichChieuQuery = "SELECT `ve`.`Ghe` FROM `ve`, `lichchieu` WHERE `ve`.`MaLichChieu` = `lichchieu`.`MaLichChieu` and `lichchieu`.`MaLichChieu` = $MaLichChieu;";
            $result = $this->db->select($getVeByMaLichChieuQuery);
            if(count($result) > 0){
                  foreach($result as $ghe) {
                        $dsGheDaMua[] = $ghe['Ghe'];
                  }
                  return $dsGheDaMua;
            }
            return null;
      }
      public function taoVe($LoaiVe,$MaNhanVien, $MaKhachHang, $Ghe, $MaLichChieu, $orderId) { //? Thực hiện bằng tài khoản khách hàng
            //?INSERT INTO `ve` (`MaVe`, `MaLoaiVe`, `MaNhanVien`, `MaKhachHang`, `Ghe`, `NgayBanVe`, `MaLichChieu`) VALUES (NULL, '1', NULL, '22', '16', '2024-06-18 22:39:07.000000', '8');
            if($MaNhanVien == NULL) {
                  $taoVeKhachHangQuery = "INSERT INTO `ve` (`MaLoaiVe`, `MaKhachHang`, `Ghe`, `NgayBanVe`, `MaLichChieu`,`orderId`) VALUES ('$LoaiVe', '$MaKhachHang', '$Ghe', now(), '$MaLichChieu', '$orderId');";
            } else if($MaKhachHang == NULL){
                  $taoVeKhachHangQuery = "INSERT INTO `ve` (`MaLoaiVe`, `MaNhanVien`, `Ghe`, `NgayBanVe`, `MaLichChieu`,`orderId`) VALUES ('$LoaiVe', '$MaNhanVien', '$Ghe', now(), '$MaLichChieu', '$orderId');";
            } else {
                  $taoVeKhachHangQuery = "INSERT INTO `ve` (`MaLoaiVe`, `MaNhanVien`, `MaKhachHang`, `Ghe`, `NgayBanVe`, `MaLichChieu`, `orderId`) VALUES ('$LoaiVe', '$MaNhanVien', '$MaKhachHang', '$Ghe', now(), '$MaLichChieu', '$orderId');";
            }
            $result = $this->db->execute($taoVeKhachHangQuery);
            if($result) {
                  return true;
            }
            return false;
      }
      // public function taoVeNhanVien($Ghe,$LoaiVe, $MaKhachHang) {//? Thực hiện bằng tài khoản nhân viên
      //       //?INSERT INTO `ve` (`MaVe`, `MaLoaiVe`, `MaNhanVien`, `MaKhachHang`, `Ghe`, `NgayBanVe`, `MaLichChieu`) VALUES (NULL, '1', '19', NULL, '10', '2024-06-18 22:38:25.000000', '8');
      // }
}