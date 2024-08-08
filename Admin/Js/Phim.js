function addTypePhim() {
      let TenLoaiPhim = document.getElementById("typePhimAdd-tenloaiphim").value;
      console.log(TenLoaiPhim)
      let MoTa = document.getElementById('typePhimAdd-mota').value;
      console.log(MoTa)
      // Xóa khoảng trắng dư thừa
      MoTa = MoTa.trim().replace(/\s+/g, ' ');
      $.ajax({
            url: "Controller/PhimController.php",
            method: "POST",
            data: { 
                  action : "add_typePhim",
                  TenLoaiPhim : TenLoaiPhim,
                  MoTa : MoTa
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        alert("Thêm loại phim thành công !");
                        window.location.reload();
                  } else if(response == "error"){
                        alert("Thêm loại phim thất bại !");
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
function addPhim() {
      let tenphim = document.getElementById("phimAdd-tenphim").value;
      let anhphimnho = document.getElementById("phimAdd-anhphimnho").value;
      let anhphimlon = document.getElementById("phimAdd-anhphimlon").value;
      let trailer = document.getElementById("phimAdd-trailer").value;
      let thongtin = document.getElementById("phimAdd-thongtin").value;
      let tuoiyeucau = document.getElementById("phimAdd-tuoiyeucau").value;
      let thoiluongphim = document.getElementById("phimAdd-thoiluongphim").value;
      let ngaykhoichieu = document.getElementById("phimAdd-ngaykhoichieu").value;
      let xuatxu = document.getElementById("phimAdd-xuatxu").value;
      let nhasanxuat = document.getElementById("phimAdd-nhasanxuat").value;
      let theloai = $('#phimAdd-theloai').val();
      let trangthai = document.getElementById("phimAdd-trangthai").value;
      $.ajax({
            url: "Controller/PhimController.php",
            method: "POST",
            data: { 
                  action : "add_phim",
                  TenPhim : tenphim,
                  AnhPhimNho : anhphimnho,
                  AnhPhimLon : anhphimlon,
                  Trailer : trailer,
                  ThongTin : thongtin,
                  TuoiYeuCau : tuoiyeucau,
                  ThoiLuongPhim : thoiluongphim,
                  NgayKhoiChieu : ngaykhoichieu,
                  XuatXu : xuatxu,
                  NhaSanXuat : nhasanxuat,
                  TheLoai : theloai,
                  TrangThai : trangthai,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        alert("Thêm phim thành công !");
                        window.location.reload();
                  } else if(response == "error"){
                        alert("Thêm phim thất bại !");
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
function updatePhim(maphim) {
      let tenphim = document.getElementById("phimUpdate-tenphim").value;
      let anhphimnho = document.getElementById("phimUpdate-anhphimnho").value;
      let anhphimlon = document.getElementById("phimUpdate-anhphimlon").value;
      let trailer = document.getElementById("phimUpdate-trailer").value;
      let thongtin = document.getElementById("phimUpdate-thongtin").value;
      let tuoiyeucau = document.getElementById("phimUpdate-tuoiyeucau").value;
      let thoiluongphim = document.getElementById("phimUpdate-thoiluongphim").value;
      let ngaykhoichieu = document.getElementById("phimUpdate-ngaykhoichieu").value;
      let xuatxu = document.getElementById("phimUpdate-xuatxu").value;
      let nhasanxuat = document.getElementById("phimUpdate-nhasanxuat").value;
      let trangthai = document.getElementById("phimUpdate-trangthai").value;
      $.ajax({
            url: "Controller/PhimController.php",
            method: "POST",
            data: { 
                  action : "update_phim",
                  MaPhim : maphim,
                  TenPhim : tenphim,
                  AnhPhimNho : anhphimnho,
                  AnhPhimLon : anhphimlon,
                  Trailer : trailer,
                  ThongTin : thongtin,
                  TuoiYeuCau : tuoiyeucau,
                  ThoiLuongPhim : thoiluongphim,
                  NgayKhoiChieu : ngaykhoichieu,
                  XuatXu : xuatxu,
                  NhaSanXuat : nhasanxuat,
                  TrangThai : trangthai,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        alert("Cập nhập thông tin phim thành công !");
                        window.location.reload();
                  } else if(response == "error"){
                        alert("Cập nhập thông tin phim thất bại !");
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
function updateLoaiPhim(maloaiphim) {
      let TenLoaiPhim= document.getElementById("typePhimUpdate-tenloaiphim").value;
      let MoTa = document.getElementById('typePhimUpdate-mota').value;
      // Xóa khoảng trắng dư thừa
      MoTa = MoTa.trim().replace(/\s+/g, ' ');
      $.ajax({
            url: "Controller/PhimController.php",
            method: "POST",
            data: { 
                  action : "update_typePhim",
                  MaLoaiPhim : maloaiphim,
                  TenLoaiPhim : TenLoaiPhim,
                  MoTa : MoTa,
            },
            success : function(response){
                  console.log(response);
                  if(response == "success") {
                        alert("Cập nhập thông tin loại phim thành công !");
                        window.location.reload();
                  } else if(response == "error"){
                        alert("Cập nhập thông tin loại phim thất bại !");
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
