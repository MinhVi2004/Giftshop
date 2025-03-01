function moveBuyView() {
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "getQuantityGioHang",
            },
            success : async function(response){
                  if(response == "success") {
                        window.location.href = "index.php?ctrl=buyView";
                  } else if(response == "error"){
                        customAlert("Vui lòng thêm sản phẩm vào giỏ hàng để mua hàng !");
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
function updateKhuyenMaiPrice() {
      let totalElement =  document.getElementById("buy-total");
      let selectedKhuyenMai = $("input[name='selectKhuyenMai']:checked").val();
      let phanTramGiamGia = 0;
      if(selectedKhuyenMai == null) {
            phanTramGiamGia = 0;
      } else {
            let phanTramElement = document.getElementById("buy-khuyenmai-item-chitietkhuyenmai-"+selectedKhuyenMai);
      
            phanTramGiamGia = phanTramElement.getAttribute("data-value");
      }
      let total = totalElement.getAttribute("data-value");

      let tienGiamGia = Math.floor(total * (phanTramGiamGia /100));
      document.getElementById("buy-discount").setAttribute("data-value", tienGiamGia);
      document.getElementById("buy-discount").innerText = tienGiamGia.toLocaleString('vi-VN') + " đ";

      let final =  total - tienGiamGia;
      let formattedAmount = final.toLocaleString('vi-VN');
      document.getElementById("buy-final").setAttribute("data-value",final);
      document.getElementById("buy-final").innerText = formattedAmount + " đ";
}
async function buy() {
      if (isAddingCart) return; // Nếu đang xử lý, không cho phép nhấn tiếp
            isAddingCart = true;
            
      let MaDC = $("input[name='selectAddress']:checked").val();
      if (!MaDC) {
            isAddingCart = false;
            customAlert("Vui lòng chọn địa chỉ giao hàng !");
            return;
      }
      let TongGiaTri = document.getElementById("buy-total").getAttribute("data-value");
      let TienGiamGia = document.getElementById("buy-discount").getAttribute("data-value");
      let TongThanhToan = document.getElementById("buy-final").getAttribute("data-value");
      let MaKM = $("input[name='selectKhuyenMai']:checked").val();
      if (!MaKM) MaKM = "";  // Đảm bảo MaKM không bị undefined
      if( !await customConfirm("Xác nhận đặt hàng ?")) {
            isAddingCart = false;
            return;
      }
      // console.log(MaDC 
      //       +MaKM,
      //       +TongGiaTri,
      //       +TienGiamGia,
      //       +TongThanhToan)
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "buy",   
                  MaDC : MaDC,
                  MaKM : MaKM,
                  TongGiaTri : TongGiaTri,
                  TienGiamGia : TienGiamGia,
                  TongThanhToan : TongThanhToan,
            },
            success : async function(response){
                  if(response.match(/^success/)) {
                        customAlert("Đặt hàng thành công !", "success");
                        setTimeout(() => {
                              window.location.href="index.php";
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Đặt hàng thất bại !");
                  } else {
                        console.log(response);
                        customAlert("Lỗi khác")
                  }
            },
            error: function(xhr, status, error) {
                  console.error("Status: " + status);
                  console.error("Error: " + error);
                  console.error("Response: " + xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
            },
            complete: function() {
                  setTimeout(() => {
                        isAddingCart = false;
                  }, 1300); // Ngăn spam click trong 1 giây
            }
      });
}

async function huyDonHang(MaDH) {
      if (isAddingCart) 
            return; // Nếu đang xử lý, không cho phép nhấn tiếp
      isAddingCart = true;
      if( !await customConfirm("Bạn có chắc muốn hủy đơn hàng này ?")) {
            return;
      }
      // console.log(MaDC 
      //       +MaKM,
      //       +TongGiaTri,
      //       +TienGiamGia,
      //       +TongThanhToan)
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "huyDonHang",   
                  MaDH : MaDH
            },
            success : async function(response){
                  if(response == "success") {
                        customAlert("Hủy đơn hàng thành công !", "success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Hủy đơn hàng thất bại !");
                  } else {
                        console.log(response);
                        customAlert("Lỗi khác")
                  }
            },
            error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  customAlert("Lỗi trong quá trình xử lý Ajax.");
            },
            complete: function() {
                  setTimeout(() => {
                        isAddingCart = false;
                  }, 1300); // Ngăn spam click trong 1 giây
            }
      });
}