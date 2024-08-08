
<div id="SuaPhongChieu-wrapper">
      <center><h1>Sửa Phòng Chiếu</h1></center>
      <br>
      <div>
            <div>
                  <h3>Tên Phòng Chiếu</h3>
                  <input type="text" id="SuaPhongChieu-tenphongchieu" value="<?php echo $phongChieu['TenPhongChieu']?>">
            </div>
            <div>
                  <h3>Số Lượng Ghế</h3>
                  <input type="text" id="SuaPhongChieu-soluongghe" value="<?php echo $phongChieu['SoLuongGhe']?>">
            </div>
            <center>
                  <button id="update-SuaPhongChieu" onclick="suaPhongChieu(<?php echo $phongChieu['MaPhongChieu']?>)">Xác nhận</button>
                  <button id="close-SuaPhongChieu" onclick="window.location.href='index.php?ctrl=Phòng Chiếu'">Đóng</button>
            </center>
      </div>
</div>