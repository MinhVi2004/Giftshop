<?php

require(__DIR__ . "/../Model/AccountModel.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "C:\\xampp\\htdocs\\Galaxy\\Lib\\PHPMailer-master\\src\\Exception.php";
require "C:\\xampp\\htdocs\\Galaxy\\Lib\\PHPMailer-master\\src\\PHPMailer.php";
require "C:\\xampp\\htdocs\\Galaxy\\Lib\\PHPMailer-master\\src\\SMTP.php";
class AccountController {
      private $AccountModel;
      public function __construct() {
            $this->AccountModel = new AccountModel();
      }
      public function showLogin() {
            require(__DIR__ . "/../View/loginView.php");
      }
      public function showSignin() {
            require(__DIR__ . "/../View/signinView.php");
      }
      public function showFillEmailReset() {
            require(__DIR__ . "/../View/fillEmailResetView.php");
      }
      public function showResetPassword() {
            require(__DIR__ . "/../View/resetPasswordView.php");
      }
      public function showProfile() {
            require(__DIR__ . "/../View/profileView.php");
      }
      public function showChangePassword() {
            require(__DIR__ . "/../View/changePasswordView.php");
      }
      public function signin() {
            $TenDangNhap = $_POST['TenDangNhap'];
            $MatKhau = $_POST['MatKhau'];
            $HoTen = $_POST['HoTen'];
            $NgaySinh = $_POST['NgaySinh'];
            $SoDienThoai = $_POST['SoDienThoai'];
            $Email = $_POST['Email'];


            $errors = [];
            if (!$this->AccountModel->checkExistEmail($Email)) {
                $errors[] = 'email_exist';
            }

            if (!$this->AccountModel->checkExistUsername($TenDangNhap)) {
                $errors[] = 'username_exist';
            }

            if (!empty($errors)) {
                echo json_encode($errors);
                return;
            }

            try {
                $result = $this->AccountModel->createAccount($TenDangNhap, $MatKhau, $HoTen, $NgaySinh, $SoDienThoai, $Email);
                if ($result) {
                    echo 'success';
                } else {
                    echo 'error';
                }
            } catch (mysqli_sql_exception $e) {
                echo 'lỗi';
            }
      }
      public function login() {
            session_start();
            $TenDangNhap = $_POST['TenDangNhap'];
            $MatKhau = $_POST['MatKhau'];
            $result = $this->AccountModel->getAccountByTenDangNhapVaMatKhau($TenDangNhap, $MatKhau);
            if($result) {
                  if($result['TrangThai'] == "Đang Hoạt Động") {
                        $_SESSION['UserLogin'] = $result;
                        $_SESSION['Permission'] = $this->AccountModel->getPermissionById($result['MaTaiKhoan']);
                        echo "success";
                  } else {
                        echo "lock";
                  }
            } else {
                  echo "error";
            }
      }
      
      public function checkLogin() {
            session_start();
            if(isset($_SESSION['UserLogin'])){
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function logout() {
            session_start();
            $_SESSION = array();

            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) {
                  $params = session_get_cookie_params();
                  setcookie(session_name(), '', time() - 42000,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                  );
            }
            session_destroy();
            echo "success";
      }
      public function sendResetLink() {
            $email = $_POST['Email'];
            if (!$this->AccountModel->checkExistEmail($email)) {
                  // Tạo token đặt lại mật khẩu
                  $token = bin2hex(random_bytes(50));
                  // Gửi email chứa link đặt lại mật khẩu
                  $reset_link = "http://localhost/Galaxy/Account/index.php?ctrl=resetPasswordView&token=" . $token;

                  // Lưu token vào cơ sở dữ liệu với thời hạn (ví dụ: 1 giờ)
                  $expires_at = date("Y-m-d H:i:s", strtotime('+1 hour'));
                  $result = $this->AccountModel->createPasswordReset($email, $token, $expires_at);
                  if(!$result) 
                        echo "Lỗi khi tạo password_reset";
                        $mail = new PHPMailer(true);
                        try {
                              //Server settings
                              $mail->SMTPDebug = 0;
                              $mail->CharSet = 'UTF-8';
                              $mail->isSMTP(); // Sử dụng SMTP để gửi mail
                              $mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
                              $mail->SMTPAuth = true; // Bật xác thực SMTP
                              $mail->Username = 'dvmv2017@gmail.com'; // Tài khoản email
                              $mail->Password = 'lbwt wcar tofl chli'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
                              $mail->SMTPSecure = 'ssl'; // Mã hóa SSL
                              $mail->Port = 465; // Cổng kết nối SMTP là 465
            
                              //Recipients
                              $mail->setFrom('galaxy@cine.com', 'Galaxycine'); // Địa chỉ email và tên người gửi
                              $mail->addAddress($email, 'name'); // Địa chỉ mail và tên người nhận
            
                              //Content
                              $mail->isHTML(true); // Set email format to HTML
                              $mail->Subject = 'Yêu cầu đặt lại mật khẩu của bạn'; // Tiêu đề
                              $mail->Body = 'Nhấp vào link sau để đặt lại mật khẩu của bạn: '.$reset_link; // Nội dung
                              
                              if($mail->send())
                                    echo 'Link đặt lại mật khẩu đã được gửi đến email của bạn.';
                              else 
                                    echo "Gửi Email thất bại";
                        } catch (Exception $e) {
                              echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                        }
            } else {
                  echo "Email không tồn tại trong hệ thống.";
            }
      }
      public function resetPassword() {
            $MatKhau = $_POST['MatKhau'];
            $Token = $_POST['Token'];
            $account = $this->AccountModel->getAccountByToken($Token);
            if($account) {
                  if($this->AccountModel->changePasswordAccount($account['MaTaiKhoan'], $MatKhau))
                        echo "success";
                  else 
                        echo "error_updatePassword";
            } else {
                  echo "error_notFoundAccount";
            }
      }     
      public function updateAccount() {
            session_start();
            $MaTaiKhoan = $_SESSION['UserLogin']['MaTaiKhoan'];
            $HoTen = $_POST['HoTen'];
            $NgaySinh = $_POST['NgaySinh'];
            $SoDienThoai = $_POST['SoDienThoai'];
            $Email = $_POST['Email'];
            $errors = [];
            if (!$this->AccountModel->checkExistEmailUpdate($MaTaiKhoan, $Email)) {
                $errors[] = 'email_exist';
            }


            if (!empty($errors)) {
                echo json_encode($errors);
                return;
            }

            try {
                  $result = $this->AccountModel->updateAccount($MaTaiKhoan, $HoTen, $NgaySinh, $SoDienThoai, $Email);
                  if ($result) {
                        $_SESSION['UserLogin'] = $this->AccountModel->getAccountById($MaTaiKhoan);
                        echo 'success';
                  } else {
                        echo 'error';
                  }
            } catch (mysqli_sql_exception $e) {
                echo 'lỗi';
            }
      }
      public function changePassword() {
            session_start();
            $MaTaiKhoan = $_SESSION['UserLogin']['MaTaiKhoan'];
            $MatKhauCu = $_POST['MatKhauCu'];
            $MatKhauMoi = $_POST['MatKhauMoi'];

            $user = $this->AccountModel->getAccountById($MaTaiKhoan);

            $errors = [];
            if(!$this->AccountModel->checkOldPassword($MaTaiKhoan, $MatKhauCu)) {
                  $errors[] = "incorrect_oldpassword";
            }
            if (!empty($errors)) {
                  echo json_encode($errors);
                  return;
            }
            try {
                  $result = $this->AccountModel->changePasswordAccount($MaTaiKhoan, $MatKhauMoi);
                  if ($result) {
                        $_SESSION['UserLogin'] = $this->AccountModel->getAccountById($MaTaiKhoan);
                        echo 'success';
                  } else {
                        echo 'error';
                  }
            } catch (mysqli_sql_exception $e) {
                  echo 'lỗi';
            }
      }
}
$accountController = new AccountController();

if(isset($_POST['action'])) {
      switch($_POST['action']) {
            case "checkLogin":
                  $accountController->checkLogin();
                  break;
            case "signin":
                  $accountController->signin();
                  break;
            case "login":
                  $accountController->login();
                  break;
            case "logout":
                  $accountController->logout();
                  break;
            case "sendResetLink":
                  $accountController->sendResetLink();
                  break;
            case "resetPassword":
                  $accountController->resetPassword();
                  break;
            case "updateAccount":
                  $accountController->updateAccount();
                  break;
            case "changePassword":
                  $accountController->changePassword();
                  break;
      }
      unset($_POST['action']);
} else if(isset($_GET['ctrl'])) {
      switch ($_GET['ctrl']) {
            case "loginView":
                  $accountController->showLogin();
                  break;
            case "signinView":
                  $accountController->showSignin();
                  break;
            case "forgotPasswordView":
                  $accountController->showFillEmailReset();
                  break;
            case "resetPasswordView":
                  $accountController->showResetPassword();
                  break;
            case "profileView":
                  $accountController->showProfile();
                  break;
            case "changePasswordView":
                  $accountController->showChangePassword();
                  break;
      }
}


