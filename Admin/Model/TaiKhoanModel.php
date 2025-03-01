<?php
require (__DIR__ . "/../../Lib/Database.php");
class TaiKhoanModel {
      private $db;
      public function __construct() {
            $this->db = new Database();
      }
      public function getAll() {
            $getAllQuery = "SELECT * from `taikhoan`";
            $result = $this->db->select($getAllQuery);
            if(count($result) > 0){
                  return $result;
            }
            return null;
      }
      public function getTaiKhoanById($MaTaiKhoan) {
            $getTaiKhoanByIdQuery = "SELECT * from `taikhoan` WHERE `taikhoan`.`MaTK`  = '$MaTaiKhoan';";
            $result = $this->db->select($getTaiKhoanByIdQuery);
            if(count($result) > 0){
                  return $result[0];      
            }
            return null;
      }
      public function updateTrangThaiTaiKhoan($MaTK, $TrangThai) {
            $updateTrangThaiTaiKhoanQuery = "UPDATE `taikhoan` SET `taikhoan`.TrangThai = '$TrangThai' WHERE `taikhoan`.MaTK  = '$MaTK';";
            $result = $this->db->execute($updateTrangThaiTaiKhoanQuery);
            if($result){
                  return true;      
            }
            return false;
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
      public function checkExistEmailUpdate($MaTaiKhoan, $Email) {
            $checkExistEmailQuery = "SELECT * from `taikhoan` where `taikhoan`.Email = '$Email'";
            $result = $this->db->select($checkExistEmailQuery);
            if(count($result) == 0) {
                  //? không tồn tại email
                  return true;
            }
            if($result[0]['MaTaiKhoan'] == $MaTaiKhoan) {
                  return true;
            }
            return false;
      }
      public function createAccount($TenDangNhap, $MatKhau, $HoTen, $NgaySinh, $SoDienThoai, $Email) {
            $maHoaMatKhau = password_hash($MatKhau, PASSWORD_DEFAULT);
            $createAccountQuery = "INSERT INTO `taikhoan` (`TenDangNhap`, `MatKhau`, `HoTen`, `NgaySinh`, `SoDienThoai`, `Email`,`XacNhanEmail`) VALUES ('$TenDangNhap', '$maHoaMatKhau', '$HoTen', '$NgaySinh', '$SoDienThoai', '$Email','Chưa Xác Nhận');";
            return $this->db->execute($createAccountQuery);
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
      public function checkOldPassword($MaTaiKhoan, $MatKhauCu) {
            $getAccountByTenDangNhapVaMatKhauQuery = "SELECT * from `taikhoan` where `taikhoan`.MaTaiKhoan = '$MaTaiKhoan'";
            $result = $this->db->select($getAccountByTenDangNhapVaMatKhauQuery);
            if(count($result) > 0)
                  if(password_verify($MatKhauCu, $result[0]['MatKhau'])) 
                        return true;
                  
            return false;
      }
      public function changePasswordAccount($MaTK,$MatKhau) {
            $maHoaMatKhau = password_hash($MatKhau, PASSWORD_DEFAULT);
            $resetPasswordAccountQuery = "UPDATE `taikhoan` SET `taikhoan`.`MatKhau` = '$maHoaMatKhau' WHERE `taikhoan`.`MaTK` = '$MaTK';";
            return $this->db->execute($resetPasswordAccountQuery);
      }
      public function updateAccount($MaTaiKhoan, $HoTen, $NgaySinh, $SoDienThoai, $Email) {
            $updateAccountQuery = "UPDATE `taikhoan` SET `taikhoan`.`HoTen` = '$HoTen', `taikhoan`.`NgaySinh` = '$NgaySinh', `taikhoan`.`SoDienThoai` = '$SoDienThoai', `taikhoan`.`Email` = '$Email'  WHERE `taikhoan`.`MaTaiKhoan` = " . $MaTaiKhoan;
            return $this->db->execute($updateAccountQuery);
      }
      public function getPermissionById($MaTaiKhoan) {
            $user = $this->getTaiKhoanById($MaTaiKhoan);
            if (!$user) {
                  return null;
            }
            $getPermissionByIdQuery = "SELECT * from `phanquyen` where `phanquyen`.VaiTro = '{$user['VaiTro']}'";
            $result = $this->db->select($getPermissionByIdQuery);
            $permission = [];
            if($result && count($result) > 0) {
                  foreach ($result[0] as $key => $value) {
                        if ($value == 1) {
                              $permission[] = $key;
                        }
                  }
                  return $permission;
            }
            return null;
      }
      public function insertAvatar($AnhDaiDien, $MaTaiKhoan) {
            $insertAvatarQuery = "UPDATE `taikhoan` SET `taikhoan`.AnhDaiDien = '$AnhDaiDien' WHERE `taikhoan`.`MaTaiKhoan` = " . $MaTaiKhoan;
            return $this->db->execute($insertAvatarQuery);
      }
      public function updateVerifiedEmail($MaTaiKhoan) {
            $updateVerifiedEmail = "UPDATE `taikhoan` SET `taikhoan`.XacNhanEmail = 'Đã Xác Nhận' WHERE `taikhoan`.`MaTaiKhoan` = " . $MaTaiKhoan;
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