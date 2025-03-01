<?php

// require (__DIR__ . "/../Lib/Database.php");
class UserModel {
      private $db;

      public function __construct() {
            $this->db = new Database();
      }
      public function getAllAccount() {
            $getAllAccountQuery = "SELECT * from `taikhoan`";
            $result = $this->db->select($getAllAccountQuery);
            return $result;
      }
      public function getAllDiaChi($MaTK) {
            $getAllDiaChiQuery = "SELECT * from `diachi` WHERE `diachi`.`MaTK` = '$MaTK' and `diachi`.`TrangThai` = 'Bình Thường'";
            $result = $this->db->select($getAllDiaChiQuery);
            return $result;
      }
      public function getAccountById($MaTK) {
            $getAccountByIdQuery = "SELECT * from `taikhoan` where `taikhoan`.MaTK = '$MaTK'";
            $result = $this->db->select($getAccountByIdQuery);
            if(count($result) > 0) {
                  return $result[0];
            }
            return null;
      }
      public function getDiaChiById($MaDC) {
            $getDiaChiByIdQuery = "SELECT * from `diachi`where `diachi`.MaDC = '$MaDC'";
            $result = $this->db->select($getDiaChiByIdQuery);
            if(count($result) > 0) {
                  return $result[0];
            }
            return null;
      }
      
