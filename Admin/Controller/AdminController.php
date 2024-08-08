<?php

$ctrl = "";
if(isset($_GET['ctrl'])) {
      $ctrl = $_GET['ctrl'];
}
switch ($ctrl) {
      case "Phim":
            if(in_array("Phim",$_SESSION['Permission'])) {
                  require("PhimController.php");
            } else {
                  echo "<script>alert('Bạn không đủ quyền truy cập !')</script>";
                  exit();
            }
            break;
      case "Người Dùng":
            if(in_array("Người Dùng",$_SESSION['Permission'])) {
                  require("NguoiDungController.php");
            } else {
                  echo "<script>alert('Bạn không đủ quyền truy cập !')</script>";
                  exit();
            }
            break;
      case "Phân Quyền":
            if(in_array("Phân Quyền",$_SESSION['Permission'])) {
                  require("PhanQuyenController.php");
            } else {
                  echo "<script>alert('Bạn không đủ quyền truy cập !')</script>";
                  exit();
            }
            break;
      case "Lịch Chiếu":
            if(in_array("Lịch Chiếu",$_SESSION['Permission'])) {
                  require("LichChieuController.php");
            } else {
                  echo "<script>alert('Bạn không đủ quyền truy cập !')</script>";
                  exit();
            }
            break;
      case "Phòng Chiếu":
            if(in_array("Phòng Chiếu",$_SESSION['Permission'])) {
                  require("PhongChieuController.php");
            } else {
                  echo "<script>alert('Bạn không đủ quyền truy cập !')</script>";
                  exit();
            }
            break;
      case "Doanh Thu":
            if(in_array("Doanh Thu",$_SESSION['Permission'])) {
                  require("DoanhThuController.php");
            } else {
                  echo "<script>alert('Bạn không đủ quyền truy cập !')</script>";
                  exit();
            }
            break;
      case "Bình Luận":
            if(in_array("Bình Luận",$_SESSION['Permission'])) {
                  require("BinhLuanController.php");
            } else {
                  echo "<script>alert('Bạn không đủ quyền truy cập !')</script>";
                  exit();
            }
            break;
      case "Vé":
            if(in_array("Vé",$_SESSION['Permission'])) {
                  require("VeController.php");
            } else {
                  echo "<script>alert('Bạn không đủ quyền truy cập !')</script>";
                  exit();
            }
            break;
}