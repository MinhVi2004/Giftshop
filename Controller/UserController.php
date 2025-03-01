<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ? Đã khai báo trong index.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require (__DIR__ . "/../Model/UserModel.php");
require (__DIR__ . "/../Model/SanPhamModel.php");
require (__DIR__ . "/../Model/GioHangModel.php");
require (__DIR__ . "/../Model/ThanhToanModel.php");
require (__DIR__ . "/../Model/DonHangModel.php");
require (__DIR__ . "/../Lib/PHPMailer-master/src/Exception.php");
require (__DIR__ . "/../Lib/PHPMailer-master/src/PHPMailer.php");
require (__DIR__ . "/../Lib/PHPMailer-master/src/SMTP.php");
require (__DIR__ . "/../Lib/phpqrcode-2010100721_1.1.4/phpqrcode/qrlib.php");
//? Mã QR
class UserController {
      private $UserModel;
      private $SanPhamModel;
      private $GioHangModel;
      private $ThanhToanModel;
      private $DonHangModel;

      public function __construct() {
            $this->UserModel = new UserModel();
            $this->SanPhamModel = new SanPhamModel();
            $this->GioHangModel = new GioHangModel();
            $this->ThanhToanModel = new ThanhToanModel();
            $this->DonHangModel = new DonHangModel();
      }
      public function showHomePage() {
            if(isset($_GET['theloai'])) {
                  $listSanPham = $this->SanPhamModel->getAllByTenLoaiSP($_GET['theloai']);
            } else 
                  $listSanPham = $this->SanPhamModel->getAll();
            require(__DIR__ . "/../View/homePageView.php");
      }
      
