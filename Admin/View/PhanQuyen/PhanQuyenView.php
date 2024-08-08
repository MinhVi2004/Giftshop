
<div id="PhanQuyen-wrapper">
      <table id="PhanQuyen-table">
            <thead>
            <tr>
                  <th>Họ Tên</th>
                  <th>Số điện thoại</th>
                  <th>Email</th>
                  <th>Vai Trò</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php
                        foreach($listNguoiDung as $NguoiDung) {
                              if($NguoiDung['VaiTro'] != "Quản Trị Viên" && $NguoiDung['MaTaiKhoan'] != $_SESSION['UserLogin']['MaTaiKhoan']) {
                                    echo "<tr>";
                                    echo "<td class='PhanQuyen-hoten'>$NguoiDung[HoTen]</td>";
                                    echo "<td class='PhanQuyen-sodienthoai'>$NguoiDung[SoDienThoai]</td>";
                                    echo "<td class='PhanQuyen-email'>$NguoiDung[Email]</td>";
                                    echo "<td class='PhanQuyen-vaitro'>$NguoiDung[VaiTro]</td>";
                                    echo "<td class='PhanQuyen-thaotac PhanQuyen-thaotac-suavaitro' onclick='window.location.href=\"index.php?ctrl=Phân Quyền&move=SuaPhanQuyen&id=$NguoiDung[MaTaiKhoan]\"'>Sửa Vai Trò</td>";
                                    echo "</tr>";
                              }
                        }
                  ?>    
            </tbody>
      </table>
      <center><a href="index.php?ctrl=Phân Quyền&move=ChiTietPhanQuyen"><button id="capNhatPhanQuyen-btn">Cập Nhật Phân Quyền</button></a></center>
</div>