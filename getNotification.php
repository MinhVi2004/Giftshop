<?php
session_start();

if (!isset($_SESSION['GiftShopUser'])) {
    echo json_encode(["unread_count" => 0, "html" => "<div class='notify-item'><h3 class='notify-item-title'>Không có thông báo.</h3></div>"]);
    exit;
}

require("Model/HeaderModel.php");
$HeaderModel = new HeaderModel();
$MaTK = $_SESSION['GiftShopUser']['MaTK'];
if(isset($_POST['action']) &&  $_POST['action'] == "markAsRead") {
    $MaTB = $_POST['MaTB'];
    if($HeaderModel->daDocNotification($MaTB)) {
        echo json_encode(["status" => "success"]);
        exit();
    }
}
$notifications = $HeaderModel->getNotification($MaTK); // Hàm này lấy thông báo từ UserController.php
$unreadCount = 0;
$itemGioHang = $HeaderModel->getQuantityGioHangByMyTK($MaTK);
$html = "";
if (empty($notifications)) {
    $html .= "<div class='notify-item'>
                  <h3 class='notify-item-title'>Không có thông báo.</h3>
            </div>";
} else {
    foreach ($notifications as $notify) {
        if($notify['DaDoc'] == "Chưa Đọc") {
            $unreadCount++;
        }
        $statusClass = $notify['DaDoc'] == "Chưa Đọc" ? "unread" : "";
        $html.= "<div class='notify-item $statusClass' data-id='{$notify['MaTB']}' onmouseover='markAsRead(this)'>
                    <h3 class='notify-item-time'>{$notify['NgayThongBao']}</h3>
                    <h3 class='notify-item-title'>{$notify['TieuDe']}</h3>
                    <p class='notify-item-content'>{$notify['NoiDung']}</p>
                </div>";
    }
}
echo json_encode(["unread_count" => $unreadCount, "quantity_giohang" => $itemGioHang, "html" => $html]);
?>