      public function showUpdateProfile() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            require(__DIR__ . "/../View/updateProfileView.php");
      }
      public function showAddAddress() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            require(__DIR__ . "/../View/addAddressView.php");
      }
      public function showUpdateAddress() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            $diaChi = $this->UserModel->getDiaChiById($_GET['id']);
            require(__DIR__ . "/../View/updateAddressView.php");
      }
      public function showAddressDetail() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            $listDiaChi = $this->UserModel->getAllDiaChi($_SESSION['GiftShopUser']['MaTK']);
            require(__DIR__ . "/../View/addressDetailView.php");
      }
      public function showChangePassword() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            require(__DIR__ . "/../View/changePasswordView.php");
      }
      public function showCartView() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            $listGioHang = $this->GioHangModel->getAllByMATK($_SESSION['GiftShopUser']['MaTK']);
            require(__DIR__ . "/../View/cartView.php");
      }
      public function showBuyView() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            if(!$this->DonHangModel->getQuantityGioHang($_SESSION['GiftShopUser']['MaTK'])) {
                  echo "<script>customAlert('Vui lòng thêm sản phẩm vào giỏ hàng để mua hàng !');
                        setTimeout(() => {
                              window.location.href = 'index.php'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            $listGioHang = $this->GioHangModel->getAllByMaTK($_SESSION['GiftShopUser']['MaTK']);
            $listDiaChi = $this->UserModel->getAllDiaChi($_SESSION['GiftShopUser']['MaTK']);
            $listKhuyenMai = $this->ThanhToanModel->getAllKhuyenMai();
            require(__DIR__ . "/../View/buyView.php");
      }
      public function showOrderView() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            $listDonHang = $this->DonHangModel->getAll($_SESSION['GiftShopUser']['MaTK']);
            $listDetailDonHang = [];
            if(isset($listDonHang))
                  foreach($listDonHang as $donHang) {
                        $listDetailDonHang[] = $this->DonHangModel->getChiTietDonHang($donHang['MaDH']); 
                  }
            require(__DIR__ . "/../View/orderView.php");
      }
      public function showOrderDetailView() {
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "<script>customAlert('Bạn phải đăng nhập !');
                        setTimeout(() => {
                              window.location.href = 'Account/index.php?ctrl=loginView'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            if(!isset($_GET['id'])) {
                  echo "<script>customAlert('Không tìm thấy đơn hàng !');
                        setTimeout(() => {
                              window.location.href = 'index.php'
                        }, 1000); // 1000 ms = 1 giây
                        </script>";
                  exit();
            }
            $MaDH = $_GET['id'];
            $donHang = $this->DonHangModel->getThongTinDonHang($MaDH);
            $chiTietDonHang = $this->DonHangModel->getChiTietDonHang($MaDH);
            $khuyenMai = $this->DonHangModel->getKhuyenMaiDonHang($MaDH);
            $diaChi = $this->DonHangModel->getDiaChiDonHang($MaDH);
            require(__DIR__ . "/../View/orderDetailView.php");
      }
      public function suaTaiKhoan() {
            session_start();
            $MaTK = $_SESSION['GiftShopUser']['MaTK'];
            $HoTen = $_POST['HoTen'];
            $SoDienThoai = $_POST['SoDienThoai'];
            $Email = $_POST['Email'];
            $errors = [];
            if (!$this->UserModel->checkExistEmailUpdate($MaTK, $Email)) {
                $errors[] = 'email_exist';
            }


            if (!empty($errors)) {
                echo json_encode($errors);
                return;
            }

            try {
                  $result = $this->UserModel->updateAccount($MaTK, $HoTen, $SoDienThoai, $Email);
                  if ($result) {
                        $_SESSION['GiftShopUser'] = $this->UserModel->getAccountById($MaTK);
                        echo 'success';
                  } else {
                        echo 'error';
                  }
            } catch (mysqli_sql_exception $e) {
                echo 'lỗi' . $e->getMessage() ;
            }
      }
      public function themDiaChi() {
            $MaTK = $_POST['MaTK'];
            $HoTen = $_POST['HoTen'];
            $TinhThanh = $_POST['TinhThanh'];
            $QuanHuyen = $_POST['QuanHuyen'];
            $PhuongXa = $_POST['PhuongXa'];
            $DiaChi = $_POST['DiaChi'];
            $SoDienThoai = $_POST['SoDienThoai'];
            if($this->UserModel->createDiaChi($MaTK, $HoTen, $TinhThanh, $QuanHuyen, $PhuongXa, $DiaChi, $SoDienThoai)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function suaDiaChi() {
            $MaDC = $_POST['MaDC'];
            $HoTen = $_POST['HoTen'];
            $TinhThanh = $_POST['TinhThanh'];
            $QuanHuyen = $_POST['QuanHuyen'];
            $PhuongXa = $_POST['PhuongXa'];
            $DiaChi = $_POST['DiaChi'];
            $SoDienThoai = $_POST['SoDienThoai'];
            if($this->UserModel->updateDiaChi($MaDC, $HoTen, $TinhThanh, $QuanHuyen, $PhuongXa, $DiaChi, $SoDienThoai)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function xoaDiaChi() {
            $MaDC = $_POST['MaDC'];
            if($this->UserModel->deleteDiaChi($MaDC)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function doiMatKhau() {
            session_start();
            $MaTK = $_SESSION['GiftShopUser']['MaTK'];
            $MatKhauCu = $_POST['MatKhauCu'];
            $MatKhauMoi = $_POST['MatKhauMoi'];

            // $user = $this->UserModel->getAccountById($MaTK);

            $errors = [];
            if(!$this->UserModel->checkOldPassword($MaTK, $MatKhauCu)) {
                  $errors[] = "incorrect_oldpassword";
            }
            if (!empty($errors)) {
                  echo json_encode($errors);
                  return;
            }
            try {
                  $result = $this->UserModel->changePasswordAccount($MaTK, $MatKhauMoi);
                  if ($result) {
                        $_SESSION['GiftShopUser'] = $this->UserModel->getAccountById($MaTK);
                        echo 'success';
                  } else {
                        echo 'error';
                  }
            } catch (mysqli_sql_exception $e) {
                  echo 'lỗi' . $e->getMessage();
            }
      }
      public function themGioHang() {
            session_start();
            if(!isset($_SESSION['GiftShopUser'])) {
                  echo "error_login";
                  exit();
            }
            $MaTK = $_SESSION['GiftShopUser']['MaTK'];
            $MaSP = $_POST['MaSP'];
            $SoLuong = $_POST['SoLuong'];
            if($this->GioHangModel->themGioHang($MaTK, $MaSP, $SoLuong)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function tangSoLuongGioHang() {
            $MaTK = $_POST['MaTK'];
            $MaSP = $_POST['MaSP'];
            if($this->GioHangModel->tangSoLuongGioHang($MaTK, $MaSP)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function giamSoLuongGioHang() {
            $MaTK = $_POST['MaTK'];
            $MaSP = $_POST['MaSP'];
            if($this->GioHangModel->giamSoLuongGioHang($MaTK, $MaSP)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function xoaSanPhamGioHang() {
            $MaTK = $_POST['MaTK'];
            $MaSP = $_POST['MaSP'];
            if($this->GioHangModel->xoaSanPhamGioHang($MaTK, $MaSP)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
      public function huyDonHang() {
            session_start();
            $MaTK = $_SESSION['GiftShopUser']['MaTK'];
            $MaDH = $_POST['MaDH'];
            if($this->ThanhToanModel->capNhatTrangThaiDonHang($MaDH, "Hủy")) {
                  if($this->ThanhToanModel->thongBaoCapNhatDH($MaTK, "Hủy"))
                        echo "success";
                  else 
                        echo "error_thongbao";
            } else {
                  echo "error";
            }
      }
      public function guiEmail($email, $Hoten, $TrangThaiDH) {
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
                  $mail->addAddress($email, $Hoten); // Địa chỉ mail và tên người nhận

                  //Content
                  $mail->isHTML(true); // Set email format to HTML
                  $mail->Subject = 'Thông báo cập nhập đơn hàng'; // Tiêu đề
                  $mail->Body = $thongBao; // Nội dung;
                  
                  if($mail->send()) {
                        echo 'success';
                        exit;  // Đảm bảo không có dữ liệu rác nào khác
                  } else {
                        echo 'error';
                        exit;
                  }   
            } catch (Exception $e) {
                  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
      }
      public function datHang() {
            session_start();
            $MaTK = $_SESSION['GiftShopUser']['MaTK'];
            $MaDC = $_POST['MaDC'];
            $MaKM = (isset($_POST['MaKM']) || $_POST['MaKM'] !== "") ? $_POST['MaKM'] : NULL;
            $TongGiaTri = $_POST['TongGiaTri'];
            $TienGiamGia = $_POST['TienGiamGia'];
            $TongThanhToan = $_POST['TongThanhToan'];
            if($this->ThanhToanModel->themDonHang($MaKM, $MaTK, $MaDC, $TongGiaTri, $TienGiamGia, $TongThanhToan)) {
                  if($this->ThanhToanModel->thongBaoCapNhatDH($MaTK, "Chưa Xác Nhận")){
                        $this->guiEmail($_SESSION['GiftShopUser']['Email'], $_SESSION['GiftShopUser']['HoTen'], "Chưa Xác Nhận");
                        echo "success";
                  }
                  else 
                        echo "error_thongbao";
            } else {
                  echo "error";
            }
      }
      public function getQuantityGioHang() {
            session_start();
            $MaTK = $_SESSION['GiftShopUser']['MaTK'];
            if($this->DonHangModel->getQuantityGioHang($MaTK)) {
                  echo "success";
            } else {
                  echo "error";
            }
      }
}
$UserController = new UserController();
if(isset($_POST['action'])) {
      switch($_POST['action']) {
            case "updateAccount":
                  $UserController->suaTaiKhoan();
                  break;
            case "add_Address":
                  $UserController->themDiaChi();
                  break;
            case "update_Address":
                  $UserController->suaDiaChi();
                  break;
            case "delete_Address":
                  $UserController->xoaDiaChi();
                  break;
            case "change_Password":
                  $UserController->doiMatKhau();
                  break;
            case "add_Cart":
                  $UserController->themGioHang();
                  break;
            case "decreaseItem_Cart":
                  $UserController->giamSoLuongGioHang();
                  break;
            case "increaseItem_Cart":
                  $UserController->tangSoLuongGioHang();
                  break;
            case "deleteItem_Cart":
                  $UserController->xoaSanPhamGioHang();
                  break;
            case "getQuantityGioHang":
                  $UserController->getQuantityGioHang();
                  break;
            case "huyDonHang":
                  $UserController->huyDonHang();
                  break;
            case "buy":
                  $UserController->datHang();
                  break;
      }
      unset($_POST['action']);
} else if(isset($_GET['ctrl'])) {
      switch($_GET['ctrl']) {
            case "addAddressView":
                  $UserController->showAddAddress();
                  break;
            case "updateAddressView":
                  $UserController->showUpdateAddress();
                  break;
            case "addressDetailView":
                  $UserController->showAddressDetail();
                  break;
            case "changePasswordView":
                  $UserController->showChangePassword();
                  break;
            case "updateProfileView":
                  $UserController->showUpdateProfile();
                  break;
            case "cartView":
                  $UserController->showCartView();
                  break;
            case "buyView":
                  $UserController->showBuyView();
                  break;
            case "orderView":
                  $UserController->showOrderView();
                  break;
            case "orderDetailView":
                  $UserController->showOrderDetailView();
                  break;
      }
} else {
      $UserController->showHomePage();
}