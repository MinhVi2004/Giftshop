<?php
      session_start();
      if(isset($_SESSION['UserLogin'])) {
            if($_SESSION['UserLogin']['VaiTro'] == "Khách Hàng") {
                  echo "<script>alert('Bạn không đủ quyền đăng nhập !')</script>";
                  exit();
            }
      } else {
            echo "<script>alert('Bạn không đủ quyền đăng nhập !')</script>";
            exit();
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="../IMG/galaxy-logo.png">
      <link rel="stylesheet" href="Css/style.css">
      <link rel="stylesheet" href="Css/Phim.css">
      <link rel="stylesheet" href="Css/NguoiDung.css">
      <link rel="stylesheet" href="Css/PhanQuyen.css">
      <link rel="stylesheet" href="Css/PhongChieu.css">
      <link rel="stylesheet" href="Css/LichChieu.css">
      <link rel="stylesheet" href="Css/Ve.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

      <!-- quét mã QR vé -->
      <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
      
      <script src="Js/Admin.js"></script>
      <script src="Js/Phim.js"></script>
      <script src="Js/NguoiDung.js"></script>
      <script src="Js/PhanQuyen.js"></script>
      <script src="Js/PhongChieu.js"></script>
      <script src="Js/LichChieu.js"></script>
      <script src="Js/Ve.js"></script>
      <title>Galaxy Cinema</title>
</head>
<body>
      <header>
            <div id="header-left">
                  <a href="../User/index.php"><img src="../IMG/galaxy-logo.png" alt="logo" class="img-logo"></a>
            </div>
            <div id="header-middle">
                  <?php
                        foreach($_SESSION['Permission'] as $quyen) {
                              echo "<a href='index.php?ctrl=$quyen'><button>$quyen</button></a>";
                        }
                  ?>
            </div>
            <div id="header-right">
                  <?php
                        if(!isset($_SESSION['UserLogin'])) {
                              echo "<a href='../Account/index.php?ctrl=loginView'><h4>Đăng nhập</h4></a>";
                        } else {
                              echo "<div id='profile-options'>
                                          <img src='../IMG/user-default.png'>
                                          <h3>".$_SESSION['UserLogin']['HoTen']."</h3>
                                          <div id='float-options'>
                                                <button id='profile-detail' onclick='window.location.href=\"../Account/index.php?ctrl=profileView\"'>Thông tin tài khoản</button>
                                                <button id='logout-submit' onclick='logout()'>Đăng xuất</button>
                                          </div>
                                    </div>";
                              echo '<a href="../User/index.php" id="homePage-btn"><h4>Trang Chủ</h4></a>';
                        }
                  ?>
            </div>
      </header>
      <main>
            <?php
                  require("Controller/AdminController.php");
            ?>
      </main>
      <footer>
                      <div id="footer-info">
                              <img src="../IMG/galaxy-logo-white.png" alt="logo" class="img-logo">
                      </div>
                      <div id="footer-link">
                            <h3>LIÊN KẾT TRANG WEB</h3>
                            <ul>
                                  <li>Bộ sưu tập</li>
                                  <li>Giới thiệu</li>
                                  <li>Thông tin tuyển dụng</li>
                                  <li>Blog</li>
                            </ul>
                      </div>
                      <div id="footer-service">
                            <h3>CHĂM SÓC KHÁCH HÀNG</h3>
                            <ul>
                                  <li>Liên hệ với chúng tôi</li>
                                  <li>Câu hỏi thường gặp</li>
                                  <li>Phương thức thanh toán</li>
                                  <li>Điều khoản và điều kiện</li>
                                  <li>Chính sách bảo mật</li>
                            </ul>
                      </div>
                      <div id="footer-question">
                            <h3>BẠN CÓ CÂU HỎI ?</h3>
                            <ul>
                                  <li>Điện thoại:<br>1900 63 35 37</li>
                                  <li>Thứ Hai - Chủ Nhật (8:00 - 19:00)</li>
                                  <li>Email:<br>contact@galaxy.vn</li>
                                  <li>Truyền thông và đối tác:<br>marketing@galaxy.vn</li>
                            </ul>
                      </div>
                      <div id="footer-about">
                              <img src="../IMG/galaxy-logo-white.png" alt="logo" class="img-logo">
                              <h3>Galaxycine.vn</h3>
                              <ul>
                                    <li>Văn Phòng Hành Chính</li>
                                    <li>Toà nhà Bitexco Nam Long, 63A Võ Văn Tần, Phường 6, Quận 3, Tp. Hồ Chí Minh, Việt Nam</li>
                              </ul>
                      </div>
      </footer>
</body>
</html>