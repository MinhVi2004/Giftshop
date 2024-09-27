function searchVe() {
      let input = document.getElementById("ve-search").value;
      console.log(input);

      $.ajax({
            url: "Controller/VeController.php",
            method: "POST",
            data: { 
                  action : "searchVe",
                  input : input,
            },
            success : function(response){
                  if(response.match('success')) {
                        response = response.replace('success', '');
                        let data = JSON.parse(response);
                        detailOrder(data);
                        console.log(data);
                  } else if(response.match('error')) {
                        response = response.replace('error', '');
                        detailOrder(null);
                  } else {
                        console.log(response);
                        alert("Lỗi khác")
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert("Lỗi trong quá trình xử lý Ajax.");
            }
      });
}
function playSound(name) {
      var audio = new Audio('../Sound/'+name+ '_sound.mp3');
      audio.play();
}
function currencyVND(amount) {
      // Định dạng số thành chuỗi tiền tệ với Intl.NumberFormat
      let formattedAmount = new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
      minimumFractionDigits: 0 // Không hiển thị phần thập phân
      }).format(amount);
      
      // Loại bỏ ký tự đặc biệt (dấu ₫)
      formattedAmount = formattedAmount.replace('₫', '').trim();

      // Thêm "VND" vào cuối chuỗi
      formattedAmount += ' VNĐ';

      return formattedAmount;
}
function detailOrder(listTicket) {
      let orderDetail = document.getElementById("order-detail");
      let orderOption = document.getElementById("order-option");
      let stringOrderDetail = "";
      let orderId = null;
      if(listTicket === null) {
            orderDetail.innerHTML = "Không tồn tại mã đơn hàng hoặc mã vé";
            orderOption.innerHTML = "";
            return;
      }
      let trangThaiVe = "";
      listTicket.forEach(ticket => {
            stringOrderDetail += "<div class='ticket' id='ticket_"+ticket['MaVe']+"'>"+
                "<center><h1>Vé Xem Phim</h1></center>"+
                "<p><strong>Phim : </strong>"+ticket['TenPhim']+"</p>"+
                "<p><strong>Tuổi Yêu Cầu : </strong>"+ticket['TuoiYeuCau']+"</p>"+
                "<p><strong>Ngày Đặt Vé : </strong>"+ticket['NgayBanVe']+"</p>"+
                "<p><strong>Phòng Chiếu : </strong>"+ticket['TenPhongChieu']+"</p>"+
                "<p><strong>Xuất Chiếu : </strong>"+ticket['ThoiGianBatDau']+"  "+ticket['NgayChieu']+"</p>"+ /* Thời gian bắt đầu  */
                "<p><strong>Ghế : </strong>"+ticket['Ghe']+"</p>"+
                "<p><strong>Loại Vé : </strong>"+ticket['TenLoaiVe']+"</p>"+
                "<p><strong>Thành Tiền : </strong>"+currencyVND(ticket['DonGia'])+"</p>";
            if(ticket['TrangThai'] == 'Đã Thanh Toán') stringOrderDetail += "<p><strong>Tình Trạng Vé : </strong><span style='color:green;'>"+ticket['TrangThai']+"</span></p>";
            else if(ticket['TrangThai'] == 'Đã Sử Dụng') stringOrderDetail += "<p><strong>Tình Trạng Vé : </strong><span style='color:red;'>"+ticket['TrangThai']+"</span></p>"; 
            else stringOrderDetail += "<p><strong>Tình Trạng Vé : </strong><span>"+ticket['TrangThai']+"</span></p>";
            stringOrderDetail +="</div>";
            console.log(ticket['orderId']);
            orderId = ticket['orderId'];
            trangThaiVe = ticket['TrangThai'];
      });
      orderDetail.innerHTML = stringOrderDetail;
    if(trangThaiVe != "Đã Thanh Toán")
        orderOption.innerHTML = "<button onclick='printTickets("+orderId+")' id='ve-print-btn' disable>In vé</button>";
    else 
        orderOption.innerHTML = "<button onclick='printTickets("+orderId+")' id='ve-print-btn'>In vé</button>";
}
function printTickets(orderId) {
      // Cập nhật trạng thái vé
      $.ajax({
          url: "Controller/VeController.php",
          method: "POST",
          data: { 
              action: "changeTrangThaiVe",
              orderId: orderId,
              TrangThai: "Đã Sử Dụng",
          },
          success: function(response) {
              if (response === 'success') {
                console.log("Đổi trạng thái vé thành công !");
                  // Sau khi cập nhật trạng thái vé thành công, thực hiện chụp ảnh
                  html2canvas(document.getElementById('order-detail')).then(function(canvas) {
                    // Chuyển đổi canvas thành dữ liệu URL
                    let dataURL = canvas.toDataURL('image/png');
                    
                    // Gửi dữ liệu hình ảnh đến máy chủ
                    $.ajax({
                        url: "Controller/VeController.php",
                        type: "POST", // thay vì "method"
                        data: { 
                            action: "SaveTicket",
                            Image: dataURL
                        },
                        success: function(response) {
                            if (response === 'success') {
                                alert("Lưu Vé thành công");
                            } else if (response === 'error') {
                                alert("Lưu Vé thất bại");
                            } else {
                                console.log(response);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert("Lỗi trong quá trình xử lý Ajax khi lưu hình ảnh.");
                        }
                    });
                });
              } else if (response === 'error') {
                console.log("Đổi trạng thái thất bại !");
              } else {
                  console.log(response);
                  alert("Lỗi khác trong quá trình cập nhật trạng thái vé.");
              }
          },
          error: function(xhr, status, error) {
              console.error(xhr.responseText);
              alert("Lỗi trong quá trình xử lý Ajax khi cập nhật trạng thái vé.");
          }
      });
  }
  