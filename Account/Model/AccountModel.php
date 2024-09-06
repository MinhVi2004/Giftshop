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
      public function getAccountById($MaTaiKhoan) {
            $getAllAccountQuery = "SELECT * from `taikhoan` where `taikhoan`.MaTaiKhoan = " . $MaTaiKhoan;
            $result = $this->db->select($getAllAccountQuery);
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
            if(count($result) == 0) {
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
            $createAccountQuery = "INSERT INTO `taikhoan` (`TenDangNhap`, `MatKhau`, `HoTen`, `NgaySinh`, `SoDienThoai`, `Email`) VALUES ('$TenDangNhap', '$maHoaMatKhau', '$HoTen', '$NgaySinh', '$SoDienThoai', '$Email');";
            return $this->db->execute($createAccountQuery);
      }
      public function createPasswordReset($email, $token, $expires_at) {
            $createPasswordResetQuery = "INSERT INTO password_resets (email, token, expires) VALUES ('$email', '$token', '$expires_at')";
            return $this->db->execute($createPasswordResetQuery);
      }
      public function getAccountByToken($token) {
            $getAccountByTokenQuery = "SELECT * FROM `password_resets`, `taikhoan` WHERE taikhoan.Email = password_resets.email and password_resets.token ='$token'";
            $result  = $this->db->select($getAccountByTokenQuery);
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
      public function changePasswordAccount($MaTaiKhoan,$MatKhau) {
            $maHoaMatKhau = password_hash($MatKhau, PASSWORD_DEFAULT);
            $resetPasswordAccountQuery = "UPDATE `taikhoan` SET `taikhoan`.MatKhau = '$maHoaMatKhau' WHERE `taikhoan`.`MaTaiKhoan` = " . $MaTaiKhoan;
            return $this->db->execute($resetPasswordAccountQuery);
      }
      public function updateAccount($MaTaiKhoan, $HoTen, $NgaySinh, $SoDienThoai, $Email) {
            $updateAccountQuery = "UPDATE `taikhoan` SET `taikhoan`.`HoTen` = '$HoTen', `taikhoan`.`NgaySinh` = '$NgaySinh', `taikhoan`.`SoDienThoai` = '$SoDienThoai', `taikhoan`.`Email` = '$Email'  WHERE `taikhoan`.`MaTaiKhoan` = " . $MaTaiKhoan;
            return $this->db->execute($updateAccountQuery);
      }
      public function getPermissionById($MaTaiKhoan) {
            $user = $this->getAccountById($MaTaiKhoan);
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
}