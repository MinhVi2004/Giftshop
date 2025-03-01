
async function khoiPhucMatKhau(MaTK) {
      if(! await customConfirm("Bạn có chắc muốn khôi phục mật khẩu tài khoản này ?")) {
            return
      }
      $.ajax({
            url: "Controller/TaiKhoanController.php",
            method: "POST",
            data: { 
                  action : "khoiPhucMatKhau",
                  MaTK : MaTK,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Khôi phục mật khẩu của người dùng thành công về \"123456\" !", "success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Khôi phục mật khẩu của người dùng thất bại !");
                  } else {
                        console.log(response);
                        customAlert("Lỗi khác")
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
            }
      });
      
}
async function suaTaiKhoan(MaTK) {
      if(! await customConfirm("Bạn có chắc muốn sửa tài khoản này ?")) {
            return
      }
      let trangthai = document.getElementById('chiTietTaiKhoan-trangthai').value
      $.ajax({
            url: "Controller/TaiKhoanController.php",
            method: "POST",
            data: { 
                  action : "suaTaiKhoan",
                  MaTK : MaTK,
                  TrangThai : trangthai,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Sửa tài khoản thành công !", "success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Sửa tài khoản thất bại !");
                  } else {
                        console.log(response);
                        customAlert("Lỗi khác")
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
            }
      });
}
function openChiTietTaiKhoan(MaTK) {
      $.ajax({
            url: "Controller/TaiKhoanController.php",
            method: "POST",
            data: { 
                  action : "getTaiKhoanByMaTK",
                  MaTK : MaTK,
            },
            success : function(response){
                  console.log(response);
                  let data = JSON.parse(response);
                  if (data.status === "success") {
                        // Lặp qua dữ liệu và thêm vào bảng
                        let user = data.data;
                        let modal = document.getElementById("modal-chiTietTaiKhoan");
                        modal.style.display = 'block';
                        let chiTietTaiKhoanTemp = '<div id="chiTietTaiKhoan">'+
                              '<button id="closeChiTietTaiKhoan" onclick="closeChiTietTaiKhoan()" type="button"><i class="fa-solid fa-xmark"></i></button>'+
                              '<h2>Tài Khoản</h2>'+
                              '<center><img src="../IMG/Avatar/user-default.png"></center>'+
                              '<h4> - Mã Tài Khoản </h4>'+
                              '<p>'+user['MaTK']+'</p>'+
                              '<h4> - Họ Tên</h4>'+
                              '<p>'+user['HoTen']+'</p>'+
                              '<h4> - Tuổi</h4>'+
                              '<p>'+user['Tuoi']+'</p>'+
                              '<h4> - Số Điện thoại</h4>'+
                              '<p>'+user['SoDienThoai']+'</p>'+
                              '<h4> - Email</h4>'+
                              '<p>'+user['Email']+'</p>'+
                              '<h4> - Địa Chỉ</h4>'+
                              '<p>'+user['DiaChi']+'</p>'+
                              '<h4> - Ngày Đăng Ký</h4>'+
                              '<p>'+user['NgayTao']+'</p>';
                              if(user['TrangThai'] == "Bình Thường") {
                                    chiTietTaiKhoanTemp += 
                                    '<h4> - Trạng Thái</h4>'+
                                    '<select name="chiTietTaiKhoan-trangthai" id="chiTietTaiKhoan-trangthai">'+
                                          '<option value="Bình Thường" selected>Bình Thường</option>'+
                                          '<option value="Vô Hiệu Hóa">Vô Hiệu Hóa</option>'+
                                    '</select>'
                              } else {
                                    chiTietTaiKhoanTemp += 
                                    '<h4>Trạng Thái</h4>'+
                                    '<select name="chiTietTaiKhoan-trangthai" id="chiTietTaiKhoan-trangthai">'+
                                          '<option value="Bình Thường">Bình Thường</option>'+
                                          '<option value="Vô Hiệu Hóa" selected>Vô Hiệu Hóa</option>'+
                                    '</select>'
                              }
                        chiTietTaiKhoanTemp += '<div id="chiTietTaiKhoan-thaotac">'+
                                    '<button id="chiTietTaiKhoan-sua" onclick="suaTaiKhoan(\''+user['MaTK']+'\')">Sửa</button>';
                        if(user['TenDangNhap'] != "") {
                              chiTietTaiKhoanTemp += '<button id="chiTietTaiKhoan-khoiPhucMatKhau" onclick=\'khoiPhucMatKhau("'+user['MaTK']+'")\'>Khôi Phục Mật Khẩu</button>';
                        }
                                    
                        chiTietTaiKhoanTemp +=   '</div>'+
                        '</div>';
                        modal.innerHTML = chiTietTaiKhoanTemp;
                  } else {
                        customAlert("Không có dữ liệu để hiển thị !");
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
            }
      });
}
function closeChiTietTaiKhoan() {
      let modal = document.getElementById("modal-chiTietTaiKhoan");
      modal.innerHTML = "";
      modal.style.display = 'none';
}