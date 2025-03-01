<?php
require_once (__DIR__ . "/../Lib/Database.php");
class ThanhToanModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAllByMaTK($MaTK) {
            $getAllQuery = "SELECT * from `donhang` WHERE TrangThaiDH = 'Bình Thường';";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getAllKhuyenMai() {
            $getAllKhuyenMaiQuery = "SELECT * from `khuyenmai` WHERE TrangThaiKM = 'Bình Thường';";
            $result = $this->db->select($getAllKhuyenMaiQuery);
            if(count($result) > 0){
                  return $result;
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
      public function themDonHang($MaKM, $MaTK, $MaDC, $TongGiaTri, $TienGiamGia, $TongThanhToan) {
            //INSERT INTO `donhang` (`MaDH`, `MaKM`, `MaTK`, `MaDC`, `TongGiaTri`, `NgayDatHang`, `TrangThaiDH`) VALUES ('".$this->createNewMaDH()."', '$MaKM', '$MaTK', '$MaDC', '$TongGiaTri', 'Now()', 'Chưa Xử Lý');
            if($MaKM == NULL) {
                  $themDonHangQuery = "INSERT INTO `donhang` (`MaDH`, `MaTK`, `MaDC`, `TongGiaTri`, `TienGiamGia`,`TongThanhToan`, `NgayDatHang`, `TrangThaiDH`) VALUES ('".$this->createNewMaDH()."', '$MaTK', '$MaDC', '$TongGiaTri', '$TienGiamGia', '$TongThanhToan', NOW(), 'Chưa Xác Nhận');";
            } else {
                  $themDonHangQuery = "INSERT INTO `donhang` (`MaDH`, `MaKM`, `MaTK`, `MaDC`, `TongGiaTri`, `TienGiamGia`,`TongThanhToan`, `NgayDatHang`, `TrangThaiDH`) VALUES ('".$this->createNewMaDH()."', '$MaKM', '$MaTK', '$MaDC', '$TongGiaTri', '$TienGiamGia', '$TongThanhToan', NOW(), 'Chưa Xác Nhận');";
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
                              $ThanhTien = strval($GiaSP * $SoLuong);

                              if(!$this->themChiTietDonHang($MaDH, $MaSP, $SoLuong, $GiaSP, $ThanhTien))
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
      public function capNhatTrangThaiDonHang($MaDH, $TrangThaiDH) {
            //UPDATE `donhang` SET `TrangThaiDH` = 'Hoàn Thành' WHERE `donhang`.`MaDH` = 'DH008';
            $suaDonHangQuery = "UPDATE `donhang` SET `TrangThaiDH` = '$TrangThaiDH' WHERE `donhang`.`MaDH` = '$MaDH';";
            return $this->db->execute($suaDonHangQuery);
      }
      
      public function getLastMaTB() {
            // SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 1;
            $getLastMaTBQuery = "SELECT * FROM `thongbao` ORDER BY MaTB DESC LIMIT 1";
            $result = $this->db->select($getLastMaTBQuery);
            if (empty($result)) {
                  return null;  // Hoặc giá trị mặc định khác như 'SP000' nếu bạn cần
            } else {
                  return $result[0]['MaTB'];
            }
      }
      public function createNewMaTB() {
            $lastMaTB = "TB000";
            if($this->getLastMaTB() !== null) {
                  $lastMaTB = $this->getLastMaTB();
            }
            // Tách phần chữ và phần số
            $prefix = preg_replace('/\d+/', '', $lastMaTB); // Lấy phần chữ (KM)
            $number = preg_replace('/\D+/', '', $lastMaTB); // Lấy phần số (001)

            // Tăng giá trị số lên 1
            $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

            // Kết hợp lại
            return $prefix . $newNumber;
      }
      public function thongBaoCapNhatDH($MaTK, $TrangThaiDH) {
            $thongBao = "";
            switch ($TrangThaiDH) {
                  case 'Chưa Xác Nhận':
                        $thongBao = "Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !";
                        break;
                  case 'Đã Xác Nhận':
                        $thongBao = "Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !";
                        break;
                  case 'Hoàn Thành':
                        $thongBao = "Đơn hàng của bạn được giao đến bạn thành công !";
                        break;
                  case 'Hủy':
                        $thongBao = "Đơn hàng của bạn đã bị hủy!";
                        break;
                  
                  default:
                        exit();
            }
            $themThongBaoQuery = "INSERT INTO `thongbao` (`MaTB`,`MaTK`, `TieuDe`, `NoiDung`, `NgayThongBao`, `TrangThaiTB`) VALUES ('".$this->createNewMaTB()."','$MaTK' ,'Cập nhật trạng thái đơn hàng', '$thongBao', NOW(), 'Bình Thường');";
            return $this->db->execute($themThongBaoQuery);
      }
}