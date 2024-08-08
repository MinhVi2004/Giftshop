function check() {
      let xuatchieu_container = document.getElementById("updateLichChieu-xuatchieu-container");

      let today = new Date().setHours(0, 0, 0, 0);
      let ngaychieu_input = document.getElementById("updateLichChieu-ngaychieu").value;
      let ngaychieu_error = document.getElementById("updateLichChieu-ngaychieu-error");
      let ngaychieu = new Date(ngaychieu_input);
      if(ngaychieu < today) {
            ngaychieu_input = null;
            xuatchieu_container.innerHTML = "";
            ngaychieu_error.style.display = "block";
            return false;
      }
      ngaychieu_error.style.display = "none";
      let phongchieu_input = document.getElementById("updateLichChieu-phongchieu").value;
      if(phongchieu_input == 0) {
            return false;
      }
      return true;
}
function checkInput() {
      let ngaychieu_input = document.getElementById("updateLichChieu-ngaychieu").value;
      let phongchieu_input = document.getElementById("updateLichChieu-phongchieu").value;
      if(check())
            getXuatChieu(ngaychieu_input, phongchieu_input);
}
function getXuatChieu(NgayChieu, PhongChieu) {
      let xuatchieu_container = document.getElementById("updateLichChieu-xuatchieu-container");
      $.ajax({
            url: "Controller/LichChieuController.php",
            method: "POST",
            data: { 
                  action : "getXuatChieu",
                  NgayChieu : NgayChieu,
                  PhongChieu : PhongChieu,
            },
            success : function(response){
                  if(response.search(/success/) !== -1) {
                        response = response.replace(/success/, '');
                        response = JSON.parse(response);

                        xuatchieuString = "<h3><label for='updateLichChieu-xuatchieu'>Xuất Chiếu</label></h3>";
                        xuatchieuString += "<select name='updateLichChieu-xuatchieu' id='updateLichChieu-xuatchieu'><option name='updateLichChieu-xuatchieu' value='0'> - Chọn Xuất Chiếu - </option>=";

                        response.forEach(xuatChieu => {
                              xuatchieuString += "<option name='updateLichChieu-xuatchieu' value='"+xuatChieu['MaXuatChieu']+"'>"+xuatChieu['TenXuatChieu']+" : "+xuatChieu['ThoiGianBatDau']+" - "+xuatChieu['ThoiGianKetThuc']+"</option>";
                        })

                        xuatchieuString += "</select>";
                        xuatchieu_container.innerHTML = xuatchieuString;
                  } else if(response.search(/error/) !== -1){
                        alert("Error");
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
function updateLichChieu(MaPhim) {
      let ngaychieu_input = document.getElementById("updateLichChieu-ngaychieu").value;
      let phongchieu_input = document.getElementById("updateLichChieu-phongchieu").value;
      let xuatchieu_input = document.getElementById("updateLichChieu-xuatchieu").value;
      if(check() && xuatchieu_input !== 0) {
            $.ajax({
                  url: "Controller/LichChieuController.php",
                  method: "POST",
                  data: { 
                        action : "updateLichChieu",
                        PhongChieu : phongchieu_input,
                        MaPhim : MaPhim,
                        XuatChieu : xuatchieu_input,
                        NgayChieu : ngaychieu_input,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              alert("Cập nhật lịch chiếu thành công !");
                              window.location.reload();
                        } else if(response == "error"){
                              alert("Cập nhật lịch chiếu thất bại !");
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