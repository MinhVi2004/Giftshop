/*-----------------------------------------------------------------------------------------------------  */
//?                                                              Validate
var specialChars = "<>@!#$^&*()_+[]{}?:;|'\"\\/~`-=";
var specialCharsForKhuyenMai = "<>@!#$^&()_+[]{}?:;|'\"\~`=";
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
function checkForSpecialCharForKhuyenMai(string){
      for(i = 0; i < specialCharsForKhuyenMai.length;i++){
            if(string.indexOf(specialCharsForKhuyenMai[i]) > -1){
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
function logout() {
      $.ajax({
            url: "../Account/Controller/AccountController.php",
            method: "POST",
            data: { 
                  action : "logout",
            },
            success : function(response){
                  console.log(response);if(response == "success") {
                        customAlert("Đăng xuất thành công !", "success");
                        window.location.href='../index.php'
                  } else if(response == "error"){
                        customAlert("Đăng xuất thất bại !","warning");
                  } else {
                        console.log(response);
                        customAlert("Lỗi khác","warning")
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.","warning");
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
  function formatDate(dateString) {
      let [day, month, year] = dateString.split('-');
      return `${year}-${month}-${day}`; // Định dạng yyyy-MM-dd
}
document.getElementById("menu-toggle").addEventListener("click", function() {
      document.getElementById("navigation").classList.toggle("hidden");
});
