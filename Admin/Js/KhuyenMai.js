function chiTietKhuyenMai(MaKM) {
      let Ma = document.getElementById("addKM-ma");
      let TenKM = document.getElementById("addKM-ten");
      let PhanTramKM = document.getElementById("addKM-phantram");
      let NgayBatDauKM = document.getElementById("addKM-ngaybatdau");
      let NgayKetThucKM = document.getElementById("addKM-ngayketthuc");
      let MoTaKM = document.getElementById('addKM-mota');

      $.ajax({
            url: "Controller/KhuyenMaiController.php",
            method: "POST",
            data: { 
                  action : "getKhuyenMaiByMaKM",
                  MaKM : MaKM,
            },
            success : function(response){
                  console.log(response);
                  let data = JSON.parse(response);
                  if (data.status === "success") {
                        let khuyenMai = data.data;
                        Ma.value = khuyenMai['MaKM'];
                        TenKM.value = khuyenMai['TenKM'];
                        PhanTramKM.value = khuyenMai['PhanTramGiamGia'];
                        NgayBatDauKM.value = khuyenMai['NgayBatDau'];
                        NgayKetThucKM.value = khuyenMai['NgayKetThuc'];
                        MoTaKM.value = khuyenMai['MoTaKM'];
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
async function addKM() {
      let MaKM = document.getElementById("addKM-ma").value;
      if(MaKM !== "") {
            customAlert("Không thể thêm khuyến mãi đã tồn tại !");
            return
      }
      let TenKM = document.getElementById("addKM-ten").value;
      if(checkForSpecialChar(TenKM) || TenKM.length < 4) {
            customAlert("Tên khuyến mãi phải trên 4 ký tự và không được chứa ký tự đặc biệt !");
            return
      }
      let PhanTram = document.getElementById("addKM-phantram").value;
      if(PhanTram == 0) {
            if(! await customConfirm("Bạn có chắc muốn chọn phần trăm giảm là 0% ?")) {
                  return
            }
      }
      let NgayBatDau = document.getElementById("addKM-ngaybatdau").value;
      let NgayKetThuc = document.getElementById("addKM-ngayketthuc").value;
      if (!NgayBatDau || !NgayKetThuc) {
            customAlert("Vui lòng chọn cả hai ngày!");
            return
      }
      // Chuyển giá trị sang đối tượng Date để so sánh
      let d1 = new Date(NgayBatDau);
      let d2 = new Date(NgayKetThuc);
      let currentDate = new Date();
      if(d1 < currentDate){
            customAlert("Vui lòng chọn ngày bắt đầu sau ngày hiện tại !");
            return
      } else if (d1 > d2) {
            customAlert("Ngày bắt đầu phải trước ngày kết thúc!");
            return
      }  else if (d1.getTime() === d2.getTime()){
            if(!await customConfirm("Bạn có chắc muốn chọn khuyến mãi duy nhất 1 ngày ?")) {
                  return
            }
      }
      let MoTaKM = document.getElementById('addKM-mota').value;
      MoTaKM = MoTaKM.trim().replace(/\s+/g, ' ');  
      if(checkForSpecialCharForKhuyenMai(MoTaKM) || MoTaKM.length < 4) {
            customAlert("Mô tả không được chứa ký tự đặc biệt !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn thêm khuyến mãi này ?")) {
            return
      }
      // Xóa khoảng trắng dư thừa
      $.ajax({
            url: "Controller/KhuyenMaiController.php",
            method: "POST",
            data: { 
                  action : "add_KM",
                  TenKM : TenKM,
                  PhanTram:PhanTram,
                  NgayBatDau:NgayBatDau,
                  NgayKetThuc:NgayKetThuc,
                  MoTaKM : MoTaKM
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Thêm khuyến mãi thành công !","success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error") {
                        customAlert("Thêm khuyến mãi thất bại !");
                  } else if(response == "error_existedTen") {
                        customAlert("Tên khuyến mãi đã tồn tại !");
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

async  function updateKM() {
      let MaKM = document.getElementById("addKM-ma").value;
      if(MaKM == "") {
            customAlert("Vui lòng chọn 1 loại để sửa !");
            return
      }
      let TenKM = document.getElementById("addKM-ten").value;
      if(checkForSpecialChar(TenKM) || TenKM.length < 4) {
            customAlert("Tên khuyến mãi phải trên 4 ký tự và không được chứa ký tự đặc biệt !");
            return
      }
      let PhanTram = document.getElementById("addKM-phantram").value;
      if(PhanTram == 0) {
            if(! await customConfirm("Bạn có chắc muốn chọn phần trăm giảm là 0% ?")) {
                  return
            }
      }
      let NgayBatDau = document.getElementById("addKM-ngaybatdau").value;
      let NgayKetThuc = document.getElementById("addKM-ngayketthuc").value;
      if (!NgayBatDau || !NgayKetThuc) {
            customAlert("Vui lòng chọn cả hai ngày!");
            return
      }
      // Chuyển giá trị sang đối tượng Date để so sánh
      let d1 = new Date(NgayBatDau);
      let d2 = new Date(NgayKetThuc);
      let currentDate = new Date();
      if(d1 < currentDate){
            customAlert("Vui lòng chọn ngày bắt đầu sau ngày hiện tại !");
            return
      } else if (d1 > d2) {
            customAlert("Ngày bắt đầu phải trước ngày kết thúc!");
            return
      }  else if (d1.getTime() === d2.getTime()){
            if(!await customConfirm("Bạn có chắc muốn chọn khuyến mãi duy nhất 1 ngày ?")) {
                  return
            }
      }
      let MoTaKM = document.getElementById('addKM-mota').value;
      MoTaKM = MoTaKM.trim().replace(/\s+/g, ' ');  
      if(checkForSpecialChar(MoTaKM) || MoTaKM.length < 4) {
            customAlert("Mô tả không được chứa ký tự đặc biệt !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn sửa khuyến mãi này ?")) {
            return
      }
      // console.log(NgayBatDau)
      // console.log(NgayKetThuc)
      // Xóa khoảng trắng dư thừa
      $.ajax({
            url: "Controller/KhuyenMaiController.php",
            method: "POST",
            data: { 
                  action : "update_KM",
                  MaKM : MaKM,
                  TenKM : TenKM,
                  PhanTram:PhanTram,
                  NgayBatDau:NgayBatDau,
                  NgayKetThuc:NgayKetThuc,
                  MoTaKM : MoTaKM
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Sửa khuyến mãi thành công !","success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Sửa khuyến mãi thất bại !");
                  } else if(response == "error_existedTen") {
                        customAlert("Tên khuyến mãi đã tồn tại !");
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
async  function deleteKM() {
      let MaKM = document.getElementById("addKM-ma").value;
      if(MaKM == "") {
            customAlert("Vui lòng chọn 1 khuyến mãi để xóa !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn xóa khuyến mãi này ?")) {
            return
      }
      $.ajax({
            url: "Controller/KhuyenMaiController.php",
            method: "POST",
            data: { 
                  action : "delete_KM",
                  MaKM : MaKM,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Xóa khuyến mãi thành công !","success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Xóa khuyến mãi thất bại !");
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
function refeshKM() {
      let MaKM = document.getElementById("addKM-ma");
      MaKM.value = "";
      let TenKM = document.getElementById("addKM-ten");
      TenKM.value = "";
      let MoTaKM = document.getElementById('addKM-mota');
      MoTaKM.value = "";
      let PhanTramKM = document.getElementById("addKM-phantram");
      PhanTramKM.value = "";
      let NgayBatDauKM = document.getElementById("addKM-ngaybatdau");
      NgayBatDauKM.value = "";
      let NgayKetThucKM = document.getElementById("addKM-ngayketthuc");
      NgayKetThucKM.value = "";
}