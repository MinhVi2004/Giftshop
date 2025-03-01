function chiTietSP(Ma, Ten, Anh, Gia, MoTa) {
      let MaSP = document.getElementById("addSP-ma");
      MaSP.value = Ma;
      let TenSP = document.getElementById("addSP-ten");
      TenSP.value = Ten;
      let AnhSP = document.getElementById("addSP-showAnh");
      AnhSP.src = Anh;
      let GiaSP = document.getElementById("addSP-gia");
      GiaSP.value = Gia;
      let MoTaSP = document.getElementById('addSP-mota');
      MoTaSP.value = MoTa;
      let checkboxes = document.querySelectorAll('input[type="checkbox"][name="loaiSP"]');
      checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
      });
      $.ajax({
            url: "Controller/SanPhamController.php",
            method: "POST",
            data: { 
                  action : "getLoaiSP_SP",
                  MaSP : Ma,
            },
            success : function(response){
                  // console.log(response);
                  let data = JSON.parse(response);
                  if (data.status === "success") {
                        // Lặp qua dữ liệu và thêm vào bảng
                        data.data.forEach(function (row) {
                              // console.log(row.MaLoaiSP)
                              document.getElementById(row.MaLoaiSP).checked = true;
                        });
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
async function addSP() {
      let MaSP = document.getElementById("addSP-ma").value;
      if(MaSP !== "") {
            customAlert("Không thể thêm sản phẩm đã tồn tại !");
            return
      }
      let TenSP = document.getElementById("addSP-ten").value;
      if(checkForSpecialChar(TenSP) || TenSP.length <= 4) {
            customAlert("Tên nhiều hơn 4 ký tự và không được chứa ký tự đặc biệt !");
            return
      }
      // Kiểm tra file ảnh
      let AnhSP = document.getElementById("addSP-anh");
      if (AnhSP.files.length == 0) {
            customAlert("Vui lòng chọn ảnh sản phẩm.");
            return;
      }
      let GiaSP = document.getElementById("addSP-gia").value;
      if(checkForSpecialCharForPhoneNumber(GiaSP) ||isNaN(GiaSP) || GiaSP <= 0) {
            customAlert("Giá sản phẩm không âm và không được chứa ký tự đặc biệt !");
            return
      }
      let MoTaSP = document.getElementById('addSP-mota').value;
      if(checkForSpecialChar(MoTaSP) || MoTaSP.length < 4) {
            customAlert("Mô tả phải nhiều hơn 4 ký tự và không được chứa ký tự đặc biệt !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn thêm sản phẩm này ?")) {
            return
      }
      // Xóa khoảng trắng dư thừa
      MoTaSP = MoTaSP.trim().replace(/\s+/g, ' ');  
      let loaiSPData = [];
      let checkboxes = document.querySelectorAll('input[type="checkbox"][name="loaiSP"]');
      checkboxes.forEach((checkbox) => {
            if(checkbox.checked == true) {
                  // console.log(checkbox.value);
                  loaiSPData.push(checkbox.value);
            }
      });
      console.log(loaiSPData);
      let formData = new FormData(); // Khởi tạo formData

      // Thêm dữ liệu vào formData
      formData.append('action', 'add_SP');
      formData.append('TenSP', TenSP);
      formData.append('AnhSP', AnhSP.files[0]); // Đảm bảo gửi đúng file đầu tiên
      formData.append('GiaSP', GiaSP);
      formData.append('MoTaSP', MoTaSP);
      // Gửi từng phần tử trong mảng loaiSPData
      loaiSPData.forEach((loaiSP) => {
            formData.append('LoaiSPData[]', loaiSP); // Sử dụng 'LoaiSPData[]' để gửi mảng
      });
            $.ajax({
                  url: "Controller/SanPhamController.php",
                  method: "POST",
                  data: formData,
                  contentType: false,  // Ngăn jQuery tự động thêm Content-Type header
                  processData: false,  // Ngăn jQuery xử lý data (vì data đang là FormData
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              customAlert("Bạn đã thêm sản phẩm thành công !","success");
                              setTimeout(() => {
                                    window.location.reload();
                              }, 1000); // 1000 ms = 1 giây
                        } else if(response.match('error')){
                              console.log(response);
                              customAlert("Lỗi ");
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
async  function updateSP() {
      let MaSP = document.getElementById("addSP-ma").value;
      if(MaSP == "") {
            customAlert("Vui lòng chọn 1 sản phẩm để sửa !");
            return
      }
      let TenSP = document.getElementById("addSP-ten").value;
      if(checkForSpecialChar(TenSP) || TenSP.length < 4) {
            customAlert("Tên không được chứa ký tự đặc biệt !");
            return
      }
      // Kiểm tra file ảnh
      let AnhSP = document.getElementById("addSP-anh");
      let GiaSP = document.getElementById("addSP-gia").value;
      if(checkForSpecialCharForPhoneNumber(GiaSP)) {
            customAlert("Giá sản phẩm không được chứa ký tự đặc biệt !");
            return
      }
      let MoTaSP = document.getElementById('addSP-mota').value;
      if(checkForSpecialChar(MoTaSP) || MoTaSP.length < 4) {
            customAlert("Mô tả phải nhiều hơn 4 ký tự và không được chứa ký tự đặc biệt !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn sửa sản phẩm này ?")) {
            return
      }
      // Xóa khoảng trắng dư thừa
      MoTaSP = MoTaSP.trim().replace(/\s+/g, ' ');  
      let loaiSPData = [];
      let checkboxes = document.querySelectorAll('input[type="checkbox"][name="loaiSP"]');
      checkboxes.forEach((checkbox) => {
            if(checkbox.checked == true) {
                  // console.log(checkbox.value);
                  loaiSPData.push(checkbox.value);
            }
      });
      console.log(loaiSPData);
      let formData = new FormData(); // Khởi tạo formData

      // Thêm dữ liệu vào formData
      formData.append('action', 'update_SP');
      formData.append('MaSP', MaSP);
      formData.append('TenSP', TenSP);
      formData.append('AnhSP', AnhSP.files[0]); // Đảm bảo gửi đúng file đầu tiên
      formData.append('GiaSP', GiaSP);
      formData.append('MoTaSP', MoTaSP);
      // Gửi từng phần tử trong mảng loaiSPData
      loaiSPData.forEach((loaiSP) => {
            formData.append('LoaiSPData[]', loaiSP); // Sử dụng 'LoaiSPData[]' để gửi mảng
      });
            $.ajax({
                  
                  url: "Controller/SanPhamController.php",
                  method: "POST",
                  data: formData,
                  contentType: false,  // Ngăn jQuery tự động thêm Content-Type header
                  processData: false,  // Ngăn jQuery xử lý data (vì data đang là FormData
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              customAlert("Sửa sản phẩm thành công !","success");
                              setTimeout(() => {
                                    window.location.reload();
                              }, 1000); // 1000 ms = 1 giây
                              
                        } else if(response == "error"){
                              customAlert("Sửa sản phẩm thất bại !");
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
async  function deleteSP() {
      let MaSP = document.getElementById("addSP-ma").value;
      if(MaSP == "") {
            customAlert("Vui lòng chọn 1 sản phẩm để xóa !");
            return
      }
      if(! await customConfirm("Bạn có chắc muốn xóa sản phẩm này ?")) {
            return
      }
      $.ajax({
            url: "Controller/SanPhamController.php",
            method: "POST",
            data: { 
                  action : "delete_SP",
                  MaSP : MaSP,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        customAlert("Xóa sản phẩm thành công !","success");
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
            }
      });
}
function refeshSP() {
      let MaSP = document.getElementById("addSP-ma");
      MaSP.value = "";
      let TenSP = document.getElementById("addSP-ten");
      TenSP.value = "";
      let AnhSP = document.getElementById("addSP-showAnh");
      AnhSP.src = "";
      let GiaSP = document.getElementById("addSP-gia");
      GiaSP.value = "";
      let MoTaSP = document.getElementById('addSP-mota');
      MoTaSP.value = "";
      let checkboxes = document.querySelectorAll('input[type="checkbox"][name="loaiSP"]');
      checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
      });
}
function handleFileSelect(event) {
      // Đoạn mã JavaScript lấy giá trị của thẻ input
      let fileInput = document.getElementById('addSP-anh');
      let file = fileInput.files[0]; // Lấy tệp đầu tiên từ danh sách các tệp đã chọn

      if (file) {
            console.log(file); // Hiển thị tên tệp
      } else {
            console.log('Chưa chọn tệp nào');
      }
      // Lưu ảnh cũ trước khi thay đổi
      const imgElement = document.getElementById("addSP-showAnh");
      // previousImage = imgElement.src;  // Lưu đường dẫn ảnh hiện tại
      
      // Tạo đối tượng FileReader để đọc tệp ảnh
      const reader = new FileReader();

      // Khi tệp được đọc xong, thiết lập nguồn cho thẻ img
      reader.onload = function(e) {
            imgElement.src = e.target.result;  // Đặt đường dẫn ảnh mới
            imgElement.style.display = "block";  // Hiển thị ảnh
      };

      // Đọc tệp như một URL hình ảnh
      reader.readAsDataURL(file);
  }