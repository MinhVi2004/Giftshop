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
                        window.location.href='../User/index.php'
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