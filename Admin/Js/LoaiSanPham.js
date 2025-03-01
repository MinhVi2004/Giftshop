function chiTietLoaiSP(Ma, Ten, MoTa) {
      let MaLoaiSP = document.getElementById("addLSP-ma");
      MaLoaiSP.value = Ma;
      let TenLoaiSP = document.getElementById("addLSP-ten");
      TenLoaiSP.value = Ten;
      let MoTaLoaiSP = document.getElementById('addLSP-mota');
      MoTaLoaiSP.value = MoTa;
}
async function addLoaiSP() {
      let MaLoaiSP = document.getElementById("addLSP-ma").value;
      if(MaLoaiSP !== "") {
            customAlert("Không thể thêm loại đã tồn tại !");
            return
      }
      let TenLoaiSP = document.getElementById("addLSP-ten").value;
      if(checkForSpecialChar(TenLoaiSP) || TenLoaiSP.length < 4) {
            customAlert("Tên không được chứa ký tự đặc biệt !");
            return
      }
      let MoTaLoaiSP = document.getElementById('addLSP-mota').value;
      if(checkForSpecialChar(MoTaLoaiSP) || MoTaLoaiSP.length < 4) {
            customAlert("Mô tả không được chứa ký tự đặc biệt !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn thêm loại sản phẩm này ?")) {
            return
      }
      // Xóa khoảng trắng dư thừa
      MoTaLoaiSP = MoTaLoaiSP.trim().replace(/\s+/g, ' ');  
      $.ajax({
            url: "Controller/LoaiSanPhamController.php",
            method: "POST",
            data: { 
                  action : "add_loaiSP",
                  TenLoaiSP : TenLoaiSP,
                  MoTaLoaiSP : MoTaLoaiSP
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Thêm loại sản phẩm thành công !","success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Thêm loại sản phẩm thất bại !");
                  } else if(response == "error_existedTen"){
                        customAlert("Tên loại sản phẩm đã tồn tại !");
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

async  function updateLoaiSP() {
      let MaLoaiSP = document.getElementById("addLSP-ma").value;
      if(MaLoaiSP == "") {
            customAlert("Vui lòng chọn 1 loại để sửa !");
            return
      }
      let TenLoaiSP = document.getElementById("addLSP-ten").value;
      if(checkForSpecialChar(TenLoaiSP) || TenLoaiSP.length < 4) {
            customAlert("Tên không được chứa ký tự đặc biệt !");
            return
      }
      let MoTaLoaiSP = document.getElementById('addLSP-mota').value;
      if(checkForSpecialChar(MoTaLoaiSP) || MoTaLoaiSP.length < 4) {
            customAlert("Mô tả không được chứa ký tự đặc biệt !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn sửa loại sản phẩm này ?")) {
            return
      }
      // Xóa khoảng trắng dư thừa
      MoTaLoaiSP = MoTaLoaiSP.trim().replace(/\s+/g, ' ');  
      $.ajax({
            url: "Controller/LoaiSanPhamController.php",
            method: "POST",
            data: { 
                  action : "update_loaiSP",
                  MaLoaiSP : MaLoaiSP,
                  TenLoaiSP : TenLoaiSP,
                  MoTaLoaiSP : MoTaLoaiSP
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Sửa loại sản phẩm thành công !","success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                        
                  } else if(response == "error"){
                        customAlert("Sửa loại sản phẩm thất bại !");
                  }else if(response == "error_existedTen"){
                        customAlert("Tên loại sản phẩm đã tồn tại !");
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
async  function deleteLoaiSP() {
      let MaLoaiSP = document.getElementById("addLSP-ma").value;
      if(MaLoaiSP == "") {
            customAlert("Vui lòng chọn 1 loại để xóa !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn xóa loại sản phẩm này ?")) {
            return
      }
      $.ajax({
            url: "Controller/LoaiSanPhamController.php",
            method: "POST",
            data: { 
                  action : "delete_loaiSP",
                  MaLoaiSP : MaLoaiSP,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Xóa loại sản phẩm thành công !","success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Xóa loại sản phẩm thất bại !");
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
function refeshLoaiSP() {
      let MaLoaiSP = document.getElementById("addLSP-ma");
      MaLoaiSP.value = "";
      let TenLoaiSP = document.getElementById("addLSP-ten");
      TenLoaiSP.value = "";
      let MoTaLoaiSP = document.getElementById('addLSP-mota');
      MoTaLoaiSP.value = "";
}