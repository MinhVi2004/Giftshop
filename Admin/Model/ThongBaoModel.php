<?php
require_once (__DIR__ . "/../../Lib/Database.php");
class ThongBaoModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `thongbao` ORDER BY `thongbao`.`MaTB` DESC";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getThongBaoByMaTB($MaTB) {
            $getThongBaoByIdQuery = "SELECT * from `thongbao` WHERE `thongbao`.`MaTB`  = '$MaTB'";
            $result = $this->db->select($getThongBaoByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function getLastMaTB() {
            // SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT 1;
            $getLastMaTBQuery = "SELECT * FROM `ThongBao` ORDER BY MaTB DESC LIMIT 1";
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
      public function themThongBao($TieuDe, $NoiDung) {
            $themThongBaoQuery = "INSERT INTO `thongbao` (`MaTB`,`MaTK`, `TieuDe`, `NoiDung`, `NgayThongBao`, `TrangThaiTB`) VALUES ('".$this->createNewMaTB()."','' ,'$TieuDe', '$NoiDung', NOW(), 'Bình Thường');";
            return $this->db->execute($themThongBaoQuery);
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
      public function xoaThongBao($MaTB) {
            $xoaThongBaoQuery = "DELETE FROM thongbao WHERE `thongbao`.`MaTB` = '$MaTB'";
            return $this->db->execute($xoaThongBaoQuery);
      }
}