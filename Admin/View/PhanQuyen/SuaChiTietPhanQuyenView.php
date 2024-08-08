
<div id="PhanQuyen-wrapper">
      <center><h2>Sửa Chi Tiết Phân Quyền <span id="vaiTro-ChiTietPhanQuyen" data-vai-tro="<?php echo $_GET['VaiTro'] ?>"><?php echo $_GET['VaiTro'] ?></span></h2></center>
      <br>
      <div>
            <div>
                  <h3>QL Phim</h3>
                  <input type="checkbox" id="ChiTietPhanQuyen-qlphim" <?php if($phanQuyen['Phim'] == 1) echo" checked ";?>>
            </div>
            <div>
                  <h3>QL Người Dùng</h3>
                  <input type="checkbox" id="ChiTietPhanQuyen-qlnguoidung" <?php if($phanQuyen['Người Dùng'] == 1) echo" checked ";?>>
            </div>
            <div>
                  <h3>QL Phân Quyền</h3>
                  <input type="checkbox" id="ChiTietPhanQuyen-qlphanquyen" <?php if($phanQuyen['Phân Quyền'] == 1) echo" checked ";?>>
            </div>
            <div>
                  <h3>QL Lịch Chiếu</h3>
                  <input type="checkbox" id="ChiTietPhanQuyen-qllichchieu" <?php if($phanQuyen['Lịch Chiếu'] == 1) echo" checked ";?>>
            </div>
            <div>
                  <h3>QL Phòng Chiếu</h3>
                  <input type="checkbox" id="ChiTietPhanQuyen-qlphongchieu" <?php if($phanQuyen['Phòng Chiếu'] == 1) echo" checked ";?>>
            </div>
            <div>
                  <h3>QL Doanh Thu</h3>
                  <input type="checkbox" id="ChiTietPhanQuyen-qldoanhthu" <?php if($phanQuyen['Doanh Thu'] == 1) echo" checked ";?>>
            </div>
            <div>
                  <h3>QL Bình Luận</h3>
                  <input type="checkbox" id="ChiTietPhanQuyen-qlbinhluan" <?php if($phanQuyen['Bình Luận'] == 1) echo" checked ";?>>
            </div>
            <div>
                  <h3>QL Vé</h3>
                  <input type="checkbox" id="ChiTietPhanQuyen-qlve" <?php if($phanQuyen['Vé'] == 1) echo" checked ";?>>
            </div>
            <center>
                  <button id="update-ChiTietPhanQuyen" onclick="suaChiTietPhanQuyen()">Xác nhận</button>
                  <button id="close-ChiTietPhanQuyen" onclick="window.location.href='index.php?ctrl=Phân Quyền'">Đóng</button>
            </center>
      </div>
</div>