function suaPhanQuyenTaiKhoan(MaTaiKhoan) {
      let PhanQuyen = document.getElementById("PhanQuyen-vaitro").value;
      if(confirm("Bạn có muốn đổi vai trò của tài khoản này thành " + PhanQuyen + " ?")) {
            $.ajax({
                  url: "Controller/PhanQuyenController.php",
                  method: "POST",
                  data: { 
                        action : "suaPhanQuyen",
                        MaTaiKhoan : MaTaiKhoan,
                        VaiTro : PhanQuyen,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              alert("Cập nhật vai trò người dùng thành công !");
                              window.location.href="index.php?ctrl=Phân Quyền";
                        } else if(response == "error"){
                              alert("Cập nhật vai trò người dùng thất bại !");
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
function suaChiTietPhanQuyen() {
      let vaiTro = document.getElementById("vaiTro-ChiTietPhanQuyen").dataset.vaiTro;
      let phim = document.getElementById("ChiTietPhanQuyen-qlphim").checked ? 1 : 0;
      let nguoidung = document.getElementById("ChiTietPhanQuyen-qlnguoidung").checked ? 1 : 0;
      let phanquyen = document.getElementById("ChiTietPhanQuyen-qlphanquyen").checked ? 1 : 0;
      let lichchieu = document.getElementById("ChiTietPhanQuyen-qllichchieu").checked ? 1 : 0;
      let phongchieu = document.getElementById("ChiTietPhanQuyen-qlphongchieu").checked ? 1 : 0;
      let doanhthu = document.getElementById("ChiTietPhanQuyen-qldoanhthu").checked ? 1 : 0;
      let binhluan = document.getElementById("ChiTietPhanQuyen-qlbinhluan").checked ? 1 : 0;
      let ve = document.getElementById("ChiTietPhanQuyen-qlve").checked ? 1 : 0;
      if(confirm("Bạn có muốn thay đổi vai trò của phân quyền "+vaiTro+" ?")) {
            $.ajax({
                  url: "Controller/PhanQuyenController.php",
                  method: "POST",
                  data: { 
                        action : "suaChiTietPhanQuyen",
                        phim : phim,
                        vaitro : vaiTro,
                        nguoidung : nguoidung,
                        phanquyen : phanquyen,
                        lichchieu : lichchieu,
                        phongchieu : phongchieu,
                        doanhthu : doanhthu,
                        binhluan : binhluan,
                        ve : ve,
                  },
                  success : function(response){
                        console.log(response);
                        if(response == "success") {
                              alert("Cập nhật phân quyền thành công !");
                              window.location.href="index.php?ctrl=Phân Quyền";
                        } else if(response == "error"){
                              alert("Cập nhật phân quyền thất bại !");
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