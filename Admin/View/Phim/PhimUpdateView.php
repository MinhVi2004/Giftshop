
<div id="phimUpdate-wrapper">
      <center><h2>Cập nhật thông tin phim</h2></center>
      <form>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-tenphim">Tên Phim :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-tenphim" id="phimUpdate-tenphim" value="<?php echo $phim['TenPhim'] ?>">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-anhphimnho">Ảnh Poster Nhỏ :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-anhphimnho" id="phimUpdate-anhphimnho" value="<?php echo $phim['AnhPhimNho'] ?>">
                  <img src="" alt="" id="phimUpdate-anhphimnho-img">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-anhphimlon">Ảnh Poster Lớn :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-anhphimlon" id="phimUpdate-anhphimlon" value="<?php echo $phim['AnhPhimLon'] ?>">
                  <img src="" alt="" id="phimUpdate-anhphimlon-img">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-trailer">Mã video trailer :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-trailer" id="phimUpdate-trailer" value="<?php echo $phim['Trailer'] ?>">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-thongtin">Nội dung :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-thongtin" id="phimUpdate-thongtin" value="<?php echo $phim['ThongTin'] ?>">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-tuoiyeucau">Tuổi yêu cầu :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-tuoiyeucau" id="phimUpdate-tuoiyeucau" value="<?php echo $phim['TuoiYeuCau'] ?>">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-thoiluongphim">Thời Lượng Phim :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-thoiluongphim" id="phimUpdate-thoiluongphim" value="<?php echo $phim['ThoiLuongPhim'] ?>">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-ngaykhoichieu">Ngày Khởi Chiếu :</label>
                  <input class="phimUpdate-input" type="date" name="phimUpdate-ngaykhoichieu" id="phimUpdate-ngaykhoichieu" value="<?php echo $phim['NgayKhoiChieu'] ?>">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-xuatxu">Xuất Xứ :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-xuatxu" id="phimUpdate-xuatxu" value="<?php echo $phim['XuatXu'] ?>">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-nhasanxuat">Nhà Sản Xuất :</label>
                  <input class="phimUpdate-input" type="text" name="phimUpdate-nhasanxuat" id="phimUpdate-nhasanxuat" value="<?php echo $phim['NhaSanXuat'] ?>">
            </div>
            <div>
                  <label class="phimUpdate-label" for="phimUpdate-trangthai">Trạng Thái :</label>
                  <select class="phimUpdate-select" name="phimUpdate-trangthai" id="phimUpdate-trangthai">
                        <?php
                              if($phim['TrangThai'] == "Sắp Chiếu") {
                                    echo "<option value='Sắp Chiếu' selected>Sắp Chiếu</option>
                                    <option value='Đang Chiếu'>Đang Chiếu</option>
                                    <option value='Ẩn Phim'>Ẩn Phim</option>";
                              } else if($phim['TrangThai'] == "Đang Chiếu") {
                                    echo "<option value='Sắp Chiếu'>Sắp Chiếu</option>
                                    <option value='Đang Chiếu' selected>Đang Chiếu</option>
                                    <option value='Ẩn Phim'>Ẩn Phim</option>";
                              } else {
                                    echo "<option value='Sắp Chiếu'>Sắp Chiếu</option>
                                    <option value='Đang Chiếu'>Đang Chiếu</option>
                                    <option value='Ẩn Phim' selected>Ẩn Phim</option>";
                              }
                        ?>

                  </select>
            </div>
      </form>
      <center>
            <button id="update-phimUpdate" onclick="updatePhim(<?php echo $phim['MaPhim']?>)">Xác nhận</button>
            <button id="close-phimUpdate" onclick="window.location.href='index.php?ctrl=Phim'">Đóng</button>
      </center>
</div>