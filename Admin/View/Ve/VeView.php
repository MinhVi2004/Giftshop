
<div id="ve-wrapper">
    <center><h2>Quản Lý Vé</h2></center>
    <div id="ve-container">
        <video id="preview" style="width: 100%; height: auto;"></video>
        <div>
                <label>Tìm kiếm theo mã đặt hàng hoặc mã vé(quét mã QR) :</label>
                <br>
                <input type="text" id="ve-search" oninput="searchVe()">
        </div>
        <div id="order-detail">
        <!-- <div class="ticket" id="ticket_112">
                <div class="ticket-header">
                    <center><h1>GalaxyCine</h1></center>
                </div>
                <p><strong>Phim : </strong>Haikyu!!: Trận Chiến Bãi Phế Liệu</p>
                <p><strong>Tuổi Yêu Cầu : </strong>13</p>
                <p><strong>Tình Trạng Vé : </strong>Đã Thanh Toán</p>
                <p><strong>Ngày Đặt Vé : </strong>2024-07-18 18:21:41</p>
                <p><strong>Phòng Chiếu : </strong>Phòng 01</p>
                <p><strong>Xuất Chiếu : </strong>09:00:00  2024-07-23</p>
                <p><strong>Loại Vé : </strong>Vé hội viên</p>
                <p><strong>Thành Tiền : </strong>70.000 VNĐ</p>
                <div class="qr-code">
                    <img src="[URL mã QR]" alt="Mã QR">
                </div>
            </div>-->
        </div>
        <div id="order-option">
            
        </div>
</div>
<!-- phải đặt <script></script> phía dưới <video></video> -->
<script>
    // Tạo đối tượng Scanner
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    // Lấy danh sách camera
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            // Bắt đầu quét từ camera đầu tiên
            console.log("Bắt đầu quét");
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error('Error getting cameras: ', e);
    });
    // Lắng nghe sự kiện quét thành công
    scanner.addListener('scan', function (content) {
        playSound('success');
        let search_ve = document.getElementById('ve-search');
        search_ve.value = content;
        // Tạm dừng trình quét sau khi quét thành công
        scanner.stop();
        // thực hiện hàm searchVe
        var event = new Event('input', {
            'bubbles': true,
            'cancelable': true
        });
        // Thực thi hoạt động
        search_ve.dispatchEvent(event);
        // Sau khi xử lý xong thông tin mã QR
        scanner.start();

    });
</script>