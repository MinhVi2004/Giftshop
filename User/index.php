<?php
      require (__DIR__ . "/Model/HeaderModel.php");
      session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="../IMG/Avatar/galaxy-logo.png">
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
                  <a href="index.php"><img src="../IMG/Avatar/galaxy-logo.png" alt="logo" class="img-logo"></a>
            </div>
            <div id="header-middle">
                  <ul id="header-middle-container">
                        <li>Phim</li>
                        <li>
                              <?php
                                    $headerModel = new HeaderModel();
                                    $listTypePhim = $headerModel->getAllLoaiPhim();
                              ?>
                              <div class="hover-area">
                                    Thể loại
                                    <ul class="dropdown">
                                          <?php
                                                foreach($listTypePhim as $typePhim) {
                                                      echo "<li>$typePhim[TenLoaiPhim]</li>";
                                                }
                                          ?>
                                    </ul>
                              </div>
                        </li>
                        
                        <li>Rạp phim</li>
                  </ul>
            </div>
            <div id="header-right">
                  <?php
                        if(!isset($_SESSION['UserLogin'])) {
                              echo "<a href='../Account/index.php?ctrl=loginView'><h4>Đăng nhập</h4></a>";
                        } else {
                              echo "<div id='profile-options'>
                                          <img src='../IMG/Avatar/".$_SESSION['UserLogin']['AnhDaiDien']."'>
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

                        //? api Key WeatherAPI
                        $apiKey = "f644244f64734bf4a3470104241810";
                        //? Lấy địa chỉ IP của người dùng
                        $ip = file_get_contents('https://api.ipify.org');

                        //? Lấy thông tin vị trí từ IP
                        $geoData = file_get_contents("http://ip-api.com/json/$ip");
                        $geoData = json_decode($geoData, true);

                        //? Lấy tên thành phố
                        $city = substr($geoData['city'], 0, -5);
                        $city = urlencode($city);
                        if ($city) {
                              // Gọi WeatherAPI để lấy thông tin thời tiết
                              $apiUrl = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city&days=1";
                              $response = file_get_contents($apiUrl);
                              $weatherData = json_decode($response, true);
                              $weatherUrl = "http://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$city&days=1";
                              $responseRain = file_get_contents($weatherUrl);
                              $weatherDataRain = json_decode($responseRain, true);
                          
                              // Hiển thị thông tin thời tiết
                              if ($weatherData) {
                                    echo "<div id='weather-detail'>";
                                    echo "<p>Thời tiết tại:" . $weatherData['location']['name'] . "</p>";
                                    echo "<p>Nhiệt độ: " . $weatherData['current']['temp_c'] . "°C</p>";
                                    $rainChance = $weatherDataRain['forecast']['forecastday'][0]['day']['daily_chance_of_rain'];
                                    if($rainChance > 0) {
                                          echo "<p>Mưa: $rainChance%</p>";
                                    }
                                    echo "</div>";
                              } else {
                                    echo "Không thể lấy dữ liệu thời tiết!";
                              }
                        } else {
                              echo "Không thể lấy vị trí từ IP!";
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
                              <img src="../IMG/Avatar/galaxy-logo-white.png" alt="logo" class="img-logo">
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
                              <img src="../IMG/Avatar/galaxy-logo-white.png" alt="logo" class="img-logo">
                              <h3>Galaxycine.vn</h3>
                              <ul>
                                    <li>Văn Phòng Hành Chính</li>
                                    <li>Toà nhà Bitexco Nam Long, 63A Võ Văn Tần, Phường 6, Quận 3, Tp. Hồ Chí Minh, Việt Nam</li>
                              </ul>
                      </div>
      </footer>
</body>
</html>