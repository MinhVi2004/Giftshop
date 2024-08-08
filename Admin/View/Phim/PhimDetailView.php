
<div id="phimDetail-wrapper">
      <center><h2>Thông tin chi tiết phim</h2></center>
      <form>
            <div>
                  <label class="phimDetail-label" for="phimDetail-tenphim">Tên Phim :</label>
                  <input disabled type="text" name="phimDetail-tenphim" id="phimDetail-tenphim" class="phimDetail-input" value="<?php echo $phim['TenPhim'] ?>">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-anhphimnho">Ảnh Poster Nhỏ :</label>
                  <input disabled type="text" name="phimDetail-anhphimnho" id="phimDetail-anhphimnho" class="phimDetail-input" value="<?php echo $phim['AnhPhimNho'] ?>">
                  <img src="" alt="" id="phimDetail-anhphimnho-img">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-anhphimlon">Ảnh Poster Lớn :</label>
                  <input disabled type="text" name="phimDetail-anhphimlon" id="phimDetail-anhphimlon" class="phimDetail-input" value="<?php echo $phim['AnhPhimLon'] ?>">
                  <img src="" alt="" id="phimDetail-anhphimlon-img">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-trailer">Mã video trailer :</label>
                  <input disabled type="text" name="phimDetail-trailer" id="phimDetail-trailer" class="phimDetail-input" value="<?php echo $phim['Trailer'] ?>">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-thongtin">Nội dung :</label>
                  <input disabled type="text" name="phimDetail-thongtin" id="phimDetail-thongtin" class="phimDetail-input" value="<?php echo $phim['ThongTin'] ?>">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-tuoiyeucau">Tuổi yêu cầu :</label>
                  <input disabled type="text" name="phimDetail-tuoiyeucau" id="phimDetail-tuoiyeucau" class="phimDetail-input" value="<?php echo $phim['TuoiYeuCau'] . " tuổi" ?>">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-thoiluongphim">Thời Lượng Phim :</label>
                  <input disabled type="text" name="phimDetail-thoiluongphim" id="phimDetail-thoiluongphim" class="phimDetail-input" value="<?php echo $phim['ThoiLuongPhim'] . " phút"?>">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-ngaykhoichieu">Ngày Khởi Chiếu :</label>
                  <input disabled type="date" name="phimDetail-ngaykhoichieu" id="phimDetail-ngaykhoichieu" class="phimDetail-input" value="<?php echo $phim['NgayKhoiChieu'] ?>">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-xuatxu">Xuất Xứ :</label>
                  <input disabled type="text" name="phimDetail-xuatxu" id="phimDetail-xuatxu" class="phimDetail-input" value="<?php echo $phim['XuatXu'] ?>">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-nhasanxuat">Nhà Sản Xuất :</label>
                  <input disabled type="text" name="phimDetail-nhasanxuat" id="phimDetail-nhasanxuat" class="phimDetail-input" value="<?php echo $phim['NhaSanXuat'] ?>">
            </div>
            <div>
                  <label class="phimDetail-label" for="phimDetail-trangthai">Trạng Thái :</label>
                  <select name="phimDetail-trangthai" id="phimDetail-trangthai" class="phimDetail-select" disabled>
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
            <div>
                  <label class="phimDetail-label" for="phimDetail-loaiphim">Thể Loại : </label>
                  <?php
                        foreach($loaiPhim as $loai) {
                              echo "<button type='button' disable class='phimDetail-button'>$loai[TenLoaiPhim]</button>";
                        }
                  ?>
            </div>
      </form>
      <center>
            <button id="update-phimDetail" onclick="window.location.href='index.php?ctrl=Phim&move=PhimUpdateView&id=<?php echo $phim['MaPhim'] ?>'">Cập nhật thông tin</button>
            <button id="close-phimDetail" onclick="window.location.href='index.php?ctrl=Phim'">Đóng</button>
      </center>
</div>