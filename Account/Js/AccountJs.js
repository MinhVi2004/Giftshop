let previousImage = "";  // Biến lưu trữ ảnh trước đó
function setup() {
      // Helper function to safely add event listeners
      function addEventListenerSafely(elementId, event, handler) {
            var element = document.getElementById(elementId);
            if (element) {
                  element.addEventListener(event, handler);
            }
      }
  
      // Add event listeners safely for each input field
      addEventListenerSafely("login-password", "keydown", function(event) {
          if (event.key === "Enter") {
              event.preventDefault();
              login();
          }
      });
  
      addEventListenerSafely("signin-email", "keydown", function(event) {
          if (event.key === "Enter") {
              event.preventDefault();
              signin();
          }
      });
  
      addEventListenerSafely("fillEmail-email", "keydown", function(event) {
          if (event.key === "Enter") {
              event.preventDefault();
              fillEmail();
          }
      });
  
      addEventListenerSafely("resetPassword-repassword", "keydown", function(event) {
          if (event.key === "Enter") {
              event.preventDefault();
              resetPassword();
          }
      });
  
      addEventListenerSafely("profile-email", "keydown", function(event) {
          if (event.key === "Enter") {
              event.preventDefault();
              updateAccount();
          }
      });
      addEventListenerSafely("changePassword-repassword", "keydown", function(event) {
          if (event.key === "Enter") {
              event.preventDefault();
              changePassword();
          }
      });
}
  
// Call setup function when DOM is fully loaded
document.addEventListener('DOMContentLoaded', (event) => {
      setup();
});
  
/*-----------------------------------------------------------------------------------------------------  */
//?                                                              Validate
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
//? Test 
/* var temp = 'minh0772912452';
if (checkForPhoneNumber(temp) == true) { //! check
      console.log('not valid'); //? Có kí tự đặc biệt
} else if (checkForPhoneNumber(temp) == false) {
      console.log('valid');   //? Không có kí tự đặc biệt
} */
/* -------------------------------------------------------------------------------------------------------------------- */

