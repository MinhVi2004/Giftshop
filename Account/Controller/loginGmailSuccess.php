<?php
session_start();
require_once("../../vendor/autoload.php");
require(__DIR__ . "/../Model/AccountModel.php");
require_once("../../Resource/configGmail.php");
use Google\Service\Oauth2;
$client = new Google_Client();
$client->setClientId(GOOGLE_CLIENT_ID);
$client->setClientSecret(GOOGLE_CLIENT_SECRET);
$client->setRedirectUri(GOOGLE_REDIRECT_URL);

if (isset($_GET['code'])) {
    try {
        // Lấy mã token từ Google
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        
        // Kiểm tra lỗi khi lấy token
        if (isset($token['error'])) {
            throw new Exception('Lỗi khi lấy token: ' . $token['error']);
        }

        // Thiết lập token và lấy thông tin người dùng
        $client->setAccessToken($token);
        $oauth2Service = new Oauth2($client);
        $userInfo = $oauth2Service->userinfo->get();

        $MaGmail = $userInfo->id;
        $HoTen = $userInfo->name;
        $Email = $userInfo->email;
        
        // Debug thông tin người dùng
        // echo "<script>alert('$MaGmail')</script>";

        // Tạo model và kiểm tra tài khoản
        $AccountModel = new AccountModel();
        if ($AccountModel->checkExistedMaGmail($MaGmail)) {
            if($AccountModel->checkExistEmail($Email)) {
                $_SESSION['error_message'] = "Email đã được sử dụng, vui lòng sử dụng Email khác!";
                header('Location: ../index.php?ctrl=loginView');
                exit();
            } else {
                $AccountModel->createAccountGmail($MaGmail, $HoTen, $Email);
                $_SESSION['GiftShopUser'] = $AccountModel->getAccountByMaGmail($MaGmail);
                header('Location: ../../index.php');
                exit();
            }
        } else {
            $_SESSION['GiftShopUser'] = $AccountModel->getAccountByMaGmail($MaGmail);
            header('Location: ../../index.php');
            exit();
        }
    } catch (Exception $e) {
        echo 'Đã xảy ra lỗi: ' . $e->getMessage();
    }
} else {
    echo "Không thể đăng nhập!";
}
?>
