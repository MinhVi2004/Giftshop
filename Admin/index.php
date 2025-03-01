<?php
      session_start();
      if(isset($_SESSION['GiftShopUser'])) {
            if($_SESSION['GiftShopUser']['PhanQuyen'] == "Khách Hàng") {
                  echo "<script>alert('Bạn không đủ quyền đăng nhập !'); window.location.href = '../Account/index.php?ctrl=loginView';</script>";
                  exit();
            }
      } else {
            echo "<script>alert('Bạn phải đăng nhập !'); window.location.href = '../Account/index.php?ctrl=loginView';</script>";
            exit();
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="../IMG/Web/logo_square.png">
      <link rel="stylesheet" href="Css/style.css">
      <link rel="stylesheet" href="Css/TaiKhoan.css">
      <link rel="stylesheet" href="Css/SanPham.css">
      <link rel="stylesheet" href="Css/LoaiSanPham.css">
      <link rel="stylesheet" href="Css/KhuyenMai.css">
      <link rel="stylesheet" href="Css/DonHang.css">
      <link rel="stylesheet" href="Css/ThongBao.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <!-- <link href="../Lib/bootstrap-5.2.3-dist/css/bootstrap.min.css" rel="stylesheet"> -->
      <title>Gift Shop</title>
</head>
<body>
      <header>
            <div id="header-left">
                  <a href="../index.php"><img src="../IMG/Web/logo_big.png" alt="logo" class="img-logo"></a>
            </div>
            <div id="header-middle">
                  <h2>Quản Lý Gift Shop</h2>
            </div>
            <div id="header-right">
                  <?php
                        if(!isset($_SESSION['GiftShopUser'])) {
                              echo "<a href='../Account/index.php?ctrl=loginView'><h4>Đăng nhập</h4></a>";
                        } else {
                              echo "<div id='profile-options'>
                                          <img src='../IMG/Avatar/user-default.png'>
                                          <h3>".$_SESSION['GiftShopUser']['HoTen']." <i class='fa-solid fa-caret-down'></i></h3>
                                          <div id='float-options'>
                                                <button id='profile-order' onclick='window.location.href=\"../index.php?ctrl=orderView\"'>Đơn Mua</button>
                                                <button id='profile-address' onclick='window.location.href=\"../index.php?ctrl=addressDetailView\"'>Địa Chỉ Giao Hàng</button>
                                                <button id='profile-detail' onclick='window.location.href=\"../index.php?ctrl=updateProfileView\"'>Thông tin tài khoản</button>
                                                <button id='logout-submit' onclick='logout()'>Đăng xuất</button>
                                          </div>
                                    </div>";
                              echo '<a href="../index.php" id="homePage-btn"><h4>Trang Chủ</h4></a>';
                        }
                  ?>
            </div>
      </header>
      <main>
            <div id="main-left">
                  <button type="button" id="menu-toggle">
                        <i class="fa-solid fa-bars"></i> <!-- Icon menu -->
                  </button>
                  <ul id="navigation">
                        <li><a href='index.php?ctrl=DonHang'>
                              <span><i class="fa-regular fa-clipboard"></i></span>
                              <span>Đơn Hàng</span></a>
                        </li>
                        <li><a href='index.php?ctrl=KhachHang' >
                              <span><i class="fa-regular fa-user"></i></span>
                              <span>Khách Hàng</span></a>
                        </li>
                        <li><a href='index.php?ctrl=LoaiSanPham'>
                              <span><i class="fa-solid fa-tag"></i></span>
                              <span>Loại Sản Phẩm</span></a>
                        </li>
                        <li><a href='index.php?ctrl=SanPham'>
                              <span><i class="fa-solid fa-gift"></i></span>
                              <span>Sản Phẩm</span></a>
                        </li>
                        <li><a href='index.php?ctrl=ThongBao'>
                              <span><i class="fa-regular fa-bell"></i></span>
                              <span>Thông Báo</span></a>
                        </li>
                        <li><a href='index.php?ctrl=KhuyenMai'>
                              <span><i class="fa-solid fa-ticket"></i></span>
                              <span>Khuyến Mãi</span></a>
                        </li>
                  </ul>
            </div>
            <div id="main-right">
                  <?php
                        require("Controller/AdminController.php");
                  ?>
            </div>
      </main>
      <div id="customalert">
      </div>
      <div id="customConfirm" class="confirm-box" style="display: none;">
      <div class="confirm-content">
            <p id="confirmMessage">Bạn có chắc chắn?</p>
            <button id="confirmYes">Đồng ý</button>
            <button id="confirmNo">Hủy</button>
      </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


      <script src="Js/Admin.js"></script>
      <script src="Js/TaiKhoan.js"></script>
      <script src="Js/SanPham.js"></script>
      <script src="Js/LoaiSanPham.js"></script>
      <script src="Js/KhuyenMai.js"></script>
      <script src="Js/DonHang.js"></script>
      <script src="Js/ThongBao.js"></script>
</body>
</html>