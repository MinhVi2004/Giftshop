//?                                                            Validate
let isAddingCart = false;  
var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
var specialCharsForDiaChi = "<>@!#$%^&*()_+[]{}?:;|'\"\\~`-=";
var specialCharsForEmail = "<>!#$%^&*()_+[]{}?:;|'\"\\,/~`-=";
var specialCharsForPhoneNumber = "@.<>!#$%^&*()_+[]{}?:;|'\"\\,/~`-=abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
function checkForSpecialChar(string){
      for(i = 0; i < specialChars.length;i++){
            if(string.indexOf(specialChars[i]) > -1){
                  return true;
            }
      }
      return false;
}
function checkForSpecialCharForDiaChi(string){
      for(i = 0; i < specialCharsForDiaChi.length;i++){
            if(string.indexOf(specialCharsForDiaChi[i]) > -1){
                  return true;
            }
      }
      return false;
}
function checkForSpecialCharForEmail(string){
      for(i = 0; i < specialCharsForEmail.length;i++){
            if(string.indexOf(specialCharsForEmail[i]) > -1){
                  return true;
            }
      }
      return false;
}
function checkForSpecialCharForPhoneNumber(string){
      for(i = 0; i < specialCharsForPhoneNumber.length;i++){
            if(string.indexOf(specialCharsForPhoneNumber[i]) > -1){
                  return true;
            }
      }
      return false;
}
function toggleMenu() {
      var menu = document.getElementById("header-left-container");
      menu.classList.toggle("show");
  }
  
