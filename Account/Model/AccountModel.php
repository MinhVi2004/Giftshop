<?php

require(__DIR__ . "/../../Lib/Database.php");
class AccountModel {
      private $db;

      public function __construct() {
            $this->db = new Database();
      }
      public function getAllAccount() {
            $getAllAccountQuery = "SELECT * from `taikhoan`";
            $result = $this->db->select($getAllAccountQuery);
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
      public function getAccountByMaFacebook($MaFB) {
            $getAccountByMaFacebookQuery = "SELECT * from `taikhoan` where `taikhoan`.MaFacebook = '$MaFB'";
            $result = $this->db->select($getAccountByMaFacebookQuery);
            if(count($result) > 0) {
                  return $result[0];
            }
            return null;
      }
      public function getAccountByMaGmail($MaGmail) {
            $getAccountByMaGmailQuery = "SELECT * from `taikhoan` where `taikhoan`.MaGmail = '$MaGmail'";
            $result = $this->db->select($getAccountByMaGmailQuery);
            if(count($result) > 0) {
                  return $result[0];
            }
            return null;
      }
      public function getAccountByTenDangNhapVaMatKhau($TenDangNhap, $MatKhau) {
            $getAccountByTenDangNhapVaMatKhauQuery = "SELECT * from `taikhoan` where `taikhoan`.TenDangNhap = '$TenDangNhap'";
            $result = $this->db->select($getAccountByTenDangNhapVaMatKhauQuery);
            if(count($result) > 0)
                  if(password_verify($MatKhau, $result[0]['MatKhau'])) 
                        return $result[0];
                  
            return null;
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
                  return true;
            }
            //? đã tồn tại email
            return false;
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
      public function getLastMaTk() {
            // SELECT * FROM taikhoan ORDER BY MaTK DESC LIMIT 1;
            $getLastMaTkQuery = "SELECT * FROM taikhoan ORDER BY MaTK DESC LIMIT 1";
            $result = $this->db->select($getLastMaTkQuery);
            // Kiểm tra nếu mảng result rỗng
            if (empty($result)) {
                  return null;  // Hoặc giá trị mặc định khác như 'SP000' nếu bạn cần
            } else {
                  return $result[0]['MaTK'];
            }
      }
      public function createNewMaTK() {
            $lastMaTK = "TK000";
            if($this->getLastMaTk() !== null) {
                  $lastMaTK = $this->getLastMaTk();
            }
            // Tách phần chữ và phần số
            $prefix = preg_replace('/\d+/', '', $lastMaTK); // Lấy phần chữ (TK)
            $number = preg_replace('/\D+/', '', $lastMaTK); // Lấy phần số (001)

            // Tăng giá trị số lên 1
            $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

            // Kết hợp lại
            return $prefix . $newNumber;
      }
      public function createOTP($SoDienThoai, $OTP) {
            // Xây dựng câu lệnh SQL để chèn tài khoản
            $createOTPQuery = "
                INSERT INTO `taikhoan` (`OTP`) 
                VALUES ('$OTP') WHERE `taikhoan`.SoDienThoai = '$SoDienThoai';
            ";
        
            // Thực thi câu lệnh SQL
            return $this->db->execute($createOTPQuery);
      }
      public function createAccount($TenDangNhap, $MatKhau, $HoTen, $Email, $SoDienThoai) {
            // Mã hóa mật khẩu
            $maHoaMatKhau = password_hash($MatKhau, PASSWORD_DEFAULT);
        
            // Xây dựng câu lệnh SQL để chèn tài khoản
            $createAccountQuery = "
                INSERT INTO `taikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `Email`, `NgayTao`, `TrangThai`, `PhanQuyen`, `MaFacebook`, `MaGmail`, `HoTen`,`OTP`, `SoDienThoaiTK`) 
                VALUES ('".$this->createNewMaTK()."', '$TenDangNhap', '$maHoaMatKhau', '$Email', NOW(), 'Bình Thường', 'Khách Hàng', NULL, NULL, '$HoTen','', '$SoDienThoai');
            ";
        
            // Thực thi câu lệnh SQL
            return $this->db->execute($createAccountQuery);
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
      public function createAccountGmail($MaGmail, $HoTen, $Email) {
            // Xây dựng câu lệnh SQL để chèn tài khoản
            $createAccountGmailQuery = 
            "
            INSERT INTO `taikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `Email`, `NgayTao`, `TrangThai`, `PhanQuyen`, `MaFacebook`, `MaGmail`, `HoTen`) 
            VALUES ('".$this->createNewMaTK()."', '', '','$Email', NOW(), 'Bình Thường', 'Khách Hàng', NULL, '$MaGmail', '$HoTen');
            ";

            // Thực thi câu lệnh SQL
            return $this->db->execute($createAccountGmailQuery);
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
      public function createAccountFacebook($MaFacebook, $HoTen, $Email) {
            if($this->checkExistedMaFacebook($MaFacebook)) {
                  // Xây dựng câu lệnh SQL để chèn tài khoản
                  $createAccountFacebookQuery = 
                  "
                  INSERT INTO `taikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `Email`, `NgayTao`, `TrangThai`, `PhanQuyen`, `MaFacebook`, `MaGmail`, `HoTen`) 
                  VALUES ('".$this->createNewMaTK()."', '', '', '$Email', NOW(), 'Bình Thường', 'Khách Hàng', '$MaFacebook', NULL, '$HoTen');
                  ";
      
                  // Thực thi câu lệnh SQL
                  return $this->db->execute($createAccountFacebookQuery);
            }
            
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
            $getAccountByTokenQuery = "SELECT * FROM `password_resets`, `taikhoan` WHERE taikhoan.MaFacebook = NULL and  taikhoan.MaGmail = NULL and taikhoan.Email = password_resets.email and password_resets.token ='$token'";
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
            $updateAccountQuery = "UPDATE `taikhoan` SET `taikhoan`.`HoTen` = '$HoTen', `taikhoan`.`Email` = '$Email', `taikhoan`.`SoDienThoai` = '$SoDienThoai'   WHERE `taikhoan`.`MaTK` = '$MaTK'";
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