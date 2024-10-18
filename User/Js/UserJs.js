function logout() {
      $.ajax({
            url: "../Account/Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "logout",
            },
            success : function(response){
                  console.log(response);if(response == "success") {
                        alert("Đăng xuất thành công !");
                        window.location.href='index.php'
                  } else if(response == "error"){
                        alert("Đăng xuất thất bại !");
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
function playTrailer(link) {
      let url = "https://www.youtube.com/embed/" + link;
      let trailer_modal = document.getElementById("movie-trailer-video-modal");
      trailer_modal.style.display = "flex";
      trailer_modal.style.zIndex = "10";
      trailer_modal.innerHTML = '<iframe width="900" height="500" src="' + url + '?autoplay=1&loop=1&mute=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
function closeTrailer() {
      let trailer_modal = document.getElementById("movie-trailer-video-modal");
      trailer_modal.style.display = "none";
      trailer_modal.style.zIndex = "1";
      trailer_modal.innerHTML = '';
}
function checkLogin(MaLichChieu) {
      $.ajax({
            url: "../Account/Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "checkLogin",
            },
            success : function(response){
                  if(response == "success") {
                        window.location.href="index.php?ctrl=booking&id="+MaLichChieu;
                  } else if(response == "error"){
                        window.location.href = "../Account/index.php?ctrl=loginView";
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
function muave(MaLichChieu) {
      //? Các ghế đã chọn
      let selectedSeats = [];
      let checkboxes = document.querySelectorAll('.seat-checkbox:checked');

      checkboxes.forEach(checkbox => {
            selectedSeats.push(checkbox.value);
      });
      //? Kết thúc hàm nếu không có ghế nào được chọn
      if(selectedSeats.length == 0) {
            alert("Vui lòng chọn ghế !!");
            return;
      }
      //? Chọn loại vé
      let selectedRadio = document.querySelector('.ticket-class:checked');

      if (!selectedRadio) {
            alert("Vui lòng chọn loại vé !!");
            return;
      }
      let selectedTypeTicket = selectedRadio.value;
      //? có S và không có S
      let result = true;
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "muaVe",
                  Ghe : selectedSeats,
                  LoaiVe : selectedTypeTicket,
                  MaLichChieu : MaLichChieu,
            },
            success : function(response){
                  if(response == "success") {
                        window.location.reload();
                  } else if(response == "error"){
                        result = false;
                        window.location.reload();
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
      if(result) {
            alert("Bạn đã mua thành công " + selectedSeats.length + " vé !");
      }
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
function showPrice() {
      let total = document.getElementById("booking-total-price");
      console.log("Click chọn ghế");
      let selectedRadio = document.querySelector('.ticket-class:checked');
      let checkboxes = document.querySelectorAll('.seat-checkbox:checked').length;
      if(selectedRadio == null || checkboxes == 0) {
            total.setAttribute("value", 0);
            total.innerHTML = currencyVND(0);
            return;
      }
      
      let selectedRadio1 = parseInt(selectedRadio.getAttribute('price'));
      total.setAttribute("value", checkboxes * selectedRadio1);
      total.innerHTML = currencyVND(checkboxes * selectedRadio1);
}
function thanhToan(MaLichChieu) {
      console.log("Click thanh toán");
      //? Các ghế đã chọn
      let selectedSeats = [];
      let checkboxes = document.querySelectorAll('.seat-checkbox:checked');

      checkboxes.forEach(checkbox => {
            selectedSeats.push(checkbox.value);
      });
      //? Kết thúc hàm nếu không có ghế nào được chọn
      if(selectedSeats.length == 0) {
            alert("Vui lòng chọn ghế !!");
            return;
      }
      //? Chọn loại vé
      let selectedRadio = document.querySelector('.ticket-class:checked');

      if (!selectedRadio) {
            alert("Vui lòng chọn loại vé !!");
            return;
      }
      let selectedTypeTicket = selectedRadio.value;
      //? có S và không có S
      let result = true;
      let total = document.getElementById("booking-total-price").getAttribute("value");
      console.log("Click thanh toán 1");
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "thanhToan",
                  Ghe : selectedSeats,
                  LoaiVe : selectedTypeTicket,
                  SoLuongVe : selectedSeats.length,
                  TongTien : total,
                  MaLichChieu : MaLichChieu,
            },
            success : function(response){
                  console.log("Click thanh toán 2");
                  if(response.match('success')) {
                        response = response.replace('success', '');
                        window.location.href= response;
                        console.log(response);
                        console.log("Click thanh toán 4");
                  } else if(response == "error"){
                        result = false;
                        window.location.reload();
                        console.log("Click thanh toán 5");
                  } else {
                        console.log(response);
                        alert("Lỗi khác")
                        console.log("Click thanh toán 6");
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert("Lỗi trong quá trình xử lý Ajax.");
            }
      });
      console.log("Click thanh toán 3");
}
function binhLuan(MaPhim, MaTaiKhoan) {
      let cmt = document.getElementById("movie-binhluan-box").value;
      let anDanh = document.getElementById("movie-binhluan-andanh")
      if(cmt == "") {
            return;
      }
      console.log(cmt);
      cmt = cmt.trim();
      let action = (anDanh.checked)?"binhLuanAnDanh":"binhLuan";
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : action,
                  NoiDung : cmt,
                  MaPhim : MaPhim,
                  MaTaiKhoan : MaTaiKhoan
            },
            success : function(response){
                  console.log("Gửi bình luận");
                  if(response.match('success')) {
                        alert("Bạn bình luận thành công !");
                        window.location.reload();
                  } else if(response.match('error')){
                        alert("Bạn bình luận thất bại !");
                        console.log(response);
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
function loginBeforeComment() {
      if(confirm("Vui lòng đăng nhập để bình luận !")) 
            window.location.href="../Account/index.php?ctrl=loginView";
}