<?php
// ? Đã khai báo trong index.php
require (__DIR__ . "/../Model/PhimModel.php");
require (__DIR__ . "/../Model/BinhLuanModel.php");
require (__DIR__ . "/../Model/ThanhToanMomoModel.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "C:\\xampp\\htdocs\\Galaxy\\Lib\\PHPMailer-master\\src\\Exception.php";
require "C:\\xampp\\htdocs\\Galaxy\\Lib\\PHPMailer-master\\src\\PHPMailer.php";
require "C:\\xampp\\htdocs\\Galaxy\\Lib\\PHPMailer-master\\src\\SMTP.php";

require "C:\\xampp\\htdocs\\Galaxy\\Lib\\phpqrcode-2010100721_1.1.4\\phpqrcode\\qrlib.php";
//? Mã QR
class UserController {
      private $phimModel;
      private $binhLuanModel;
      private $thanhToanMomoModel;
      public function __construct() {
            //? Đã khởi tạo trong index.php
            $this->phimModel = new PhimModel();
            $this->binhLuanModel = new BinhLuanModel();
            $this->thanhToanMomoModel = new ThanhToanMomoModel();
      }
      public function getAllLoaiPhim() {
            return $this->phimModel->getAllLoaiPhim();
      }
      public function showHomePage() {
            $phimList = $this->phimModel->getAll();
            require(__DIR__ . "/../View/homePageView.php");
      }
      public function showMovie() {
            if(!$this->phimModel->checkTrangThaiPhim($_GET['id'])) {
                  echo "<p>Phim không tồn tại</p>";
                  return;
            }
            $lichChieu = $this->phimModel->getLichChieuByPhim($_GET['id']);
            $phim = $this->phimModel->getPhimById($_GET['id']);
            $binhLuan = $this->binhLuanModel->getAllByIdPhim($_GET['id']);
            require(__DIR__ . "/../View/movieView.php");
      }
      public function showBooking() {
            $ve = [];
            if($this->phimModel->getVeByMaLichChieu($_GET['id'])) {
               $ve = $this->phimModel->getVeByMaLichChieu($_GET['id']);
            }
            $loaiVe = $this->phimModel->getAllLoaiVe(); 
            $phongChieu = $this->phimModel->getPhongChieuByMaLichChieu($_GET['id']);
            require(__DIR__ . "/../View/bookingView.php");
      }
      public function execPostRequest($url, $data)
      {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
      }
      public function showBookedTicket() {
            $orderId = $_GET['orderId'];
            if(!$this->phimModel->getVeByOrderId($orderId)) {
                  $LoaiVe = $_GET['LoaiVe'];
                  $DSGhe = $_GET['DSGhe'];
                  $MaLichChieu = $_GET['MaLichChieu'];
                  
                  //? Tạo vé và gửi tin nhắn xác nhận
                  $this->muaVe($LoaiVe, $DSGhe, $MaLichChieu, $orderId);
            }
            require(__DIR__ . "/../View/bookedTicketView.php");
      }
      public function muaVe($LoaiVe, $DSGhe, $MaLichChieu, $orderId) {
            // $LoaiVe = $_POST['LoaiVe'];
            // $DSGhe = $_POST['Ghe'];
            // $MaLichChieu = $_POST['MaLichChieu'];
            if(count($_SESSION['Permission']) == 0) { //?  khách hàng
                  $MaNhanVien = NULL;
                  $MaKhachHang = $_SESSION['UserLogin']['MaTaiKhoan'];
                  $dsVe = []; //? biến chứa danh sách các vé được mua chung 1 lần
                  foreach($DSGhe as $Ghe) {
                        $result = $this->phimModel->taoVe($LoaiVe, $MaNhanVien, $MaKhachHang, $Ghe, $MaLichChieu, $orderId);
                        if($result) {
                              $dsVe[] = $this->phimModel->getLastId();
                              $this->taoMaQR_MaVe($this->phimModel->getLastId());
                        }
                  }
                  $this->guiTinNhanXacNhan($dsVe, $orderId);
                  // if($flag) {
                  //       echo "success";
                  // } else {
                  //       echo "error";
                  // }
            } else { //? nhân viên
                  $MaNhanVien = $_SESSION['UserLogin']['MaTaiKhoan'];
                  $MaKhachHang = NULL;
                  $dsVe = []; //? biến chứa danh sách các vé được mua chung 1 lần
                  foreach($DSGhe as $Ghe) {
                        $result = $this->phimModel->taoVe($LoaiVe, $MaNhanVien, $MaKhachHang, $Ghe, $MaLichChieu, $orderId);
                        if($result) {
                              $dsVe[] = $this->phimModel->getLastId();
                              $this->taoMaQR_MaVe($this->phimModel->getLastId());
                        }
                  }
                  // if($flag) {
                  //       echo "success";
                  // } else {
                  //       echo "error";
                  // }
            }
      }
      public function taoMaQR_OrderId($OrderId) {
            QRcode::png("$OrderId", "C:\\xampp\\htdocs\\Galaxy\\IMG\\QR\\OrderID\\".$OrderId.".png","L",20,5);
      }
      public function taoMaQR_MaVe($MaVe) {
            QRcode::png("$MaVe", "C:\\xampp\\htdocs\\Galaxy\\IMG\\QR\\MaVe\\".$MaVe.".png","L",20,5);
      }
        
      public function guiTinNhanXacNhan($MaVe, $orderId) {
            $temp = $this->phimModel->getAllByMaVe($MaVe[0]);
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
                  $mail->addAddress($temp['Email'], $temp['HoTen']); // Địa chỉ mail và tên người nhận
                  //? IMG
                  $mail->AddEmbeddedImage("C:\\xampp\\htdocs\\Galaxy\\IMG\\QR\\OrderId\\".$orderId.".png", $orderId);
                  //Content
                  $mail->isHTML(true); // Set email format to HTML
                  $mail->Subject = 'Xác nhận đặt vé xem phim thành công'; // Tiêu đề
                  $totalPrice = 0;
                  $countVe = 1;
                  $stringEmail = 
                  "<p>Kính gửi khách hàng $temp[HoTen]</p>
                  <br>
                  <p>Cảm ơn quý khách đã đặt vé xem phim tại GalaxyCine. Chúng tôi xin xác nhận rằng giao dịch của quý khách đã thành công. Dưới đây là thông tin chi tiết về vé xem phim của quý khách:</p>
                  <br>";
                  foreach($MaVe as $Ve) {
                        $data = $this->phimModel->getAllByMaVe($Ve);
                        $totalPrice += $data['DonGia'];
                        
                        $stringEmail .= "<p>Thông tin vé số ".$countVe.":</p>
                        <p> - Rạp: GalaxyCine</p>
                        <p> - Loại vé: $data[TenLoaiVe]</p>
                        <p> - Tên phim: $data[TenPhim]</p>
                        <p> - Suất chiếu: $data[NgayChieu] - $data[ThoiGianBatDau]</p>
                        <p> - Phòng chiếu: $data[TenPhongChieu]</p>
                        <p> - Ghế ngồi: $data[Ghe]</p>
                        <br>";
                        $countVe++;
                  }
                  $stringEmail .= "
                  <p>Thông tin giao dịch:</p>
                  <img src='cid:".$orderId."'>
                  <p> Số lượng vé : ".count($MaVe)."</p>
                  <p> - Tổng số tiền: ".number_format($totalPrice, 0, '', '.')." VNĐ</p>
                  <br>
                  <p>Hướng dẫn nhận vé:</p>
                  <p> - Quý khách vui lòng đến quầy vé của rạp trước giờ chiếu ít nhất 30 phút để nhận vé.</p>
                  <p> - Xuất trình mã đặt vé và giấy tờ tùy thân (nếu cần) tại quầy vé.</p>
                  <br>
                  <p>Lưu ý:</p>
                  <p>Vé đã mua không thể đổi trả hoặc hủy bỏ.</p>
                  <p>Quý khách vui lòng tuân thủ quy định của rạp trong suốt thời gian xem phim.</p>
                  <p>Chúng tôi hy vọng quý khách sẽ có trải nghiệm xem phim tuyệt vời tại GalaxyCine.</p>
                  <br>
                  <p>Trân Trọng</p>";
                  $mail->Body = $stringEmail; // Nội dung
                  if($mail->send()) 
                        return true;
                  else 
                        return false;
            } catch (Exception $e) {
                  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
      }
      public function thanhToan() {
            $LoaiVe = $_POST['LoaiVe'];
            $DSGhe = $_POST['Ghe'];
            $MaLichChieu = $_POST['MaLichChieu'];
            $total = $_POST['TongTien'];
            $quantity = $_POST['SoLuongVe'];

            header('Content-type: text/html; charset=utf-8');
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = "Thanh toán ". $quantity." vé xem phim Galaxycine.com";
            $amount = $total;
            $orderId = time() ."";

            $redirectUrl = "http://localhost/Galaxy/User/index.php";
            $redirectUrl .= "?ctrl=bookedTicket";
            $redirectUrl .= "&LoaiVe=" . urlencode($LoaiVe);
            $redirectUrl .= "&" . http_build_query(['DSGhe' => $DSGhe]); // Dùng http_build_query để biến đổi mảng thành chuỗi query
            $redirectUrl .= "&MaLichChieu=" . urlencode($MaLichChieu);
            $redirectUrl .= "&orderId=" . urlencode($orderId);

            $ipnUrl = "http://localhost/Galaxy/User/index.php";
            $extraData = "";


            //     $partnerCode = $_POST["partnerCode"];
            //     $accessKey = $_POST["accessKey"];
            //     $serectkey = $_POST["secretKey"];
            //     $orderId = $_POST["orderId"]; // Mã đơn hàng
            //     $orderInfo = $_POST["orderInfo"];
            //     $amount = $_POST["amount"];
            //     $ipnUrl = $_POST["ipnUrl"];
            //     $redirectUrl = $_POST["redirectUrl"];
            //     $extraData = $_POST["extraData"];

            $requestId = time() . "";
            //     $requestType = "captureWallet";
            $requestType = "payWithATM";
            //     $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                  'partnerName' => "Test",
                  "storeId" => "MomoTestStore",
                  'requestId' => $requestId,
                  'amount' => $amount,
                  'orderId' => $orderId,
                  'orderInfo' => $orderInfo,
                  'redirectUrl' => $redirectUrl,
                  'ipnUrl' => $ipnUrl,
                  'lang' => 'vi',
                  'extraData' => $extraData,
                  'requestType' => $requestType,
                  'signature' => $signature);
            //? Thêm vào bảng thanh toán 
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentDateTime = date('Y-m-d H:i:s');
            $this->thanhToanMomoModel->insertThanhToanMomo(
                        $data['partnerCode'],
                        $data['partnerName'],
                        $data['storeId'],
                        $data['requestId'],
                        $data['amount'],
                        $data['orderId'],
                        $data['orderInfo'],
                        $data['redirectUrl'],
                        $data['ipnUrl'],
                        $data['lang'],
                        $data['extraData'],
                        $data['requestType'],
                        $data['signature'],
                        $currentDateTime,
                    );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            //? tạo mã QR trong file IMG/QR/<orderID>.png
            $this->taoMaQR_OrderId($data['orderId']);

            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there
            //     header('Location: ' . $jsonResult['payUrl']);
            echo "success".$jsonResult['payUrl'];
      }
      public function binhLuan() {
            $MaPhim = $_POST['MaPhim'];
            $MaTaiKhoan = $_POST['MaTaiKhoan'];
            $NoiDung = $_POST['NoiDung'];
             
            $result = $this->binhLuanModel->insertBinhLuan($MaPhim, $MaTaiKhoan, $NoiDung,"Bình Thường");
            if($result)
                  echo "success";
            else 
                  echo "error";
      }
      public function binhLuanAnDanh() {
            $MaPhim = $_POST['MaPhim'];
            $MaTaiKhoan = $_POST['MaTaiKhoan'];
            $NoiDung = $_POST['NoiDung'];
             
            $result = $this->binhLuanModel->insertBinhLuan($MaPhim, $MaTaiKhoan, $NoiDung,"Ẩn Danh");
            if($result)
                  echo "success";
            else 
                  echo "error";
      }
}
$UserController = new UserController();
if(isset($_POST['action'])) {
      switch($_POST['action']) {
            case "thanhToan":
                  $UserController->thanhToan();
                  break;
            case "binhLuan":
                  $UserController->binhLuan();
                  break;
            case "binhLuanAnDanh":
                  $UserController->binhLuanAnDanh();
                  break;
      }
      unset($_POST['action']);
} else if(isset($_GET['ctrl'])) {
      switch($_GET['ctrl']) {
            case "movie":
                  $UserController->showMovie();
                  break;
            case "booking":
                  $UserController->showBooking();
                  break;
            case "bookedTicket":
                  $UserController->showBookedTicket();
                  break;
      }
} else {
      $UserController->showHomePage();
}