function logout() {
      $.ajax({
            url: "Account/Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "logout",
            },
            success : function(response){
                  console.log(response);if(response == "success") {
                        customAlert("Đăng xuất thành công !", "success");
                        window.location.href='index.php'
                  } else if(response == "error"){
                        customAlert("Đăng xuất thất bại !");
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
function customAlert(message,type) {
	if (type =='success') {
		document.getElementById("customalert").style.backgroundColor = '#4CAF50';
	}
	if (type =='warning' || type == null) {
		document.getElementById("customalert").style.backgroundColor = '#f44336';
	}
	document.getElementById("customalert").innerHTML = message;
    var x = document.getElementById("customalert");
    x.className = "show";
    setTimeout(function(){ x.className = x.classList.remove("show"); }, 1300);
}
// Custom confirm function
function customConfirm(message) {
      return new Promise((resolve) => {
            // Hiển thị hộp thoại
            let confirmBox = document.getElementById('customConfirm');
            let confirmMessage = document.getElementById('confirmMessage');
            confirmMessage.textContent = message;
            confirmBox.style.display = 'flex';

            // Xử lý sự kiện cho nút "Đồng ý"
            document.getElementById('confirmYes').onclick = function () {
                  confirmBox.style.display = 'none';
                  resolve(true); // Trả về true nếu người dùng chọn "Đồng ý"
            };

            // Xử lý sự kiện cho nút "Hủy"
            document.getElementById('confirmNo').onclick = function () {
                  confirmBox.style.display = 'none';
                  resolve(false); // Trả về false nếu người dùng chọn "Hủy"
            };
      });
}

async function delay(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
  }
  
  async function fetchProvinces() {
      let response = await fetch('https://open.oapi.vn/location/provinces?page=0&size=63');

      let provinces = await response.json();
      let provinceSelect = document.getElementById("addAddress-province");

      if (provinces["code"] == "success") {
            TinhThanh = provinces["data"];
            TinhThanh.forEach(province => {
            let option = document.createElement("option");
            option.value = province['id'];
            option.setAttribute('data-province-name', province['name']);
            option.textContent = province['name'];
            provinceSelect.appendChild(option);
            });
      }
  }
  
  
  // Gọi API để lấy danh sách quận/huyện theo tỉnh/thành phố
  async function fetchDistricts() {
      let provinceId = document.getElementById("addAddress-province").value;
      let districtSelect = document.getElementById("addAddress-district");
      districtSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';

      if (provinceId) {
            let response = await fetch(`https://open.oapi.vn/location/districts/${provinceId}?page=0&size=63`); // Thay bằng API thật
            let districts = await response.json();
            if(districts["code"] == "success") {
                  QuanHuyen = districts["data"];
                  QuanHuyen.forEach(districts => {
                        let option = document.createElement("option");
                        option.value =  districts['id'];
                        option.setAttribute('data-district-name', districts['name']);
                        option.textContent = districts['name'];
                        districtSelect.appendChild(option);
                  });
            }
      }
  }
  // Gọi API để lấy danh sách quận/huyện theo tỉnh/thành phố
  async function fetchWards() {
      let districtId = document.getElementById("addAddress-district").value;
      let wardsSelect = document.getElementById("addAddress-wards");

      wardsSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';

      if (districtId) {
      
            let response = await fetch(`https://open.oapi.vn/location/wards/${districtId}?page=0&size=63`); // Thay bằng API thật
            let wards = await response.json();
            if(wards["code"] == "success") {
                  PhuongXa = wards["data"];
                  PhuongXa.forEach(wards => {
                        let option = document.createElement("option");
                        option.value = wards['id'];
                        option.setAttribute('data-wards-name', wards['name']);      
                        option.textContent = wards['name'];
                        wardsSelect.appendChild(option);
                  });
            }
      }
}
function validateAddAddress() {
      var flag = true;
      var fullname = document.getElementById('addAddress-fullname').value;
      var fullname_error = document.getElementById('addAddress-fullname-error');
      var phone = document.getElementById('addAddress-phone').value;
      var phone_error = document.getElementById('addAddress-phone-error');

      var provinceSelect = document.getElementById('addAddress-province');
      var selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
      var province = selectedOption.getAttribute('data-province-name');
      var province_error = document.getElementById('addAddress-province-error');

      var districtSelect = document.getElementById('addAddress-district');
      var selectedOption = districtSelect.options[districtSelect.selectedIndex];
      var district = selectedOption.getAttribute('data-district-name');      
      var district_error = document.getElementById('addAddress-district-error');

      var wardsSelect = document.getElementById('addAddress-wards');
      var selectedOption = wardsSelect.options[wardsSelect.selectedIndex];
      var wards = selectedOption.getAttribute('data-wards-name');
      var wards_error = document.getElementById('addAddress-wards-error');

      var diachi = document.getElementById('addAddress-diachi').value;
      var diachi_error = document.getElementById('addAddress-diachi-error');

      
      //? Fullname validate
      if (fullname == '' || fullname.length < 4 || checkForSpecialChar(fullname) == true) {
            fullname_error.style.display = 'block';   
            flag = false;
      } else {
            fullname_error.style.display = 'none';
      }
      //? Phone validate
      if (phone == '' || phone.length > 11 ||phone.length < 9 || checkForSpecialCharForPhoneNumber(phone) == true) {
            phone_error.style.display = 'block';    
            flag = false;
      } else {
            phone_error.style.display = 'none';   
      }
      //? province validate
      if (province == '') {
            province_error.style.display = 'block';    
            flag = false;
      } else {
            province_error.style.display = 'none';   
      }
      //? district validate
      if (district == '') {
            district_error.style.display = 'block';    
            flag = false;
      } else {
            district_error.style.display = 'none';   
      }
      //? wards validate
      if (wards == '') {
            wards_error.style.display = 'block';    
            flag = false;
      } else {
            wards_error.style.display = 'none';   
      }
      //? diachi validate
      if (diachi == '' || diachi.length < 4 || checkForSpecialCharForDiaChi(diachi) == true) {
            diachi_error.style.display = 'block';    
            flag = false;
      } else {
            diachi_error.style.display = 'none';   
      }
      return flag;
}
async function addAddress(MaTK) {
      if(validateAddAddress()) {
            if(! await customConfirm("Bạn có chắc muốn thêm địa chỉ giao hàng này ?")) {
                  return
            }
            var fullname = document.getElementById('addAddress-fullname').value;
            var phone = document.getElementById('addAddress-phone').value;
            var provinceSelect = document.getElementById('addAddress-province');
            var selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
            var province = selectedOption.getAttribute('data-province-name');

            
            var districtSelect = document.getElementById('addAddress-district');
            var selectedOption = districtSelect.options[districtSelect.selectedIndex];
            var district = selectedOption.getAttribute('data-district-name');      

            
            var wardsSelect = document.getElementById('addAddress-wards');
            var selectedOption = wardsSelect.options[wardsSelect.selectedIndex];
            var wards = selectedOption.getAttribute('data-wards-name');

            var diachi = document.getElementById('addAddress-diachi').value;
            $.ajax({
                  url: "Controller/UserController.php",
                  method: "POST",
                  data: { 
                        action : "add_Address",
                        MaTK : MaTK, 
                        HoTen : fullname, 
                        TinhThanh : province,
                        QuanHuyen : district,
                        PhuongXa : wards,
                        DiaChi : diachi,
                        SoDienThoai : phone,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              customAlert("Thêm địa chỉ giao hàng thành công !", "success");
                              setTimeout(() => {
                                    window.history.back();
                              }, 1000); // 1000 ms = 1 giây
                        } else if(response == "error"){
                              customAlert("Thêm địa chỉ giao hàng thất bại !");
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
}







// Gọi API để lấy danh sách tỉnh/thành phố
async function fetchProvincesUpdate(name) {
      // console.log("Gọi thành công")
      let response = await fetch('https://open.oapi.vn/location/provinces?page=0&size=63'); // Thay bằng API thật
      let provinces = await response.json();

      let provinceSelect = document.getElementById("updateAddress-province");
      if(provinces["code"] == "success") {
            TinhThanh = provinces["data"];
            TinhThanh.forEach(province => {
                  let option = document.createElement("option");
                  option.value = province['id'];
                  option.setAttribute('data-province-name', province['name']);
                  option.textContent = province['name'];
                  // Check if the province code matches the selected province code
                  if (province['name'] === name) {
                      option.selected = true; // Mark the option as selected
                  }
                  provinceSelect.appendChild(option);
                  });
      }
}

// Gọi API để lấy danh sách quận/huyện theo tỉnh/thành phố
async function fetchDistrictsUpdate(name) {
      let provinceId = document.getElementById("updateAddress-province").value;
      let districtSelect = document.getElementById("updateAddress-district");
      districtSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';

      if (provinceId) {
            let response = await fetch(`https://open.oapi.vn/location/districts/${provinceId}?page=0&size=63`); // Thay bằng API thật
            let districts = await response.json();
            if(districts["code"] == "success") {
                  QuanHuyen = districts["data"];
                  QuanHuyen.forEach(districts => {
                        let option = document.createElement("option");
                        option.value =  districts['id'];
                        option.setAttribute('data-district-name', districts['name']);
                        option.textContent = districts['name'];
                        // Check if the province code matches the selected province code
                        if (districts['name'] === name) {
                            option.selected = true; // Mark the option as selected
                        }
                        districtSelect.appendChild(option);
                  });
            }
      }
      let wardsSelect = document.getElementById("updateAddress-wards");
      wardsSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
}
// Gọi API để lấy danh sách quận/huyện theo tỉnh/thành phố
async function fetchWardsUpdate(name) {
      let districtId = document.getElementById("updateAddress-district").value;
      let wardsSelect = document.getElementById("updateAddress-wards");
      wardsSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';

      if (districtId) {
            
            let response = await fetch(`https://open.oapi.vn/location/wards/${districtId}?page=0&size=63`); // Thay bằng API thật
            let wards = await response.json();
            if(wards["code"] == "success") {
                  PhuongXa = wards["data"];
                  PhuongXa.forEach(wards => {
                        let option = document.createElement("option");
                        option.value = wards['id'];
                        option.setAttribute('data-wards-name', wards['name']);      
                        option.textContent = wards['name']; 
                        // Check if the province code matches the selected province code
                        if (wards['name'] === name) {
                            option.selected = true; // Mark the option as selected
                        }
                        wardsSelect.appendChild(option);
                  });
            }
      }
}
async function callMethodUpdateAddress(TinhThanhPho, QuanHuyen, PhuongXa) {
                              
      await fetchProvincesUpdate(TinhThanhPho);

      await fetchDistrictsUpdate(QuanHuyen);

      await fetchWardsUpdate(PhuongXa);
}
function validateUpdateAddress() {
      var flag = true;
      var fullname = document.getElementById('updateAddress-fullname').value;
      var fullname_error = document.getElementById('updateAddress-fullname-error');
      var phone = document.getElementById('updateAddress-phone').value;
      var phone_error = document.getElementById('updateAddress-phone-error');

      var province = document.getElementById('updateAddress-province').value;
      console.log(province)
      var province_error = document.getElementById('updateAddress-province-error');

      var district = document.getElementById('updateAddress-district').value;
      var district_error = document.getElementById('updateAddress-district-error');

      var wards = document.getElementById('updateAddress-wards').value;
      console.log(wards)
      var wards_error = document.getElementById('updateAddress-wards-error');

      var diachi = document.getElementById('updateAddress-diachi').value;
      var diachi_error = document.getElementById('updateAddress-diachi-error');

      
      //? Fullname validate
      if (fullname == '' || fullname.length < 4 || checkForSpecialChar(fullname) == true) {
            fullname_error.style.display = 'block';   
            flag = false;
      } else {
            fullname_error.style.display = 'none';
      }
      //? Phone validate
      if (phone == '' || phone.length > 11 ||phone.length < 9 || checkForSpecialCharForPhoneNumber(phone) == true) {
            phone_error.style.display = 'block';    
            flag = false;
      } else {
            phone_error.style.display = 'none';   
      }
      //? province validate
      if (province == 'none' || province =='') {
            province_error.style.display = 'block';    
            flag = false;
      } else {
            province_error.style.display = 'none';   
      }
      //? district validate
      if (district == 'none' || district =='') {
            district_error.style.display = 'block';    
            flag = false;
      } else {
            district_error.style.display = 'none';   
      }
      //? wards validate
      if (wards == 'none' || wards =='') {
            wards_error.style.display = 'block';    
            flag = false;
      } else {
            wards_error.style.display = 'none';   
      }
      //? diachi validate
      if (diachi == '' || diachi.length < 4 || checkForSpecialCharForDiaChi(diachi) == true) {
            diachi_error.style.display = 'block';    
            flag = false;
      } else {
            diachi_error.style.display = 'none';   
      }
      return flag;
}
async function updateAddress(MaDC) {
      if(validateUpdateAddress()) {
            if(! await customConfirm("Bạn có chắc muốn sửa địa chỉ giao hàng này ?")) {
                  return
            }
            var fullname = document.getElementById('updateAddress-fullname').value;
            var phone = document.getElementById('updateAddress-phone').value;
            var provinceSelect = document.getElementById('updateAddress-province');
            var selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
            var province = selectedOption.getAttribute('data-province-name');

            
            var districtSelect = document.getElementById('updateAddress-district');
            var selectedOption = districtSelect.options[districtSelect.selectedIndex];
            var district = selectedOption.getAttribute('data-district-name');      

            
            var wardsSelect = document.getElementById('updateAddress-wards');
            var selectedOption = wardsSelect.options[wardsSelect.selectedIndex];
            var wards = selectedOption.getAttribute('data-wards-name');
            
            var diachi = document.getElementById('updateAddress-diachi').value;
            $.ajax({
                  url: "Controller/UserController.php",
                  method: "POST",
                  data: { 
                        action : "update_Address",
                        MaDC : MaDC, 
                        HoTen : fullname, 
                        TinhThanh : province,
                        QuanHuyen : district,
                        PhuongXa : wards,
                        DiaChi : diachi,
                        SoDienThoai : phone,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              customAlert("Sửa địa chỉ giao hàng thành công !", "success");
                              setTimeout(() => {
                                    window.location.href='index.php?ctrl=addressDetailView';
                              }, 1000); // 1000 ms = 1 giây
                        } else if(response == "error"){
                              customAlert("Sửa địa chỉ giao hàng thất bại !");
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
}

async function deleteAddress(MaDC) {
      if(! await customConfirm("Bạn có chắc muốn xóa địa chỉ giao hàng này ?")) {
            return
      }
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "delete_Address",
                  MaDC : MaDC, 
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Xóa địa chỉ giao hàng thành công !", "success");
                        setTimeout(() => {
                              window.location.reload()
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Xóa địa chỉ giao hàng thất bại !");
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
async function changePassword() {
      if(! await customConfirm("Bạn có chắc muốn đổi mật khẩu ?")) {
            return
      }
      var oldpassword = document.getElementById('changePassword-oldpassword').value;
      var oldpassword_error = document.getElementById('changePassword-oldpassword-error');
      var password = document.getElementById('changePassword-password').value;
      var password_error = document.getElementById('changePassword-password-error');
      var repassword = document.getElementById('changePassword-repassword').value;
      var repassword_error = document.getElementById('changePassword-repassword-error');
      //? Password validate
      if (password == '' || password.length < 6) {
            password_error.style.display = 'block';  
            return;
      } else {
            password_error.style.display = 'none';   
      }
      //? Repassword validate
      if(repassword != password || repassword == '') {
            repassword_error.style.display = 'block'; 
            return;
      } else {
            repassword_error.style.display = 'none';
      }
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "change_Password",
                  MatKhauCu : oldpassword,
                  MatKhauMoi : password,
            },
            success : function(response){
                  console.log(response);
                  if(response.match('incorrect_oldpassword')) {
                        oldpassword_error.style.display = 'block';
                  } else if(response == "success") {
                        customAlert("Đổi mật khẩu thành công !", "success");
                        setTimeout(() => {
                              window.location.href='index.php'
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Đổi mật khẩu thất bại !");
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
function loadQuantity() {
      $.ajax({
          url: "getNotification.php",
          type: "POST",
          success: function(response) {
            // console.log(response)
            let data = JSON.parse(response);
            let gioHangCount = parseInt(data.quantity_giohang) || 0;
            let badgeCart = $("#cart-count");

            if (gioHangCount > 0) {
                badgeCart.text(gioHangCount).show();
            } else {
                badgeCart.hide();
            }

        },
        error: function(xhr) {
            console.error("Lỗi khi tải thông báo:", xhr.responseText);
        }
      });
  }
function loadNotifications() {
      $.ajax({
          url: "getNotification.php",
          type: "POST",
          success: function(response) {
            // console.log(response)
            let data = JSON.parse(response);
            let count = parseInt(data.unread_count) || 0;
            let gioHangCount = parseInt(data.quantity_giohang) || 0;
            let badge = $("#notification-count");
            let badgeCart = $("#cart-count");

            // Cập nhật số lượng thông báo chưa đọc
            if (count > 0) {
                badge.text(count).show();
            } else {
                badge.hide();
            }
            if (gioHangCount > 0) {
                badgeCart.text(gioHangCount).show();
            } else {
                badgeCart.hide();
            }

            // Cập nhật danh sách thông báo
            $("#notify-dropdownContent").html(data.html);
        },
        error: function(xhr) {
            console.error("Lỗi khi tải thông báo:", xhr.responseText);
        }
      });
  }
  

// Tải số lượng thông báo mỗi 10 giây
setInterval(loadNotifications, 10000);
loadNotifications(); // Gọi ngay khi trang load
loadQuantity();
  function toggleDropdown() {
      let dropdown = document.getElementById("notify-dropdownContent");
  
      if (!dropdown.classList.contains("show")) {
          loadNotifications(); // Chỉ gọi AJAX khi mở dropdown
      }
      
      dropdown.classList.toggle("show");
  }

// Ẩn dropdown khi click bên ngoài
window.onclick = function(event) {
      if (!event.target.closest('.notify-dropdown-button')) { // Kiểm tra xem có click vào nút hoặc bên trong nút không
          var dropdowns = document.getElementsByClassName("notify-dropdown-content");
          for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                  openDropdown.classList.remove('show');
              }
          }
      }
  };
  function markAsRead(element) {
      // if (isAddingCart) return; // Nếu đang xử lý, không cho phép nhấn tiếp
      // isAddingCart = true;
      let notificationID = element.getAttribute("data-id");
  
      if (element.classList.contains("unread")) {
          $.ajax({
              url: "getNotification.php",
              method: "POST",
              data: { 
                  action: "markAsRead", 
                  MaTB: notificationID 
                  },
              success: function(response) {
                  console.log(response)
                  let result = JSON.parse(response);
                  if (result.status === "success") {
                      element.classList.remove("unread"); // Bỏ trạng thái chưa đọc
  
                      // Cập nhật số lượng thông báo chưa đọc
                      let badge = $("#notification-count");
                      let count = parseInt(badge.text()) || 0;
                      if (count > 1) {
                          badge.text(count - 1);
                      } else {
                          badge.hide();
                      }
                  }
              },
              error: function(xhr) {
                  console.error("Lỗi khi cập nhật thông báo:", xhr.responseText);
              }
          });
      //     isAddingCart = false;
      }
  }
  
let quantityInput = document.getElementById('productDetail-quantity');
let increaseButton = document.getElementById('productDetail-increase');
let decreaseButton = document.getElementById('productDetail-decrease');

function increaseQuantity() {
      let quantity = document.getElementById('productDetail-quantity');
      quantity.value = parseInt(document.getElementById('productDetail-quantity').value) + 1;
      tongGiaTien();
};

function decreaseQuantity() {
      let quantity = document.getElementById('productDetail-quantity');
      if(quantity.value > 1) {
            quantity.value--;
      }
      tongGiaTien();
};
function closeProductDetail() {
      var productDetail = document.getElementById('modal');
      productDetail.innerHTML = "";
      productDetail.style.display = 'none';
}
function tongGiaTien() {
      let price = parseInt(document.getElementById('productDetail-price').getAttribute("value"));
      let quantity = parseInt(document.getElementById('productDetail-quantity').value);
      let total = price * quantity;
      document.getElementById('productDetail-totalPrice').innerHTML = new Intl.NumberFormat('vi-VN').format(total);
}
function productDetail(ma,ten, anh, mota, gia) {
      let giaTien = new Intl.NumberFormat('vi-VN').format(gia);
      var productDetail = document.getElementById('modal');
      
      productDetail.innerHTML = '<div class="productDetail-container">'+
                  '<button type="button" id="closeProductDetail" onclick="closeProductDetail()"><i class="fa-solid fa-x"></i></button>'+
                  '<div class="productDetail-image">'+
                  '<img src="'+anh+'" alt="Product Image" class="productDetail-img">'+
                  '</div>'+

                  '<div class="productDetail-details">'+
                        '<h2 class="productDetail-name">'+ten+'</h2>'+
                        '<p class="productDetail-description">'+mota+'</p>'+
                        '<p class="productDetail-price" id="productDetail-price" value="'+gia+'">Đơn Giá: '+giaTien+' VNĐ</p>'+
                        '<p class="productDetail-price">Tổng: <span id="productDetail-totalPrice"></span> VNĐ</p>'+

                        '<div class="quantity-selector">'+
                              '<button type="button" class="quantity-btn" id="productDetail-decrease" onclick="decreaseQuantity()">-</button>'+
                              '<input type="text" id="productDetail-quantity" name="quantity" value="1" class="quantity-input" readonly style="min-width:100px;">'+
                              '<button type="button" class="quantity-btn" id="productDetail-increase" onclick="increaseQuantity()">+</button>'+
                        '</div>'+

                        '<button class="add-to-cart" onclick="addCart(\''+ma+'\')">Thêm vào giỏ hàng</button>'+
                        '<button class="close-productDetail" onclick="closeProductDetail()">Đóng</button>'+
                  '</div>'+
            '</div>';
      
      productDetail.style.display = 'block';
      tongGiaTien();
}
async function addCart(ma) {
      if (isAddingCart) return; // Nếu đang xử lý, không cho phép nhấn tiếp
      isAddingCart = true;
      let quantity = document.getElementById("productDetail-quantity");
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "add_Cart",
                  MaSP : ma, 
                  SoLuong : quantity.value,
            },
            success : async function(response){
                  if(response.match("error_login")) {
                        if(! await customConfirm("Vui lòng đăng nhập để thêm vào giỏ hàng ?")) {
                              return
                        } else window.location.href = "Account/index.php?ctrl=loginView";
                  } else if(response == "success") {
                        customAlert("Thêm sản phẩm vào giỏ hàng thành công !", "success");
                        setTimeout(() => {
                              closeProductDetail();
                              loadQuantity();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Thêm sản phẩm vào giỏ hàng thất bại !");
                  } else {
                        console.log(response);
                        customAlert("Lỗi khác")
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
            },
            complete: function() {
                  setTimeout(() => {
                        isAddingCart = false;
                  }, 1300); // Ngăn spam click trong 1 giây
            }
      });
}

function validateUpdate() {
      var flag = true;
      var fullname = document.getElementById('updateProfile-fullname').value;
      var fullname_error = document.getElementById('updateProfile-fullname-error');
      var phone = document.getElementById('updateProfile-phone').value;
      var phone_error = document.getElementById('updateProfile-phone-error');
      var email = document.getElementById('updateProfile-email').value;
      var email_error = document.getElementById('updateProfile-email-error');

      
      //? Fullname validate
      if (fullname == '' || fullname.length < 4 || checkForSpecialChar(fullname) == true || fullname.length > 30) {
            fullname_error.style.display = 'block';   
            flag = false;
      } else {
            fullname_error.style.display = 'none';
      }
      //? Phone validate
      if (phone == '' || phone.length > 12 ||phone.length < 5 || checkForSpecialCharForPhoneNumber(phone) == true) {
            phone_error.style.display = 'block';    
            flag = false;
      } else {
            phone_error.style.display = 'none';   
      }
      //? Email validate
      if (email == '' || email.length < 10 || checkForSpecialCharForEmail(email) == true) {
            email_error.style.display = 'block';    
            flag = false;
      } else {
            email_error.style.display = 'none';   
      }
      return flag;
}
async function updateAccount() {
      if(validateUpdate()) {
            if(! await customConfirm("Bạn có chắc muốn thay đổi thông tin ?")) {
                  return
            }
            var fullname = document.getElementById('updateProfile-fullname').value;
            var phone = document.getElementById('updateProfile-phone').value;
            var phone_error = document.getElementById('updateProfile-phone-error');
            var email = document.getElementById('updateProfile-email').value;
            var email_error = document.getElementById('updateProfile-email-error');
            $.ajax({
                  url: "Controller/UserController.php",
                  method: "POST",
                  data: { 
                        action : "updateAccount",
                        HoTen : fullname,
                        SoDienThoai : phone,
                        Email : email,
                  },
                  success : function(response){
                        console.log(response);
                        if(response.match('email_exist')) {
                              email_error.style.display = 'block';
                              customAlert("Email đã được sử dụng !");
                        } else if(response == "success") {
                              customAlert("Cập nhật thông tin thành công !", "success");
                              setTimeout(() => {
                                    window.location.reload();
                              }, 1000); // 1000 ms = 1 giây
                        } else if(response == "error"){
                              customAlert("Cập nhật thông tin thất bại !");
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
}
function chuyenHuongTrang(TenBien, GiaTri) {
      let value = GiaTri;
      window.location.href = "http://localhost/GiftShop/index.php?"+TenBien+"=" + encodeURIComponent(value);
}