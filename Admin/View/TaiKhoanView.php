<div id="TaiKhoan-wrapper">
      <center><h1>Quản Lý Tài Khoản</h1></center>
      <center>
      <table id="TaiKhoan-table">
            <thead>
            <tr>
                  <th>#</th>
                  <th>Họ Tên</th>
                  <th>Số Điện Thoại</th>
                  <th>Ngày Tạo</th>
                  <th>Trạng Thái</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php
                        if($listTaiKhoan!=null) {
                              $i = 1;
                              foreach($listTaiKhoan as $taiKhoan) {
                                    if($taiKhoan['PhanQuyen'] != "Quản Lý" && $taiKhoan['MaTK'] != $_SESSION['GiftShopUser']['MaTK']) {
                                          echo "<tr>";
                                          echo "<td class='TaiKhoan-stt'>$i</td>";
                                          echo "<td class='TaiKhoan-hoten'>$taiKhoan[HoTen]</td>";
                                          echo "<td class='TaiKhoan-sodienthoai'>$taiKhoan[SoDienThoaiTK]</td>";
                                          echo "<td class='TaiKhoan-ngaytao'>$taiKhoan[NgayTao]</td>";
                                          echo "<td class='TaiKhoan-trangthai'>$taiKhoan[TrangThai]</td>";
                                          echo "
                                          <td class='TaiKhoan-thaotac'>
                                                <button class='TaiKhoan-chitiet' onclick='openChiTietTaiKhoan(\"".$taiKhoan['MaTK']."\")'>Chi Tiết</button>
                                          </td>";
                                          // echo "<td class='TaiKhoan-thaotac TaiKhoan-thaotac-khoiphuc'  onclick='khoiPhucMatKhau($taiKhoan[MaTK])'>Khôi Phục</td>";
                                          echo "</tr>";
                                          $i++;
                                    }
                              }
                        }
                  ?>    
            </tbody>
      </table>
      </center>
      <div id="modal-chiTietTaiKhoan">
                  <!-- <div id="chiTietTaiKhoan">
                        <button id="closeChiTietTaiKhoan" onclick="closeChiTietTaiKhoan()" type="button"><i class="fa-solid fa-xmark"></i></button>
                        <h2>Chi Tiết Tài Khoản</h2>
                        <center><img src="../IMG/Avatar/user-default.png"></center>
                        <h5>Mã Tài Khoản</h5>
                        <h5>Loại Tài Khoản</h5>
                        <h5>Họ Tên</h5>
                        <h5>Số Điện thoại</h5>
                        <h5>Email</h5>
                        <h5>Địa Chỉ</h5>
                        <h5>Ngày Đăng Ký</h5>
                        <p>05=2==20244</p>
                        <h5>Phân Quyền</h5>
                        <select name="chiTietTaiKhoan-phanquyen" id="chiTietTaiKhoan-phanquyen">
                              <option value="Khách Hàng">Khách Hàng</option>
                              <option value="Quản Lý">Quản Lý</option>
                        </select>
                        <h5>Trạng Thái</h5>
                        <select name="chiTietTaiKhoan-trangthai" id="chiTietTaiKhoan-trangthai">
                              <option value="Bình Thường">Bình Thường</option>
                              <option value="Vô Hiệu Hóa">Vô Hiệu Hóa</option>
                        </select>
                        <div id="chiTietTaiKhoan-thaotac">
                              <button>Xác Nhận</button>

                        </div>
                  </div> -->
      </div>
</div>