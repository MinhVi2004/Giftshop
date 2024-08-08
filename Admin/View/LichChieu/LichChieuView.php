
<div id="LichChieu-wrapper">
<center><h2>Quản Lý Lịch Chiếu</h2></center>
      <table id="LichChieu-table">
            <thead>
            <tr>
                  <th>Tên</th>
                  <th>Poster</th>
                  <th>Tuổi Yêu Cầu</th>
                  <th>Thời Lượng</th>
                  <th>Ngày Khởi Chiếu</th>
                  <th>Xuất Xứ</th>
                  <th>Nhà Sản Xuất</th>
                  <th>Trạng Thái</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php
                        foreach($listPhim as $phim) {
                              echo "<tr>";
                              echo "<td class='LichChieu-tenphim'>$phim[TenPhim]</td>";
                              echo "<td class='LichChieu-anhphimnho'><img src='../IMG/$phim[AnhPhimNho]'></td>";
                              echo "<td class='LichChieu-tuoiyeucau'>$phim[TuoiYeuCau]</td>";
                              echo "<td class='LichChieu-thoiluongphim'>$phim[ThoiLuongPhim]</td>";
                              echo "<td class='LichChieu-ngaykhoichieu'>$phim[NgayKhoiChieu]</td>";
                              echo "<td class='LichChieu-xuatxu'>$phim[XuatXu]</td>";
                              echo "<td class='LichChieu-nhasanxuat'>$phim[NhaSanXuat]</td>";
                              echo "<td class='LichChieu-trangthai'>$phim[TrangThai]</td>";
                              echo "<td class='LichChieu-thaotac'><button onclick='window.location.href=\"index.php?ctrl=Lịch Chiếu&move=UpdateLichChieuView&id=$phim[MaPhim]\"'>Thêm Lịch Chiếu</button></td>";
                              echo "</tr>";
                        }
                  ?>    
            </tbody>
      </table>
</div>