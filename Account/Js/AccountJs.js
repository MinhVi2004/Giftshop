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
      var birthday = new Date(document.getElementById('signin-birthday').value);
      var birthday_error = document.getElementById('signin-birthday-error');
      var phone = document.getElementById('signin-phone').value;
      var phone_error = document.getElementById('signin-phone-error');
      var email = document.getElementById('signin-email').value;
      var email_error = document.getElementById('signin-email-error');
      //? Username validate
      if (username == '' || username.length < 4 || checkForSpecialChar(username) == true) {
            console.log(username)
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
      //? Birthday validate
      if (birthday.getFullYear() > 2010 || birthday.getFullYear() < 1900 || !birthday.getDate()) {
            birthday_error.style.display = 'block';    
            flag = false;
      } else {
            birthday_error.style.display = 'none';   
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
            var birthday = document.getElementById('signin-birthday').value;
            var phone = document.getElementById('signin-phone').value;
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
                        NgaySinh : birthday,
                        SoDienThoai : phone,
                        Email : email,
                  },
                  success : function(response){
                        console.log(response);
                        if(response.match('username_exist')) {
                              username_error.style.display = 'block';
                        } else if(response.match('email_exist')) {
                              email_error.style.display = 'block';
                        } else if(response == "success") {
                              alert("Tạo tài khoản thành công !");
                              window.location.href='index.php?ctrl=loginView'
                        } else if(response == "error"){
                              alert("Tạo tài khoản thất bại !");
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
                        if(response == "lock") {
                              alert("Tài khoản đã bị khóa !")
                        } else if(response == "success") {
                              alert("Đăng nhập thành công !");
                              window.location.href='../User/index.php'
                        } else if(response == "error"){
                              error.style.display = 'block';
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
                  if(response == "Lỗi khi tạo password_reset") {
                        alert("Lỗi khi tạo password_reset");
                        window.location.href='../User/index.php'
                  } else if(response == "Link đặt lại mật khẩu đã được gửi đến email của bạn.") {
                        alert("Link đặt lại mật khẩu đã được gửi đến email của bạn.");
                        // window.location.href='../User/index.php'
                  } else if(response == "Gửi Email thất bại"){
                        alert("Gửi Email thất bại");
                        error.style.display = 'block';
                  } else if(response == "Email không tồn tại trong hệ thống."){
                        email_error.style.display = 'block';
                        alert("Email không tồn tại trong hệ thống.")
                  } else {
                        console.log(response);
                        alert("Lỗi khác");
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert("Lỗi trong quá trình xử lý Ajax.");
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
                        alert("Thay đổi mật khẩu thành công");
                        window.location.href='../User/index.php'
                  } else if(response == "error_updatePassword") {
                        alert("Lỗi khi thay đổi mật khẩu");
                  } else if(response == "error_notFoundAccount") {
                        alert("Lỗi không tìm thấy taikhoan bằng token");
                  } else {
                        console.log(response);
                        alert("Lỗi khác");
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert("Lỗi trong quá trình xử lý Ajax.");
            }
      });
}
function validateUpdate() {
      var flag = true;
      var fullname = document.getElementById('profile-fullname').value;
      var fullname_error = document.getElementById('profile-fullname-error');
      var birthday = new Date(document.getElementById('profile-birthday').value);
      var birthday_error = document.getElementById('profile-birthday-error');
      var phone = document.getElementById('profile-phone').value;
      var phone_error = document.getElementById('profile-phone-error');
      var email = document.getElementById('profile-email').value;
      var email_error = document.getElementById('profile-email-error');

      
      //? Fullname validate
      if (fullname == '' || fullname.length < 4 || checkForSpecialChar(fullname) == true) {
            fullname_error.style.display = 'block';   
            flag = false;
      } else {
            fullname_error.style.display = 'none';
      }
      //? Birthday validate
      if (birthday.getFullYear() > 2010 || birthday.getFullYear() < 1900 || !birthday.getDate()) {
            birthday_error.style.display = 'block';    
            flag = false;
      } else {
            birthday_error.style.display = 'none';   
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
function updateAccount() {
      if(validateUpdate()) {
            var fullname = document.getElementById('profile-fullname').value;
            var birthday = document.getElementById('profile-birthday').value;
            var phone = document.getElementById('profile-phone').value;
            var email = document.getElementById('profile-email').value;
            var email_error = document.getElementById('profile-email-error');
            $.ajax({
                  url: "Controller/AccountController.php",
                  method: "POST",
                  data: { 
                        action : "updateAccount",
                        HoTen : fullname,
                        NgaySinh : birthday,
                        SoDienThoai : phone,
                        Email : email,
                  },
                  success : function(response){
                        console.log(response);
                        if(response.match('email_exist')) {
                              email_error.style.display = 'block';
                        } else if(response == "success") {
                              alert("Cập nhật thông tin thành công !");
                              window.location.href='../User/index.php'
                        } else if(response == "error"){
                              alert("Cập nhật thông tin thất bại !");
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
                        alert("Đổi mật khẩu thành công !");
                        window.location.href='../User/index.php'
                  } else if(response == "error"){
                        alert("Đổi mật khẩu thất bại !");
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
                              alert("Bạn đã thay đổi hình đại diện thành công !");
                        } else if(response.match('error')){
                              console.log(response);
                              alert("Lỗi ");
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