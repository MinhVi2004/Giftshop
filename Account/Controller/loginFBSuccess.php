<?php
session_start();
require(__DIR__ . "/../Model/AccountModel.php");
require_once( '../../vendor/autoload.php');

$fb = new Facebook\Facebook([
      'app_id' => '1119024856177338',
      'app_secret' => '154734aff5ae5414fe348204250d05b6',
      'default_graph_version' => 'v2.9',
  ]);
$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
  $response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}
$response = $fb->get('/me?fields=id,name,email', $accessToken);
$GiftShopUser = $response->getDecodedBody();
// Kiểm tra và sử dụng dữ liệu trực tiếp từ GiftShopUser
if (isset($GiftShopUser['id']) && isset($GiftShopUser['name']) && isset($GiftShopUser['email'])) {
  $MaFB = $GiftShopUser['id'];
  $HoTen = $GiftShopUser['name'];
  $Email = $GiftShopUser['email'];
  $AccountModel = new AccountModel();
  if($AccountModel->checkExistedMaFacebook($MaFB)) {
    $AccountModel->createAccountFacebook($MaFB, $HoTen, $Email);
  }
  if(!isset($_SESSION['GiftShopUser'])) {
    $_SESSION['GiftShopUser'] = $AccountModel->getAccountByMaFacebook($MaFB);
    header('Location: ../../index.php');
    exit();
  }
} else {
    echo 'Không có dữ liệu id, name, hoặc email trong phản hồi.';
}
