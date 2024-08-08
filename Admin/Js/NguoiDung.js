function khoaTaiKhoan(MaTaiKhoan) {
      if(confirm("Bạn có chắc muốn khóa tài khoản này ?")) {
            $.ajax({
                  url: "Controller/NguoiDungController.php",
                  method: "POST",
                  data: { 
                        action : "khoa_nguoiDung",
                        MaTaiKhoan : MaTaiKhoan,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              alert("Cập nhật trạng thái người dùng thành công !");
                              window.location.reload();
                        } else if(response == "error"){
                              alert("Cập nhật trạng thái người dùng thất bại !");
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
function moKhoaTaiKhoan(MaTaiKhoan) {
      if(confirm("Bạn có chắc muốn mở khóa tài khoản này ?")) {
            $.ajax({
                  url: "Controller/NguoiDungController.php",
                  method: "POST",
                  data: { 
                        action : "moKhoa_nguoiDung",
                        MaTaiKhoan : MaTaiKhoan,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              alert("Cập nhật trạng thái người dùng thành công !");
                              window.location.reload();
                        } else if(response == "error"){
                              alert("Cập nhật trạng thái người dùng thất bại !");
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