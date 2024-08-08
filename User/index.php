<?php
      session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="../IMG/galaxy-logo.png">
      <link rel="stylesheet" href="Css/booking.css">
      <link rel="stylesheet" href="Css/homePage.css">
      <link rel="stylesheet" href="Css/movie.css">
      <link rel="stylesheet" href="Css/bookedTicket.css">
      <link rel="stylesheet" href="Css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="Js/UserJs.js"></script>
      <title>Galaxy Cinema</title>
</head>
<body>
      <header>
            <div id="header-left">
                  <a href="index.php"><img src="../IMG/galaxy-logo.png" alt="logo" class="img-logo"></a>
            </div>
            <div id="header-middle">
                  <ul>
                        <li>Phim</li>
                        <li>Thể loại</li>
                        <li>Rạp phim</li>
                  </ul>
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
                        }
                        if(isset($_SESSION['Permission']) && count($_SESSION['Permission']) > 0) {
                              echo '<i class="fa-solid fa-gear" id="admin-btn" onclick="window.location.href=\'../Admin/index.php?ctrl='.$_SESSION['Permission'][0].'\'"></i>';
                        }
                  ?>
            </div>
      </header>
      <main>
            <?php
                  require("Controller/UserController.php");
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