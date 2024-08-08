
<div id="updateLichChieu-wrapper">
      <center><h2>Cập Nhật Lịch Chiếu Phim</h2></center>
      <center><h2><?php echo $phim['TenPhim'] ?></h2></center>
      <center class="line"></center>
      <div id="updateLichChieu-container">
            <div id="updateLichChieu-ngaychieu-container">
                  <h3><label for="updateLichChieu-ngaychieu">Ngày Chiếu</label></h3>
                  <input type="date" name="updateLichChieu-ngaychieu" id="updateLichChieu-ngaychieu" onchange="checkInput()">
                  <p class="error" id="updateLichChieu-ngaychieu-error">Ngày Chiếu không hợp lệ</p>
            </div>
            <div id="updateLichChieu-phongchieu-container">
                  <h3><label for="updateLichChieu-phongchieu">Phòng Chiếu</label></h3>
                  <select name="updateLichChieu-phongchieu" id="updateLichChieu-phongchieu" onchange="checkInput()">
                        <option name="updateLichChieu-phongchieu" value="0"> - Chọn Phòng Chiếu - </option>
                        <?php
                              foreach ($phongChieu as $phong) {
                              echo '<option name="updateLichChieu-phongchieu" value="' . $phong['MaPhongChieu'] . '">' . $phong['TenPhongChieu'] . ' - ' . $phong['SoLuongGhe'] . '</option>';
                              }
                        ?>
                  </select>
                  <p class="error" id="updateLichChieu-phongchieu-error">Phòng Chiếu không hợp lệ</p>
            </div>
            <div id="updateLichChieu-xuatchieu-container">
            </div>
      </div>
      <center>
            <button id="update-updateLichChieu" onclick="updateLichChieu(<?php echo $phim['MaPhim']?>)">Xác Nhận</button>
            <button id="close-updateLichChieu" onclick="window.location.href='index.php?ctrl=Lịch Chiếu'">Đóng</button>
      </center>
</div>