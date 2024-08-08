
<div id="typePhim-wrapper">
      <center>
            <button onclick="window.location.href='index.php?ctrl=Phim&move=TypePhimAddView'" id="moveTypePhimAddView">Thêm Loại Phim</button>
            <button onclick="window.location.href='index.php?ctrl=Phim'" id="movePhimView">Danh Sách Phim</button>
      </center>
      <center><h2>Quản Lý Thể Loại Phim</h2></center>
      <table id="typePhim-table">
            <thead>
            <tr>
                  <th>Mã Loại Phim</th>
                  <th>Tên Thể Loại</th>
                  <th>Mô Tả</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php
                        foreach($listTypePhim as $type) {
                              echo "<tr>";
                              echo "<td class='typePhim-maloaiphim'>$type[MaLoaiPhim]</td>";
                              echo "<td class='typePhim-tenloaiphim'>$type[TenLoaiPhim]</td>";
                              echo "<td class='typePhim-mota'>$type[MoTa]</td>";
                              echo "<td class='typePhim-thaotac'><button onclick='window.location.href=\"index.php?ctrl=Phim&move=TypePhimUpdateView&id=$type[MaLoaiPhim]\"'>Sửa</button></td>";
                              echo "</tr>";
                        }
                  ?>    
            </tbody>
      </table>
</div>