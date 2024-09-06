
<div id="phim-wrapper">
      <center>
            <button onclick="window.location.href='index.php?ctrl=Phim&move=PhimAddView'" id="movePhimAddView">Thêm Phim</button>
            <button onclick="window.location.href='index.php?ctrl=Phim&move=TypePhimView'" id="moveTypePhimView">Loại Phim</button>
      </center>
      <center><h2>Quản Lý Danh Sách Phim</h2></center>
      <table id="phim-table">
            <thead>
            <tr>
                  <th>Ảnh</th>
                  <th>Tên</th>
                  <th>Ngày Khởi Chiếu</th>
                  <th>Trạng Thái</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php
                        foreach($listPhim as $phim) {
                              echo "<tr>";
                              echo "<td class='phim-anhphimnho'><img src='../IMG/Web/$phim[AnhPhimNho]'></td>";
                              echo "<td class='phim-tenphim'>$phim[TenPhim]</td>";
                              echo "<td class='phim-ngaykhoichieu'>$phim[NgayKhoiChieu]</td>";
                              echo "<td class='phim-trangthai'>$phim[TrangThai]</td>";
                              echo "<td class='phim-thaotac'><button onclick='window.location.href=\"index.php?ctrl=Phim&move=PhimDetailView&id=$phim[MaPhim]\"'>Chi tiết</button></td>";
                              echo "</tr>";
                        }
                  ?>    
            </tbody>
      </table>
</div>