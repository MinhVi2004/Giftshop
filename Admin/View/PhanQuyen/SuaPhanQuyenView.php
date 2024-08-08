
<div id="PhanQuyen-wrapper">
      <center><h2>Thông tin chi tiết tài khoản</h2></center>
      <br>
      <div>
            <div>
                  <h3>Họ Tên :</h3>
                  <span id="PhanQuyen-hoten"><?php echo $nguoiDung['HoTen'] ?>
            </div>
            <div>
                  <h3>Số Điện Thoại :</h3>
                  <span id="PhanQuyen-sodienthoai"><?php echo $nguoiDung['SoDienThoai'] ?>
            </div>
            <div>
                  <h3>Email :</h3>
                  <span id="PhanQuyen-email"><?php echo $nguoiDung['Email'] ?>
            </div>
            <div>
                  <h3>Vai Trò :</h3>
                  <span>
                        <select name="PhanQuyen-vaitro" id="PhanQuyen-vaitro">
                              <?php
                                    foreach($listPhanQuyen as $phanQuyen) {
                                          if($phanQuyen['VaiTro'] == "Quản Trị Viên") {
                                                continue;
                                          }
                                          if($nguoiDung['VaiTro'] == $phanQuyen['VaiTro']) {
                                                echo "<option value='$phanQuyen[VaiTro]' selected>$phanQuyen[VaiTro]</option>";
                                          } else {
                                                echo "<option value='$phanQuyen[VaiTro]'>$phanQuyen[VaiTro]</option>";
                                          }
                                    }
                              ?>
                              
                        </select>
                  </span>
            </div>
            <center>
                  <button id="update-PhanQuyen" onclick="suaPhanQuyenTaiKhoan(<?php echo $nguoiDung['MaTaiKhoan']?>)">Xác nhận</button>
                  <button id="close-PhanQuyen" onclick="window.location.href='index.php?ctrl=Phân Quyền'">Đóng</button>
            </center>
      </div>
</div>