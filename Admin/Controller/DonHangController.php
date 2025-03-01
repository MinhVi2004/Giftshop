<?php
require (__DIR__ . "/../Model/DonHangModel.php");
require (__DIR__ . "/../Model/ThongBaoModel.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require (__DIR__ . "/../../Lib/PHPMailer-master/src/Exception.php");
require (__DIR__ . "/../../Lib/PHPMailer-master/src/PHPMailer.php");
require (__DIR__ . "/../../Lib/PHPMailer-master/src/SMTP.php");
require (__DIR__ . "/../../Lib/phpqrcode-2010100721_1.1.4/phpqrcode/qrlib.php");
class DonHangController {
      private $DonHangModel;
      private $ThongBaoModel;

      public function __construct() {
            $this->DonHangModel = new DonHangModel();
            $this->ThongBaoModel = new ThongBaoModel();
      }
      public function showDonHangView() {
            $listDonHang = $this->DonHangModel->getAll();
            require(__DIR__."/../View/DonHangView.php");
      }
      public function filterDonHang() {
            $status = isset($_POST['status']) ? $_POST['status'] : "";
        
            if ($status == "") {
                $listDonHang = $this->DonHangModel->getAll();
            } else {
                $listDonHang = $this->DonHangModel->getAllByTrangThai($status);
            }
            $i = 1;
            if(isset($listDonHang))
                  foreach ($listDonHang as $donHang) {
                        echo "<tr>";
                        echo "<td class='DonHang-stt'>$i</td>";
                        echo "<td class='DonHang-hoten'>$donHang[MaDH]</td>";
                        echo "<td class='DonHang-ngaytao'>$donHang[NgayDatHang]</td>";
                        echo "<td class='DonHang-ngaytao'>".number_format($donHang['TongGiaTri'], 0, ',', '.')." đ</td>";
                        echo "<td class='DonHang-ngaytao'>".number_format($donHang['TienGiamGia'], 0, ',', '.')." đ</td>";
                        echo "<td class='DonHang-ngaytao'>".number_format($donHang['TongThanhToan'], 0, ',', '.')." đ</td>";
                  
                        switch ($donHang['TrangThaiDH']) {
                              case 'Chưa Xác Nhận':
                                    echo '<td class="DonHang-trangthai" style="color:orange">'.$donHang["TrangThaiDH"].'</td>';
                                    break;
                              case 'Đã Xác Nhận':
                                    echo '<td class="DonHang-trangthai" style="color:blue">'.$donHang["TrangThaiDH"].'</td>';
                                    break;
                              case 'Hoàn Thành':
                                    echo '<td class="DonHang-trangthai" style="color:green;">'.$donHang["TrangThaiDH"].'</td>';
                                    break;
                              case 'Hủy':
                                    echo '<td class="DonHang-trangthai" style="color:red;">'.$donHang["TrangThaiDH"].'</td>';
                                    break;
                              default:
                                    echo '<td class="DonHang-trangthai">'.$donHang["TrangThaiDH"].'</td>';
                                    break;
                        }
                  
                        echo "
                        <td class='DonHang-thaotac'>
                              <button class='DonHang-chitiet' onclick='openChiTietDonHang(\"".$donHang['MaDH']."\", \"".$donHang['MaTK']."\")'>Chi Tiết</button>
                        </td>";
                        echo "</tr>";
                        $i++;
                  }
        }
        
      public function getDonHangByMaDH() {
            $MaDH = $_POST['MaDH'];
        
            $donHang = $this->DonHangModel->getThongTinDonHang($MaDH);
            $chiTietDonHang = $this->DonHangModel->getChiTietDonHang($MaDH);
            $khuyenMai = $this->DonHangModel->getKhuyenMaiDonHang($MaDH);
            $diaChi = $this->DonHangModel->getDiaChiDonHang($MaDH);
        
            if ($donHang && $chiTietDonHang && $diaChi) {
                echo json_encode([
                    'status' => 'success',
                    'donHang' => $donHang,
                    'chiTietDonHang' => $chiTietDonHang,
                    'khuyenMai' => $khuyenMai,
                    'diaChi' => $diaChi
                ]);
            } else {
                echo json_encode(['status' => 'error', 'data' => []]);
            }
      }
      public function guiEmail($MaDH, $email, $Hoten, $TrangThaiDH) {
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
                  $mail->setFrom('giftshop@cine.com', 'GiftShop'); // Địa chỉ email và tên người gửi
                  $mail->addAddress($email, $Hoten); // Địa chỉ mail và tên người nhận

                  //Content
                  $mail->isHTML(true); // Set email format to HTML
                  $mail->Subject = 'Thông báo cập nhập đơn hàng'; // Tiêu đề
                  $mail->Body = '<div style="font-family: Arial, sans-serif; line-height: 1.6;"><h2>' . $thongBao . '</h2></div>';
                  
                  $chiTietDonHang = $this->DonHangModel->getChiTietDonHang($MaDH);
                  $mail->Body .= '<div id="adminOrderDetail-listSanPham" style="max-height: 50vh; overflow-y: auto; font-family: Arial, sans-serif;">
    <div class="adminOrderDetail-item" style="display: flex; padding: 10px; border-bottom: 1px solid #ddd; background: #fff;">
        <div class="adminOrderDetail-item-img" style="flex: 1; font-size: 22px; text-align: center; padding-top: 10px; font-weight: bold; margin-bottom: 5px;">Sản Phẩm</div>
        <div class="adminOrderDetail-item-name" style="flex: 2; padding-top: 10px; font-size: 20px; font-weight: bold; margin-bottom: 5px;"></div>
        <div class="adminOrderDetail-item-price" style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 17px; color: #e74c3c; font-weight: bold;">Đơn Giá</div>
        <div class="adminOrderDetail-item-quantity-change" style="flex: 1; font-size:20px; display: flex; align-items: center; justify-content: center; gap: 5px; margin-right: 15px;">Số Lượng</div>
        <div class="adminOrderDetail-item-total-price" style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 17px; color: #e74c3c; font-weight: bold;"><p>Thành Tiền</p></div>
        <div class="adminOrderDetail-item-remove" style="flex: 1; display: flex; align-items: center; padding-bottom: 5px;"></div>
    </div>';
                    foreach ($chiTietDonHang as $c) {
                        $mail->Body .= '
    <div class="adminOrderDetail-item" style="display: flex; padding: 10px; border-bottom: 1px solid #ddd; background: #fff;">
        <div class="adminOrderDetail-item-img" style="flex: 1; text-align: center;">
            <img src="'.$c['AnhSP'].'" alt="Ảnh Sản Phẩm" style="max-width: 70px;">
        </div>
        <div class="adminOrderDetail-item-name" style="flex: 2; padding-top: 10px; font-size: 16px; font-weight: bold; margin-bottom: 5px;">
            <p>'.$c['TenSP'].'</p>
        </div>
        <div class="adminOrderDetail-item-price" style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 15px; color: #e74c3c; font-weight: bold;">
            <p>'.number_format($c['GiaLucMua'], 0, ',', '.').' đ</p>
        </div>
        <div class="adminOrderDetail-item-quantity-change" style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 5px; margin-right: 15px;">
            <span style="font-size:17px;">'.$c['SoLuong'].'</span>
        </div>
        <div class="adminOrderDetail-item-total-price" style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 15px; color: #e74c3c; font-weight: bold;">
            <p>'.number_format($c['ThanhTien'], 0, ',', '.').' đ</p>
        </div>
    </div>';
                        }
                        $mail->Body .= '</div>';
                
                  if($mail->send())
                        echo 'success';
                  else 
                        echo 'error';
            } catch (Exception $e) {
                  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
      }
      public function capNhatDonHang() {
            $MaDH = $_POST['MaDH'];
            $MaTK = $_POST['MaTK'];
            $TrangThaiMoi = $_POST['TrangThaiMoi'];
            $User = $this->DonHangModel->getUserByMaDH($MaDH);
            if ($this->DonHangModel->capNhatTrangThaiDonHang($MaDH, $TrangThaiMoi)) {
                  if($this->ThongBaoModel->thongBaoCapNhatDH($MaTK, $TrangThaiMoi)) {
                        $this->guiEmail($MaDH, $User['Email'], $User['HoTen'], $TrangThaiMoi);
                        echo "success";
                  } else 
                        echo "error_thongBao";
            } else {
                  echo "error";
            }
      }
}
$DonHangController = new DonHangController();
if(isset($_POST['action'])) {
      switch ($_POST['action']) {
            case "getChiTietDonHang":
                  $DonHangController->getDonHangByMaDH();
                  break;
            case "updateTrangThaiDonHang":
                  $DonHangController->capNhatDonHang();
                  break;
            case "filter_DonHang":
                  $DonHangController->filterDonHang();
                  break;
            default:
                  break;
      }
} else {
      $DonHangController->showDonHangView();
}
