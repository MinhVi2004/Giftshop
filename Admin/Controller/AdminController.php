<?php

$ctrl = "";
if(isset($_GET['ctrl'])) {
      $ctrl = $_GET['ctrl'];
}
switch ($ctrl) {
      case "KhachHang":
            require("TaiKhoanController.php");
            break;
      case "SanPham":
            require("SanPhamController.php");
            break;
      case "LoaiSanPham":
            require("LoaiSanPhamController.php");
            break;
      case "KhuyenMai":
            require("KhuyenMaiController.php");
            break;
      case "DonHang":
            require("DonHangController.php");
            break;
      case "ThongBao":
            require("ThongBaoController.php");
            break;
      
}