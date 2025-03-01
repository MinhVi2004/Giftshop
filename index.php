<?php
      session_start();
      require("Model/HeaderModel.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="IMG/Web/logo_square.png">
      <!-- <link rel="stylesheet" href="Css/booking.css">
      <link rel="stylesheet" href="Css/homePage.css">
      <link rel="stylesheet" href="Css/movie.css">
      <link rel="stylesheet" href="Css/bookedTicket.css"> -->
      <link rel="stylesheet" href="Css/style.css">
      <link rel="stylesheet" href="Css/homePage.css">
      <link rel="stylesheet" href="Css/addition.css">
      <link rel="stylesheet" href="Css/giohang.css">
      <link rel="stylesheet" href="Css/thanhtoan.css">
      <link rel="stylesheet" href="Css/orderStyle.css">
      <link rel="stylesheet" href="Css/orderDetail.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <!-- <link href="Lib/bootstrap-5.2.3-dist/css/bootstrap.min.css" rel="stylesheet"> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="Js/UserJs.js"></script>
      <script src="Js/GioHang.js"></script>
      <script src="Js/ThanhToan.js"></script>
      <title>Gift Shop</title>
</head>
<body>
      <header>
            <!-- <div id="header-left">
                  <ul id="header-left-container">
                        <li>
                              <div class="hover-area">
                                    Thể Loại
                                    <ul class="dropdown">
                                          <?php
                                                $headerModel = new HeaderModel();
                                                $listLoaiSP = $headerModel->getAllLoaiSP();
                                                if(isset($listLoaiSP))
                                                foreach($listLoaiSP as $loaiSP) {
                                                      echo "<li onclick='chuyenHuongTrang(\"theloai\", \"$loaiSP[TenLoaiSP]\")'>$loaiSP[TenLoaiSP]</li>";
                                                }
                                          ?>
                                    </ul>
                              </div>
                        </li>
                        <li>Xu Hướng</li>
                  </ul>
            </div> -->
            <div id="header-left">
                  <!-- Nút mở menu trên điện thoại -->
                  <button id="menu-toggle" onclick="toggleMenu()">☰</button>

                  <!-- Danh sách menu -->
                  <nav id="menu">
                        <ul id="header-left-container">
                        <li class="hover-wrapper">
                              <div class="hover-area">
                                    Thể Loại
                              </div>
                              <ul class="dropdown">
                                    <?php
                                    $headerModel = new HeaderModel();
                                    $listLoaiSP = $headerModel->getAllLoaiSP();
                                    if(isset($listLoaiSP))
                                    foreach($listLoaiSP as $loaiSP) {
                                          echo "<li onclick='chuyenHuongTrang(\"theloai\", \"$loaiSP[TenLoaiSP]\")'>$loaiSP[TenLoaiSP]</li>";
                                    }
                                    ?>
                                    </ul>
                        </li>
                        <li>Xu Hướng</li>
                        </ul>
                  </nav>
            </div>

            <div id="header-middle">
                  <a href="index.php">
                        <img src="IMG/Web/logo_big.png" alt="logo-big" class="img-logo">
                  </a>
            </div>
                  <?php
                        if(!isset($_SESSION['GiftShopUser'])) {
                              echo "<div id='header-right'><a href='Account/index.php?ctrl=loginView'><h4>Đăng nhập</h4></a>";
                        } else {
                              echo "<div id='header-right'>
                              <div id='profile-options'>
                                          <img src='IMG/Avatar/user-default.png'>
                                          <h3>".$_SESSION['GiftShopUser']['HoTen']." <i class='fa-solid fa-caret-down'></i></h3>
                                          <div id='float-options'>
                                                <button id='profile-order' onclick='window.location.href=\"index.php?ctrl=orderView\"'>Đơn Mua</button>
                                                <button id='profile-address' onclick='window.location.href=\"index.php?ctrl=addressDetailView\"'>Địa Chỉ Giao Hàng</button>
                                                <button id='profile-detail' onclick='window.location.href=\"index.php?ctrl=updateProfileView\"'>Tài Khoản</button>
                                                <button id='logout-submit' onclick='logout()'>Đăng xuất</button>
                                          </div>
                                    </div>";
                        }
                        echo '<button style="border:none; position:relative; margin-right:15px;">
                                    <i class="fa-solid fa-cart-shopping"  id="cart-btn" onclick="window.location.href=\'index.php?ctrl=cartView\'"></i>
                                    <span id="cart-count" class="cart-badge">0</span>
                        </button>';
                        echo '<div class="notify-dropdown">
                                    <button class="notify-dropdown-button" type="button" onclick="toggleDropdown()">
                                          <i class="fa-solid fa-bell"></i>
                                          <span id="notification-count" class="badge">0</span>
                                    </button>
                                    <div class="notify-dropdown-content" id="notify-dropdownContent">
                                          
                                    </div>
                              </div>';
                        if(isset($_SESSION['GiftShopUser']) && $_SESSION['GiftShopUser']['PhanQuyen'] == "Quản Lý") {
                              echo '<i class="fa-solid fa-gear" id="admin-btn" onclick="window.location.href=\'Admin/index.php?ctrl=KhachHang\'"></i>
            </div>';
                        }

                        // //? api Key WeatherAPI
                        // $apiKey = "f03d0d69af844439a0c91630242612";
                        // //? Lấy địa chỉ IP của người dùng
                        // // $ip = file_get_contents('https://api.ipify.org');
                        // $ip = "171.246.107.8";//Hồ Chí Minh City

                        // //? Lấy thông tin vị trí từ IP
                        // $geoData = file_get_contents("http://ip-api.com/json/$ip");
                        // $geoData = json_decode($geoData, true);

                        // //? Lấy tên thành phố
                        // $city = substr($geoData['city'], 0, -5);
                        // $city = urlencode($city);
                        // if ($city) {
                        //       // Gọi WeatherAPI để lấy thông tin thời tiết
                        //       $apiUrl = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city&days=1";
                        //       $response = file_get_contents($apiUrl);
                        //       $weatherData = json_decode($response, true);
                        //       $weatherUrl = "http://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$city&days=1";
                        //       $responseRain = file_get_contents($weatherUrl);
                        //       $weatherDataRain = json_decode($responseRain, true);
                          
                        //       // Hiển thị thông tin thời tiết
                        //       if ($weatherData) {
                        //             echo "<div id='weather-detail'>";
                        //             echo "<p><i class='fa-solid fa-map-location-dot'></i>:" . $weatherData['location']['name'] . "</p>";
                        //             echo "<p><i class='fa-solid fa-temperature-three-quarters'></i>: " . $weatherData['current']['temp_c'] . "°C</p>";
                        //             $rainChance = $weatherDataRain['forecast']['forecastday'][0]['day']['daily_chance_of_rain'];
                        //             if($rainChance > 0) {
                        //                   echo "<p>Mưa: $rainChance%</p>";
                        //             }
                        //             echo "</div>";
                        //       } else {
                        //             echo "Không thể lấy dữ liệu thời tiết!";
                        //       }
                        // } else {
                        //       echo "Không thể lấy vị trí từ IP!";
                        // }
                  ?>
      </header>
      <div id="customalert">
      </div>
      <div id="messenger-floating">
            <a href="https://m.me/duog.dai.quy.21/"><i class="fa-brands fa-facebook-messenger"></i></a>
      </div>
      <div id="customConfirm" class="confirm-box" style="display: none;">
            <div class="confirm-content">
                  <p id="confirmMessage">Bạn có chắc chắn?</p>
                  <button id="confirmYes">Đồng ý</button>
                  <button id="confirmNo">Hủy</button>
            </div>
      </div>
      <div id="modal" style="display:none;">
      </div>
      <main>
            <?php
                  require("Controller/UserController.php");
            ?>
      </main>
      <div id="footer">
                <div id="footer1">
                      <div id="footer-info">
                            <ul>
                                  <li><img src="IMG/Web/logo_big.png" alt=""></li>
                                  <li>TP.Hồ Chí Minh : Tân Xuân, Hóc Môn, Tp.Hồ Chí Minh</li>
                            </ul>
                      </div>
                      <div id="footer-link">
                            <h3>LIÊN KẾT TRANG WEB</h3>
                            <ul>
                                  <li><a href="#" class="link">Bộ sưu tập</a></li>
                                  <li><a href="index.php?ctrl=cartView" class="link" >Theo dõi đơn hàng</a></li>
                            </ul>
                      </div>
                      <div id="footer-about">
                            <h3>POTICO.vn</h3>
                            <ul>
                                  <li>Văn Phòng Hành Chính</li>
                                  <li>TP.Hồ Chí Minh : Tân Xuân, Hóc Môn, Tp.Hồ Chí Minh</li>
                            </ul>
                      </div>
                </div>
                <div id="footer2">
                      <div id="footer2-left"><i class="fa-regular fa-copyright fa-s"></i>Công Ty TNHH GiftShop</div>
                      <div></div>
                      <div id="footer2-right">
                            <div id="social-icon">
                                  <i class="fa-brands fa-square-facebook fa-2xl icon"></i>
                                  <i class="fa-brands fa-instagram fa-2xl icon"></i>
                                  <i class="fa-brands fa-tiktok fa-2xl icon"></i>
                                  <i class="fa-brands fa-youtube fa-2xl icon"></i>
                                  <i class="fa-brands fa-pinterest fa-2xl icon"></i>
                                  <i class="fa-brands fa-linkedin fa-2xl icon"></i>
                            </div>
                            <div><img src="https://potico.vn/storage/assets/images/others/logoSaleNoti.png" alt="" style="width: 250px;margin-top: 15px;"></div>
                      </div>
                </div>
      </div>
</body>
</html>