      public function getLastMaDC() {
            // SELECT * FROM taikhoan ORDER BY MaDC DESC LIMIT 1;
            $getLastMaDCQuery = "SELECT * FROM diachi ORDER BY MaDC DESC LIMIT 1";
            $result = $this->db->select($getLastMaDCQuery);
            // Kiểm tra nếu mảng result rỗng
            if (empty($result)) {
                  return null;  // Hoặc giá trị mặc định khác như 'SP000' nếu bạn cần
            } else {
                  return $result[0]['MaDC'];
            }
      }
      public function createNewMaDC() {
            $lastMaDC = "DC000";
            if($this->getLastMaDC() !== null) {
                  $lastMaDC = $this->getLastMaDC();
            }
            // Tách phần chữ và phần số
            $prefix = preg_replace('/\d+/', '', $lastMaDC); // Lấy phần chữ (TK)
            $number = preg_replace('/\D+/', '', $lastMaDC); // Lấy phần số (001)

            // Tăng giá trị số lên 1
            $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

            // Kết hợp lại
            return $prefix . $newNumber;
      }
      public function createDiaChi($MaTK, $HoTen, $TinhThanhPho, $QuanHuyen, $PhuongXa, $DiaChiNha, $SoDienThoai) {
            //INSERT INTO `diachi` (`MaDC`, `MaTK`, `TinhThanhPho`, `QuanHuyen`, `PhuongXa`, `DiaChiNha`, `ChiTietDC`, `SoDienThoai`) VALUES ('a', 'TK001', 'a', 'a', 'a', '', 'a', 'a');
            // Xây dựng câu lệnh SQL để chèn tài khoản
            $createDiaChiQuery = "INSERT INTO `diachi` (`MaDC`, `MaTK`, `HoTen`,`TinhThanhPho`, `QuanHuyen`, `PhuongXa`, `DiaChiNha`, `ChiTietDC`, `SoDienThoai`) VALUES ('".$this->createNewMaDC()."', '$MaTK', '$HoTen','$TinhThanhPho', '$QuanHuyen', '$PhuongXa', '$DiaChiNha', '".$DiaChiNha.", ".$PhuongXa.", ".$QuanHuyen."," .$TinhThanhPho. ", Việt Nam"."', '$SoDienThoai');";
        
            // Thực thi câu lệnh SQL
            return $this->db->execute($createDiaChiQuery);
      }
      public function updateDiaChi($MaDC, $HoTen, $TinhThanhPho, $QuanHuyen, $PhuongXa, $DiaChiNha, $SoDienThoai) {
            //UPDATE `diachi` SET `MaDC` = 'DC001z', `MaTK` = 'TK007', `TinhThanhPho` = 'Gia Laiz', `PhuongXa` = 'KRongz', `DiaChiNha` = '123456xxxz', `ChiTietDC` = '123456xxx, KRong, KBang,Gia Lai, Việt Namz', `SoDienThoai` = '0899371680z', `HoTen` = 'Quỳnh Nhưz' WHERE `diachi`.`MaDC` = 'DC001';
            $updateDiaChiQuery = "UPDATE `diachi` SET `TinhThanhPho` = '$TinhThanhPho', `QuanHuyen` = '$QuanHuyen', `PhuongXa` = '$PhuongXa', `DiaChiNha` = '$DiaChiNha', `ChiTietDC` = '$DiaChiNha, $PhuongXa, $QuanHuyen, $TinhThanhPho, Việt Nam', `SoDienThoai` = '$SoDienThoai', `HoTen` = '$HoTen' WHERE `diachi`.`MaDC` = '$MaDC';";
        
            // Thực thi câu lệnh SQL
            return $this->db->execute($updateDiaChiQuery);
      }
      public function deleteDiaChi($MaDC) {
            $deleteDiaChiQuery = "UPDATE `diachi` SET `TrangThai` = 'Vô Hiệu Hóa' WHERE `diachi`.`MaDC` = '$MaDC';";
            // Thực thi câu lệnh SQL
            return $this->db->execute($deleteDiaChiQuery);
      }
      public function checkExistUsername($TenDangNhap) {
            $checkExistUsernameQuery = "SELECT * from `taikhoan` where `taikhoan`.TenDangNhap = '$TenDangNhap'";
            $result = $this->db->select($checkExistUsernameQuery);
            if(count($result) == 0) {
                  return true;
            }
            return false;
      }
      public function checkExistEmail($Email) {
            $checkExistEmailQuery = "SELECT * from `taikhoan` where `taikhoan`.Email = '$Email'";
            $result = $this->db->select($checkExistEmailQuery);
            if(count($result) > 0) {
                  //? không tồn tại email
                  return false;
            }
            //? đã tồn tại email
            return true;
      }
      public function checkExistSoDienThoai($SoDienThoai) {
            $checkExistSoDienThoaiQuery = "SELECT * from `taikhoan` where `taikhoan`.SoDienThoai = '$SoDienThoai'";
            $result = $this->db->select($checkExistSoDienThoaiQuery);
            if(count($result) > 0) {
                  //? không tồn tại email
                  return false;
            }
            //? đã tồn tại email
            return true;
      }
      public function checkExistEmailUpdate($MaTK, $Email) {
            $checkExistEmailQuery = "SELECT * from `taikhoan` where `taikhoan`.Email = '$Email'";
            $result = $this->db->select($checkExistEmailQuery);
            if(count($result) == 0) {
                  //? không tồn tại email
                  return true;
            }
            if($result[0]['MaTK'] == $MaTK) {
                  return true;
            }
            return false;
      }
      public function checkExistSoDienThoaiUpdate($MaTK, $SoDienThoai) {
            $checkExistEmailQuery = "SELECT * from `taikhoan` where `taikhoan`.`SoDienThoai` = '$SoDienThoai'";
            $result = $this->db->select($checkExistEmailQuery);
            if(count($result) == 0) {
                  //? không tồn tại email
                  return true;
            }
            if($result[0]['MaTK'] == $MaTK) {
                  return true;
            }
            return false;
      }
      public function checkExistedMaGmail($MaGmail) {
            $checkExistedMaGmailQuery = "SELECT * from `taikhoan` where `taikhoan`.MaGmail = '$MaGmail'";
            $result = $this->db->select($checkExistedMaGmailQuery);
            if(count($result) == 0) {
                  //? chưa tồn tại mã Gmail
                  return true;
            }
            return false;
      }
      public function checkExistedMaFacebook($MaFacebook) {
            $checkExistedMaGmailQuery = "SELECT * from `taikhoan` where `taikhoan`.MaFacebook = '$MaFacebook'";
            $result = $this->db->select($checkExistedMaGmailQuery);
            if(count($result) == 0) {
                  //? chưa tồn tại mã Gmail
                  return true;
            }
            return false;
      }
      public function createPasswordReset($email, $token, $expires_at) {
            $createPasswordResetQuery = "INSERT INTO password_resets (email, token, expires) VALUES ('$email', '$token', '$expires_at')";
            return $this->db->execute($createPasswordResetQuery);
      }
      public function createEmailVerify($email, $token, $code, $expires_at) {
            $createEmailVerify = "INSERT INTO email_verify (email, token, code, expires) VALUES ('$email', '$token','$code', '$expires_at')";
            return $this->db->execute($createEmailVerify);
      }
      public function getAccountByToken($token) {
            $getAccountByTokenQuery = "SELECT * FROM `password_resets`, `taikhoan` WHERE taikhoan.Email = password_resets.email and password_resets.token ='$token'";
            $result  = $this->db->select($getAccountByTokenQuery);
            if(count($result) > 0) {
                  return $result[0];
            } else 
                  return null;
      }
      public function getAccountByTokenVerifyEmail($token) {
            $getAccountByTokenVerifyEmail = "SELECT * FROM `email_verify`, `taikhoan` WHERE taikhoan.Email = email_verify.email and email_verify.token ='$token'";
            $result  = $this->db->select($getAccountByTokenVerifyEmail);
            if(count($result) > 0) {
                  return $result[0];
            } else 
                  return null;
      }
      public function checkOldPassword($MaTK, $MatKhauCu) {
            $getAccountByTenDangNhapVaMatKhauQuery = "SELECT * from `taikhoan` where `taikhoan`.MaTK = '$MaTK'";
            $result = $this->db->select($getAccountByTenDangNhapVaMatKhauQuery);
            if(count($result) > 0)
                  if(password_verify($MatKhauCu, $result[0]['MatKhau'])) 
                        return true;
                  
            return false;
      }
      public function changePasswordAccount($MaTK,$MatKhau) {
            $maHoaMatKhau = password_hash($MatKhau, PASSWORD_DEFAULT);
            $resetPasswordAccountQuery = "UPDATE `taikhoan` SET `taikhoan`.MatKhau = '$maHoaMatKhau' WHERE `taikhoan`.`MaTK` = '$MaTK'";
            return $this->db->execute($resetPasswordAccountQuery);
      }
      public function updateAccount($MaTK, $HoTen, $SoDienThoai, $Email) {
            $updateAccountQuery = "UPDATE `taikhoan` SET `taikhoan`.`HoTen` = '$HoTen', `taikhoan`.`Email` = '$Email', `taikhoan`.`SoDienThoaiTK` = '$SoDienThoai'   WHERE `taikhoan`.`MaTK` = '$MaTK'";
            return $this->db->execute($updateAccountQuery);
      }
      public function insertAvatar($AnhDaiDien, $MaTK) {
            $insertAvatarQuery = "UPDATE `taikhoan` SET `taikhoan`.AnhDaiDien = '$AnhDaiDien' WHERE `taikhoan`.`MaTK` = '$MaTK';";
            return $this->db->execute($insertAvatarQuery);
      }
      public function updateVerifiedEmail($MaTK) {
            $updateVerifiedEmail = "UPDATE `taikhoan` SET `taikhoan`.XacNhanEmail = 'Đã Xác Nhận' WHERE `taikhoan`.`MaTK` = " . $MaTK;
            return $this->db->execute($updateVerifiedEmail);
      }
      public function checkVerifiedEmail($Email) {
            $checkVerifiedEmail = "SELECT * from `taikhoan` where `taikhoan`.Email = '$Email' and `taikhoan`.XacNhanEmail = 'Đã Xác Nhận'";
            $result = $this->db->select($checkVerifiedEmail);
            if(count($result) > 0)
                  return true;
            return false;
      }
}