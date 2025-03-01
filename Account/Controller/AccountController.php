<?php

require(__DIR__ . "/../Model/AccountModel.php");

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require (__DIR__ . "/../../Lib/PHPMailer-master/src/Exception.php");
require (__DIR__ . "/../../Lib/PHPMailer-master/src/PHPMailer.php");
require (__DIR__ . "/../../Lib/PHPMailer-master/src/SMTP.php");
class AccountController {
      private $AccountModel;
      public function __construct() {
            $this->AccountModel = new AccountModel();
      }
      public function showLogin() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  if (isset($_SESSION['error_message'])) {
                        echo "<script>customAlert('" . $_SESSION['error_message'] . "');</script>";
                        unset($_SESSION['error_message']);
                  }
                  require(__DIR__ . "/../View/loginView.php");
            } else {
                  echo "Trang web không tồn tại !";
                  header('Location: ../index.php');
            }
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
      public function showVerifyEmail() {
            require(__DIR__ . "/../View/verifyEmailView.php");
      }
      public function signin() {
            $TenDangNhap = $_POST['TenDangNhap'];
            $MatKhau = $_POST['MatKhau'];
            $HoTen = $_POST['HoTen'];
            $SoDienThoai = $_POST['SoDienThoai'];
            $Email = $_POST['Email'];

            $domain = substr(strrchr($Email, "@"), 1);
            if (checkdnsrr($domain, "MX")) {
                  // echo "The domain exists and can receive emails.";
            } else {
                  echo "The domain does not exist or cannot receive emails.";
            }
            $errors = [];

            if (!$this->AccountModel->checkExistUsername($TenDangNhap)) {
                $errors[] = 'username_exist';
            }

            if (!empty($errors)) {
                echo json_encode($errors);
                return;
            }

            try {
                  $result = $this->AccountModel->createAccount($TenDangNhap, $MatKhau, $HoTen, $Email, $SoDienThoai);
                  if ($result) {
                        echo "success";
                        // $this->sendVerifiedLink();
                  } else {
                        echo 'error';
                  }
            } catch (mysqli_sql_exception $e) {
                echo 'lỗi' . $e->getMessage();
            }
      }
      public function login() {
            session_start();
            $TenDangNhap = $_POST['TenDangNhap'];
            $MatKhau = $_POST['MatKhau'];
            $result = $this->AccountModel->getAccountByTenDangNhapVaMatKhau($TenDangNhap, $MatKhau);
            if($result) {
                  if($result['TrangThai'] == "Bình Thường") {
                        $_SESSION['GiftShopUser'] = $result;
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
            if(isset($_SESSION['GiftShopUser'])){
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
            // Tạo token đặt lại mật khẩu
            $token = bin2hex(random_bytes(50));
            // Gửi email chứa link đặt lại mật khẩu
            $reset_link = "http://localhost/GiftShop/Account/index.php?ctrl=resetPasswordView&token=" . $token;

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
                        $mail->setFrom('dvmv2017@gmail.com', 'GiftShop'); // Địa chỉ email và tên người gửi
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
      }
      public function resetPassword() {
            $MatKhau = $_POST['MatKhau'];
            $Token = $_POST['Token'];
            $account = $this->AccountModel->getAccountByToken($Token);
            if($account) {
                  if($this->AccountModel->changePasswordAccount($account['MaTK'], $MatKhau))
                        echo "success";
                  else 
                        echo "error_updatePassword";
            } else {
                  echo "error_notFoundAccount";
            }
      }     
      public function verifyEmail() {
            $code = $_POST['code'];
            $token = $_POST['token'];
            $account = $this->AccountModel->getAccountByTokenVerifyEmail($token);
            if($account && $account['code'] === $code) {
                  if($this->AccountModel->updateVerifiedEmail($account['MaTaiKhoan'])) {
                        $_SESSION['GiftShopUser'] = $this->AccountModel->getAccountById($account['MaTaiKhoan']);
                        echo "success";
                  }
                  else 
                        echo "error_verifyEmail";
            } else {
                  echo "error_notFoundAccount";
            }
      }     
      public function updateAccount() {
            session_start();
            $MaTK = $_SESSION['GiftShopUser']['MaTK'];
            $HoTen = $_POST['HoTen'];
            $SoDienThoai = $_POST['SoDienThoai'];
            $Email = $_POST['Email'];
            $errors = [];
            if (!$this->AccountModel->checkExistEmailUpdate($MaTK, $Email)) {
                $errors[] = 'email_exist';
            }


            if (!empty($errors)) {
                echo json_encode($errors);
                return;
            }

            try {
                  $result = $this->AccountModel->updateAccount($MaTK, $HoTen, $SoDienThoai, $Email);
                  if ($result) {
                        $_SESSION['GiftShopUser'] = $this->AccountModel->getAccountById($MaTK);
                        echo 'success';
                  } else {
                        echo 'error';
                  }
            } catch (mysqli_sql_exception $e) {
                echo 'lỗi' . $e->getMessage() ;
            }
      }
      public function changePassword() {
            session_start();
            $MaTK = $_SESSION['GiftShopUser']['MaTK'];
            $MatKhauCu = $_POST['MatKhauCu'];
            $MatKhauMoi = $_POST['MatKhauMoi'];

            $user = $this->AccountModel->getAccountById($MaTK);

            $errors = [];
            if(!$this->AccountModel->checkOldPassword($MaTK, $MatKhauCu)) {
                  $errors[] = "incorrect_oldpassword";
            }
            if (!empty($errors)) {
                  echo json_encode($errors);
                  return;
            }
            try {
                  $result = $this->AccountModel->changePasswordAccount($MaTK, $MatKhauMoi);
                  if ($result) {
                        $_SESSION['GiftShopUser'] = $this->AccountModel->getAccountById($MaTK);
                        echo 'success';
                  } else {
                        echo 'error';
                  }
            } catch (mysqli_sql_exception $e) {
                  echo 'lỗi' . $e->getMessage();
            }
      }
      public function uploadAvatar() {
            session_start();
            if (isset($_FILES['inputUploadAvatar'])) {
                $errors = array();
                $file_name = $_FILES['inputUploadAvatar']['name'];
                $file_size = $_FILES['inputUploadAvatar']['size'];
                $file_tmp = $_FILES['inputUploadAvatar']['tmp_name'];
                $file_type = $_FILES['inputUploadAvatar']['type'];
                $file_parts = explode('.', $_FILES['inputUploadAvatar']['name']);
                $file_ext = strtolower(end($file_parts));
                $expensions = array("jpeg", "jpg", "png");
        
                if (in_array($file_ext, $expensions) === false) {
                    $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
                }
        
            //     if ($file_size > 2097152) {
            //         $errors[] = 'Kích thước file không được lớn hơn 2MB';
            //     }
        
                if (empty($errors)) {
                    $image = $_FILES['inputUploadAvatar']['name'];
                    $target = __DIR__ . "/../../IMG/Avatar/" . "temp_" . $image;
        
                    if (move_uploaded_file($file_tmp, $target)) {
                        // Cắt hình ảnh thành hình tròn
                        $this->cropToCircle($target, __DIR__ . "/../../IMG/Avatar/" . "AVT" . $_SESSION["GiftShopUser"]["MaTK"] . basename($image));
        
                        // Xóa file tạm
                        unlink($target);
        
                        // Cập nhật cơ sở dữ liệu
                        $result = $this->AccountModel->insertAvatar("AVT" . $_SESSION["GiftShopUser"]["MaTK"] . basename($image), $_SESSION["GiftShopUser"]["MaTK"]);
                        if ($result && $result != 0) {
                            $_SESSION['GiftShopUser']['AnhDaiDien'] = "AVT" . $_SESSION["GiftShopUser"]["MaTK"] . basename($image);
                            echo "success";
                        } else {
                            echo "error_SQL";
                        }
                    } else {
                        echo "error_upload";
                    }
                } else {
                    foreach ($errors as $error) {
                        echo $error . "<br>";
                    }
                }
            }
      }
      
      private function cropToCircle($sourceFile, $destinationFile) {
      // Tạo đối tượng hình ảnh từ file nguồn
      $srcImage = imagecreatefromjpeg($sourceFile);
      if (!$srcImage) $srcImage = imagecreatefrompng($sourceFile);
      
      // Lấy kích thước của hình ảnh
      $width = imagesx($srcImage);
      $height = imagesy($srcImage);
      
      // Tạo hình ảnh mới với kích thước bằng hình vuông
      $size = min($width, $height);
      $circleImage = imagecreatetruecolor($size, $size);
      
      // Tạo nền trong suốt cho hình ảnh mới
      $transparent = imagecolorallocatealpha($circleImage, 0, 0, 0, 127);
      imagefill($circleImage, 0, 0, $transparent);
      imagecolortransparent($circleImage, $transparent);
      
      // Tạo mặt nạ hình tròn
      $mask = imagecreatetruecolor($size, $size);
      imagefill($mask, 0, 0, $transparent);
      $white = imagecolorallocate($mask, 255, 255, 255);
      imagefilledrectangle($mask, 0, 0, $size, $size, $white);
      imagefilledellipse($mask, $size / 2, $size / 2, $size, $size, $transparent);
      imagecolortransparent($mask, $transparent);
      imagecopymerge($circleImage, $mask, 0, 0, 0, 0, $size, $size, 100);
      
      // Cắt hình ảnh thành hình tròn
      imagecopyresampled($circleImage, $srcImage, 0, 0, ($width - $size) / 2, ($height - $size) / 2, $size, $size, $size, $size);
      
      // Lưu hình ảnh mới
      imagepng($circleImage, $destinationFile);
      
      // Giải phóng bộ nhớ
      imagedestroy($srcImage);
      imagedestroy($circleImage);
      imagedestroy($mask);
      }
      public function sendSMSResetPassword() {

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
            case "verifyEmail":
                  $accountController->verifyEmail();
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
      }
}


