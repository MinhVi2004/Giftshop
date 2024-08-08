<div id="NguoiDung-wrapper">
      <center><h1>Quản Lý Người Dùng</h1></center>
      <table id="NguoiDung-table">
            <thead>
            <tr>
                  <th>Họ Tên</th>
                  <th>Ngày Sinh</th>
                  <th>Số Điện Thoại</th>
                  <th>Trạng Thái</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php
                        foreach($listNguoiDung as $nguoiDung) {
                              if($nguoiDung['VaiTro'] != "Quản Trị Viên" && $nguoiDung['MaTaiKhoan'] != $_SESSION['UserLogin']['MaTaiKhoan']) {
                                    echo "<tr>";
                                    echo "<td class='NguoiDung-hoten'>$nguoiDung[HoTen]</td>";
                                    echo "<td class='NguoiDung-ngaysinh'>$nguoiDung[NgaySinh]</td>";
                                    echo "<td class='NguoiDung-sodienthoai'>$nguoiDung[SoDienThoai]</td>";
                                    echo "<td class='NguoiDung-trangthai'>$nguoiDung[TrangThai]</td>";
                                    if($nguoiDung['TrangThai'] == "Đang Hoạt Động") {
                                          echo "<td class='NguoiDung-thaotac NguoiDung-thaotac-khoa' onclick='khoaTaiKhoan($nguoiDung[MaTaiKhoan])'>Khóa Tài Khoản</td>";
                                    } else {
                                          echo "<td class='NguoiDung-thaotac NguoiDung-thaotac-mokhoa' onclick='moKhoaTaiKhoan($nguoiDung[MaTaiKhoan])'>Mở Khóa Tài Khoản</td>";
                                    }
                                    echo "</tr>";
                              }
                        }
                  ?>    
            </tbody>
      </table>
</div>