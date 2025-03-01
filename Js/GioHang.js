
function increaseQuantityCart(MaTK, MaSP) {
      if (isAddingCart) return; // Nếu đang xử lý, không cho phép nhấn tiếp
      isAddingCart = true;
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "increaseItem_Cart",
                  MaTK : MaTK, 
                  MaSP : MaSP, 
            },
            success : async function(response){
                  if(response == "success") {
                        customAlert("Đã thêm số lượng 1 sản phẩm", "success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Thêm số lượng thất bại !");
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
function decreaseQuantityCart(MaTK, MaSP) {
      if (isAddingCart) return; // Nếu đang xử lý, không cho phép nhấn tiếp
      isAddingCart = true;
      let quantity = document.getElementById("cart-item-quantity-"+MaSP).value;
      if(quantity == 1) {
            deleteCartItem(MaTK, MaSP);
      } else {
            $.ajax({
                  url: "Controller/UserController.php",
                  method: "POST",
                  data: { 
                        action : "decreaseItem_Cart",
                        MaTK : MaTK, 
                        MaSP : MaSP, 
                  },
                  success : async function(response){
                        if(response == "success") {
                              customAlert("Đã giảm số lượng 1 sản phẩm", "success");
                              setTimeout(() => {
                                    window.location.reload();
                              }, 1000); // 1000 ms = 1 giây
                        } else if(response == "error"){
                              customAlert("Giảm số lượng thất bại !");
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
}
async function deleteCartItem(MaTK, MaSP) {
      if (isAddingCart) return; // Nếu đang xử lý, không cho phép nhấn tiếp
      isAddingCart = true;
      if(! await customConfirm("Bạn có chắc muốn xóa sản phẩm này ?")) {
            return
      }
      $.ajax({
            url: "Controller/UserController.php",
            method: "POST",
            data: { 
                  action : "deleteItem_Cart",
                  MaTK : MaTK, 
                  MaSP : MaSP, 
            },
            success : async function(response){
                  if(response == "success") {
                        customAlert("Đã xóa 1 sản phẩm trong giỏ hàng", "success");
                        setTimeout(() => {
                              window.location.reload();
                        }, 1000); // 1000 ms = 1 giây
                  } else if(response == "error"){
                        customAlert("Xóa sản phẩm thất bại !");
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