//?                                                          Signin Login Logout
function validateSignin() {
      var flag = true;
      var username = document.getElementById('signin-username').value;
      var username_error = document.getElementById('signin-username-error');
      var password = document.getElementById('signin-password').value;
      var password_error = document.getElementById('signin-password-error');
      var repassword = document.getElementById('signin-repassword').value;
      var repassword_error = document.getElementById('signin-repassword-error');
      var fullname = document.getElementById('signin-fullname').value;
      var fullname_error = document.getElementById('signin-fullname-error');
      var phone = document.getElementById('signin-phone').value;
      var phone_error = document.getElementById('signin-phone-error');
      var email = document.getElementById('signin-email').value;
      var email_error = document.getElementById('signin-email-error');
      //? Username validate
      if (username == '' || username.length < 4 || checkForSpecialChar(username) == true) {
            username_error.style.display = 'block';   
            flag = false;
      } else {
            username_error.style.display = 'none';
      }
      //? Password validate
      if (password == '' || password.length < 6) {
            password_error.style.display = 'block';    
            flag = false;
      } else {
            password_error.style.display = 'none';   
      }
      //? Repassword validate
      if(repassword != password || repassword == '') {
            repassword_error.style.display = 'block'; 
            flag = false;
      } else {
            repassword_error.style.display = 'none';
      }
      //? Fullname validate
      if (fullname == '' || fullname.length < 4 || checkForSpecialChar(fullname) == true) {
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
function signin() {
      if(validateSignin()) {
            var username = document.getElementById('signin-username').value;
            var username_error = document.getElementById('signin-username-error');
            var password = document.getElementById('signin-password').value;
            var fullname = document.getElementById('signin-fullname').value;
            var phone = document.getElementById('signin-phone').value;
            var phone_error = document.getElementById('signin-phone-error');
            var email = document.getElementById('signin-email').value;
            var email_error = document.getElementById('signin-email-error');
            $.ajax({
                  url: "Controller/AccountController.php",
                  method: "POST",
                  data: { 
                        action : "signin",
                        TenDangNhap : username,
                        MatKhau : password,
                        HoTen : fullname,
                        SoDienThoai : phone,
                        Email : email,
                  },
                  success : function(response){
                        console.log(response);
                        if(response.match('The domain does not exist or cannot receive emails.')) {
                              customAlert(response);
                        } else if(response.match('username_exist')) {
                              customAlert("Tên đăng nhập đã được sử dụng, vui lòng sử dụng Tên đăng nhập khác")
                              username_error.style.display = 'block';
                        } else if(response.match('email_exist')) {
                              customAlert("Tài khoản Email đã được sử dụng, vui lòng sử dụng tài khoản Email khác")
                              email_error.style.display = 'block';
                        } else if(response.match('sodienthoai_exist')) {
                              customAlert("Số Điện Thoại đã được sử dụng, vui lòng sử dụng Số Điện Thoại khác")
                              phone_error.style.display = 'block';
                        } else if(response.match('success')) {
                              console.log(response)
                              customAlert("Tạo tài khoản thành công", "success");
                              setTimeout(() => {
                                    window.location.href='index.php?ctrl=loginView'
                              }, 1000); // 1000 ms = 1 giây
                        } else if(response.match('error')){
                              console.log(response)
                              customAlert("Tạo tài khoản thất bại !");
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
function validateLogin() {
      let flag = true;
      var username = document.getElementById('login-username').value;
      var password = document.getElementById('login-password').value;
      var error = document.getElementById('login-error');
      if (username == '' || username.length < 4 || checkForSpecialChar(username) == true) {
            error.style.display = 'block';
            flag = false;
      } else {
            error.style.display = 'none';
      }
      if (password == '' || password.length < 4) {
            if(flag != false) {
                  error.style.display = 'block';
                  flag = false;
            }
      } else {
            error.style.display = 'none';
      }
      return flag;
}
function login() {
      if(validateLogin()) {
            var username = document.getElementById('login-username').value;
            var password = document.getElementById('login-password').value;
            var error = document.getElementById('login-error');
            $.ajax({
                  url: "Controller/AccountController.php",
                  method: "POST",
                  data: { 
                        action : "login",
                        TenDangNhap : username,
                        MatKhau : password,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "lock") {
                              customAlert("Tài khoản đã bị khóa !")
                        } else if(response == "success") {
                              customAlert("Đăng nhập thành công !", "success");
                              setTimeout(() => {
                                    window.location.href='../index.php'
                              }, 1000); // 1000 ms = 1 giây
                        } else if(response == "error"){
                              error.style.display = 'block';
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
function fillEmail() {
      let email = document.getElementById("fillEmail-email").value;
      let email_error = document.getElementById("fillEmail-email-error");
      $.ajax({
            url: "Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "sendResetLink",
                  Email: email,
            },
            success : function(response){
                  if(response == "Email chưa được xác nhận nên không khôi phục được, vui lòng liên hệ tư vấn viên 0772912452(Vi).") {
                        customAlert(response);
                  } else if(response == "Lỗi khi tạo password_reset") {
                        customAlert("Lỗi khi tạo password_reset");
                        setTimeout(() => {
                              window.location.href='../index.php'
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "Link đặt lại mật khẩu đã được gửi đến email của bạn.") {
                        customAlert("Link đặt lại mật khẩu đã được gửi đến email của bạn.", "success");
                        // window.location.href='../index.php'
                  } else if(response == "Gửi Email thất bại"){
                        customAlert("Gửi Email thất bại");
                        error.style.display = 'block';
                  } else if(response == "Email không tồn tại trong hệ thống."){
                        email_error.style.display = 'block';
                        customAlert("Email không tồn tại trong hệ thống.")
                  } else {
                        console.log(response);
                        customAlert("Lỗi khác");
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
            }
      });
}
function resetPassword(){
      var password = document.getElementById('resetPassword-password').value;
      var token = document.getElementById('token-value').value;
      var password_error = document.getElementById('resetPassword-password-error');
      var repassword = document.getElementById('resetPassword-repassword').value;
      var repassword_error = document.getElementById('resetPassword-repassword-error');
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
            url: "Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "resetPassword",
                  MatKhau: password,
                  Token:token,
            },
            success : function(response){
                  if(response == "success") {
                        customAlert("Thay đổi mật khẩu thành công", "success");
                        setTimeout(() => {
                              window.location.href='../index.php'
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error_updatePassword") {
                        customAlert("Lỗi khi thay đổi mật khẩu");
                  } else if(response == "error_notFoundAccount") {
                        customAlert("Lỗi không tìm thấy taikhoan bằng token");
                  } else {
                        console.log(response);
                        customAlert("Lỗi khác");
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
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
      if (fullname == '' || fullname.length < 4 || checkForSpecialChar(fullname) == true) {
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
                  url: "Controller/AccountController.php",
                  method: "POST",
                  data: { 
                        action : "updateAccount",
                        HoTen : fullname,
                        SoDienThoai : phone,
                        Email : email,
                  },
                  success : function(response){
                        // console.log(response);
                        if(response.match('email_exist')) {
                              email_error.style.display = 'block';
                              customAlert("Email đã được sử dụng !");
                        } else if(response.match('phone_exist')) {
                              phone_error.style.display = 'block';
                              customAlert("Số điện thoại đã được sử dụng !");
                        }else if(response == "success") {
                              customAlert("Cập nhật thông tin thành công !", "success");
                              setTimeout(() => {
                                    window.location.href='../index.php'
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
function changePassword() {
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
            url: "Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "changePassword",
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
                              window.location.href='../index.php'
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
function uploadAvatar() {
      let formData = new FormData(document.getElementById("uploadForm"));
      formData.append('action', 'uploadAvatar'); // Thêm action vào formData
            $.ajax({
                  url: "Controller/AccountController.php",
                  method: "POST",
                  data: formData,
                  contentType: false,  // Ngăn jQuery tự động thêm Content-Type header
                  processData: false,  // Ngăn jQuery xử lý data (vì data đang là FormData
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              customAlert("Bạn đã thay đổi hình đại diện thành công !", "success");
                              setTimeout(() => {
                                    window.location.reload();
                              }, 1000); // 1000 ms = 1 giây
                        } else if(response.match('error')){
                              console.log(response);
                              customAlert("Lỗi ");
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
function changeAvatar() {
      let form = document.getElementById("updateProfileView-changeAvatar");
      if(form.getAttribute("value") == 0) {
            form.innerHTML = "<button type='button' onclick='changeAvatar()' class='changeAvatar'>Hủy đổi ảnh đại diện</button><input type='file' name='inputUploadAvatar' id='inputUploadAvatar' accept='image/*' onchange='handleFileSelect(event)'><button type='button' onclick='uploadAvatar()' id='btnUploadAvatar'>Xác nhận</button>";
            form.setAttribute("value" , 1)
      } else {
            cancelImageChange();
            form.innerHTML = "<button type='button' onclick='changeAvatar()' class='changeAvatar'>Đổi ảnh đại diện</button>";
            form.setAttribute("value" , 0)
      }
}
// Hàm xử lý khi người dùng chọn ảnh mới
function handleFileSelect(event) {
      const file = event.target.files[0];

      // Lưu ảnh cũ trước khi thay đổi
      const imgElement = document.getElementById("showAVT");
      previousImage = imgElement.src;  // Lưu đường dẫn ảnh hiện tại
      
      // Tạo đối tượng FileReader để đọc tệp ảnh
      const reader = new FileReader();

      // Khi tệp được đọc xong, thiết lập nguồn cho thẻ img
      reader.onload = function(e) {
            imgElement.src = e.target.result;  // Đặt đường dẫn ảnh mới
            imgElement.style.display = "block";  // Hiển thị ảnh
      };

      // Đọc tệp như một URL hình ảnh
      reader.readAsDataURL(file);
  }
  // Hàm xử lý khi bấm nút hủy
  function cancelImageChange() {
      const imgElement = document.getElementById("showAVT");
      imgElement.src = previousImage;  // Quay lại ảnh trước đó
  }
function verifyEmailFunc() {
      var verifyEmail = document.getElementById('verifyEmail').value;
      var token = document.getElementById('token-value').value;
      var verifyEmail_error = document.getElementById('verifyEmail-error');
      //? Code validate
      if (verifyEmail == '' || verifyEmail.length !== 6) {
            verifyEmail_error.style.display = 'block';  
            return;
      } else {
            verifyEmail_error.style.display = 'none';   
      }
      $.ajax({
            url: "Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "verifyEmail",
                  code : verifyEmail,
                  token : token
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Xác nhận Email thành công !", "success");
                        setTimeout(() => {
                              window.location.href='../index.php'
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error_verifyEmail"){
                        customAlert("Xác nhận Email thất bại !");
                  } else if(response == "error_notFoundAccount"){
                        customAlert("Không tìm thấy tài khoản !");
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
function onclickVerifyEmail(email) {
      $.ajax({
            url: "Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "sendVerifyEmailLink",
                  Email : email
            },
            success : function(response){
                  console.log(response);
                  if(response == "VerifyEmail_Link xác nhận Email đã được gửi đến email của bạn.") {
                        customAlert("Email xác nhận đã được gửi đến Email của bạn. \n Vui lòng kiểm tra và xác nhận Email!", "success");
                  } else if(response == "VerifyEmail_Gửi Email thất bại."){
                        customAlert("VerifyEmail_Gửi Email thất bại.");
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
          const confirmBox = document.getElementById('customConfirm');
          const confirmMessage = document.getElementById('confirmMessage');
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