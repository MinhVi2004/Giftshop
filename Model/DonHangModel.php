<?php
require_once (__DIR__ . "/../Lib/Database.php");
class DonHangModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll($MaTK) {
            $getAllQuery = "SELECT * FROM donhang WHERE donhang.MaTK = '$MaTK'  ORDER BY MaDH DESC";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getQuantityGioHang($MaTK) {
            $getQuantityGioHangQuery = "SELECT * FROM giohang WHERE giohang.MaTK = '$MaTK'";
            $result = $this->db->select($getQuantityGioHangQuery);
            if(count($result) > 0){
                  return true;
            }
            return false;
      }
      public function getThongTinDonHang($MaDH) {
            $getThongTinDonHangQuery = "SELECT * FROM donhang WHERE donhang.MaDH = '$MaDH'";
            $result = $this->db->select($getThongTinDonHangQuery);
            if(count($result) > 0){
                  return $result[0];
            }
            return null;
      }
      public function getChiTietDonHang($MaDH) {
            $getChiTietDonHangQuery = "SELECT sp.AnhSP, sp.TenSP, ctdh.GiaLucMua, ctdh.SoLuong, ctdh.ThanhTien, dh.TongThanhToan, dh.TienGiamGia, dh.TongGiaTri, dh.NgayDatHang, dh.TrangThaiDH FROM donhang dh, sanpham sp, chitietdonhang ctdh WHERE dh.MaDH = ctdh.MaDH and ctdh.MaSP = sp.MaSP and dh.MaDH = '$MaDH'";
            $result = $this->db->select($getChiTietDonHangQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getDiaChiDonHang($MaDH) {
            $getDiaChiDonHangQuery = "SELECT * FROM donhang, diachi WHERE donhang.MaDC = diachi.MaDC and donhang.MaDH = '$MaDH'";
            $result = $this->db->select($getDiaChiDonHangQuery);
            if(count($result) > 0){
                  return $result[0];
            }
            return null;
      }
      public function getKhuyenMaiDonHang($MaDH) {
            $getKhuyenMaiDonHangQuery = "SELECT * FROM donhang, khuyenmai WHERE donhang.MaKM = khuyenmai.MaKM and donhang.MaDH = '$MaDH'";
            $result = $this->db->select($getKhuyenMaiDonHangQuery);
            if(count($result) > 0){
                  return $result[0];
            }
            return null;
      }
      public function getLastMaDH() {
            // SELECT * FROM sanpham ORDER BY MaDH DESC LIMIT 1;
            $getLastMaDHQuery = "SELECT * FROM `donhang` ORDER BY MaDH DESC LIMIT 1";
            $result = $this->db->select($getLastMaDHQuery);
            // Kiểm tra nếu mảng result rỗng
            if (empty($result)) {
                  return null;  // Hoặc giá trị mặc định khác như 'DH000' nếu bạn cần
            } else {
                  return $result[0]['MaDH'];
            }
      }
      public function createNewMaDH() {
            $lastMaDH = "DH000";
            if($this->getLastMaDH() !== null) {
                  $lastMaDH = $this->getLastMaDH();
            }
            // Tách phần chữ và phần số
            $prefix = preg_replace('/\d+/', '', $lastMaDH); // Lấy phần chữ (DH)
            $number = preg_replace('/\D+/', '', $lastMaDH); // Lấy phần số (001)

            // Tăng giá trị số lên 1
            $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

            // Kết hợp lại
            return $prefix . $newNumber;
      }
      public function themChiTietDonHang($MaDH, $MaSP, $SoLuong, $GiaLucMua, $ThanhTien) {
            //INSERT INTO `chitietdonhang` (`MaDH`, `MaSP`, `SoLuong`, `GiaLucMua`, `ThanhTien`) VALUES ('', 'SP001', '12312', '123123', '123123');
            $themChiTietDonHangQuery = "INSERT INTO `chitietdonhang` (`MaDH`, `MaSP`, `GiaLucMua`, `SoLuong`, `ThanhTien`) VALUES ('$MaDH', '$MaSP', '$GiaLucMua', '$SoLuong', '$ThanhTien');";
            return $this->db->execute($themChiTietDonHangQuery);   
      }
      public function xoaChiTietGioHang($MaTK, $MaSP) {
            // DELETE FROM `giohang` WHERE `giohang`.`MaTK` = '$MaTK' and `giohang`.`MaSP` = '$MaSP'
            $xoaChiTietGioHangQuery = "DELETE FROM `giohang` WHERE `giohang`.`MaTK` = '$MaTK' and `giohang`.`MaSP` = '$MaSP'";
            return $this->db->execute($xoaChiTietGioHangQuery);   
      }
      public function themDonHang($MaKM, $MaTK, $MaDC, $TongGiaTri) {
            //INSERT INTO `donhang` (`MaDH`, `MaKM`, `MaTK`, `MaDC`, `TongGiaTri`, `NgayDatHang`, `TrangThaiDH`) VALUES ('".$this->createNewMaDH()."', '$MaKM', '$MaTK', '$MaDC', '$TongGiaTri', 'Now()', 'Chưa Xác Nhận');
            if($MaKM == NULL) {
                  $themDonHangQuery = "INSERT INTO `donhang` (`MaDH`, `MaKM`, `MaTK`, `MaDC`, `TongGiaTri`, `NgayDatHang`, `TrangThaiDH`) VALUES ('".$this->createNewMaDH()."', 'NULL', '$MaTK', '$MaDC', '$TongGiaTri', 'Now()', 'Chưa Xác Nhận');";
            } else {
                  $themDonHangQuery = "INSERT INTO `donhang` (`MaDH`, `MaKM`, `MaTK`, `MaDC`, `TongGiaTri`, `NgayDatHang`, `TrangThaiDH`) VALUES ('".$this->createNewMaDH()."', '$MaKM', '$MaTK', '$MaDC', '$TongGiaTri', 'Now()', 'Chưa Xác Nhận');";
            }
            
            if($this->db->execute($themDonHangQuery)) {
                  //? Xử lý chitietdonhang
                  $getAllGioHangQuery = "SELECT sp.MaSP, sp.GiaSP, gh.SoLuong from giohang gh,sanpham sp WHERE gh.`MaTK` = '$MaTK' and gh.`MaSP` = sp.`MaSP`;";
                  $result = $this->db->select($getAllGioHangQuery);
                  if(count($result) > 0){
                        foreach($result as $row) {
                              $MaDH = $this->getLastMaDH();
                              $MaSP = $row['MaSP'];
                              $GiaSP = $row['GiaSP'];
                              $SoLuong = $row['SoLuong'];
                              $ThanhTien = $GiaSP * $SoLuong;

                              if(!$this->themChiTietDonHang($MaDH, $MaSP, $GiaSP, $SoLuong, $ThanhTien))
                                    return false;
                              if(!$this->xoaChiTietGioHang($MaTK, $MaSP)) 
                                    return false;
                              
                        }
                        return true;
                  } 
                  return false;
            } else{
                  return false;
            }
      }
      public function suaDonHang($Ma, $Ten, $Anh, $Gia, $Mota) {
            //UPDATE `donhang` SET `MoTaSP` = 'Gấu bông bằng bông.' WHERE `donhang`.`MaSP` = 'SP001';
            $suaDonHangQuery = "UPDATE `donhang` SET `TenSP` = '$Ten',`MoTaSP` = '$Mota', `AnhSP` = '$Anh', `GiaSP` = '$Gia'   WHERE `donhang`.`MaSP` = '$Ma';";
            return $this->db->execute($suaDonHangQuery);
      }

      public function getSanPhamById($MaSP) {
            $getSanPhamByIdQuery = "SELECT * from `donhang` WHERE `donhang`.MaSP  = " . $MaSP;
            $result = $this->db->select($getSanPhamByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }

}