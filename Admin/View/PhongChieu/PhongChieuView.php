<div id="PhongChieu-wrapper">
      <center><h1>Quản Lý Người Dùng</h1></center>
      <table id="PhongChieu-table">
            <thead>
            <tr>
                  <th>Tên Phòng Chiếu</th>
                  <th>Số Lượng Ghế</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php
                        foreach($listPhongChieu as $phongchieu) {
                              echo "<tr>";
                              echo "<td class='phongchieu-tenphongchieu'>$phongchieu[TenPhongChieu]</td>";
                              echo "<td class='phongchieu-soluongghe'>$phongchieu[SoLuongGhe]</td>";
                              echo "<td class='phongchieu-thaotac' onclick='window.location.href=\"index.php?ctrl=Phòng Chiếu&move=SuaPhongChieu&id=$phongchieu[MaPhongChieu]\"'>Sửa</td>";
                              echo "</tr>";
                        }
                        
                  ?>    
            </tbody>
      </table>
</div>