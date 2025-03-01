function chiTietThongBao(MaTB) {
      let Ma = document.getElementById("addTB-ma");
      let TieuDe = document.getElementById("addTB-tieude");
      let NoiDung = document.getElementById("addTB-noidung");

      $.ajax({
            url: "Controller/ThongBaoController.php",
            method: "POST",
            data: { 
                  action : "getThongBaoByMaTB",
                  MaTB : MaTB,
            },
            success : function(response){
                  console.log(response);
                  let data = JSON.parse(response);
                  if (data.status === "success") {
                        let ThongBao = data.data;
                        Ma.value = MaTB;
                        TieuDe.value = ThongBao['TieuDe'];
                        NoiDung.value = ThongBao['NoiDung'];
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
async function addTB() {
      let MaTB = document.getElementById("addTB-ma").value;
      if(MaTB !== "") {
            customAlert("Không thể thêm thông báo đã tồn tại !");
            return
      }
      let TieuDe = document.getElementById("addTB-tieude").value;
      if(checkForSpecialChar(TieuDe) || TieuDe.length < 4) {
            customAlert("Tên thông báo phải trên 4 ký tự và không được chứa ký tự đặc biệt !");
            return
      }
      let NoiDung = document.getElementById('addTB-noidung').value;
      NoiDung = NoiDung.trim().replace(/\s+/g, ' ');  
      if(checkForSpecialChar(NoiDung) || NoiDung.length < 4) {
            customAlert("Nội dung không được chứa ký tự đặc biệt !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn thêm sản phẩm này ?")) {
            return
      }
      // Xóa khoảng trắng dư thừa
      $.ajax({
            url: "Controller/ThongBaoController.php",
            method: "POST",
            data: { 
                  action : "add_TB",
                  TieuDe : TieuDe,
                  NoiDung : NoiDung
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Thêm thông báo thành công !","success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error") {
                        customAlert("Thêm thông báo thất bại !");
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

async  function deleteTB() {
      let MaTB = document.getElementById("addTB-ma").value;
      if(MaTB == "") {
            customAlert("Vui lòng chọn 1 thông báo để xóa !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn xóa thông báo này ?")) {
            return
      }
      $.ajax({
            url: "Controller/ThongBaoController.php",
            method: "POST",
            data: { 
                  action : "delete_TB",
                  MaTB : MaTB,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Xóa thông báo thành công !","success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Xóa thông báo thất bại !");
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
function refeshTB() {
      let MaTB = document.getElementById("addTB-ma");
      MaTB.value = "";
      let TieuDe = document.getElementById("addTB-tieude");
      TieuDe.value = "";
      let NoiDung = document.getElementById('addTB-noidung');
      NoiDung.value = "";
}