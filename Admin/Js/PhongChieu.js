function suaPhongChieu(MaPhongChieu) {
      if(confirm("Bạn có chắc muốn cập nhật thông tin phòng chiếu ? ")) { 
            let tenphongchieu = document.getElementById("SuaPhongChieu-tenphongchieu").value;
            let soluongghe = document.getElementById("SuaPhongChieu-soluongghe").value;
            if(!Number.isInteger(soluongghe) && soluongghe <= 0) {
                  alert("Số Lượng Ghế phải là số nguyên !");
                  return;
            }
            $.ajax({
                  url: "Controller/PhongChieuController.php",
                  method: "POST",
                  data: { 
                        action : "suaPhongChieu",
                        MaPhongChieu : MaPhongChieu,
                        TenPhongChieu : tenphongchieu,
                        SoLuongGhe : soluongghe,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              alert("Cập nhật phòng chiếu thành công !");
                              window.location.href="index.php?ctrl=Phòng Chiếu";
                        } else if(response == "error"){
                              alert("Cập nhật phòng chiếu thất bại !");
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