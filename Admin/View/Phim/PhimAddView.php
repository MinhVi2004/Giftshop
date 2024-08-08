
<div id="phimAdd-wrapper">
      <center><h2>Thêm Phim Chiếu Rạp</h2></center>
      <form>
            <div>
                  <label class="phimAdd-label" for="phimAdd-tenphim">Tên Phim :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-tenphim" id="phimAdd-tenphim">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-anhphimnho">Ảnh Poster Nhỏ :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-anhphimnho" id="phimAdd-anhphimnho">
                  <img src="" alt="" id="phimAdd-anhphimnho-img">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-anhphimlon">Ảnh Poster Lớn :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-anhphimlon" id="phimAdd-anhphimlon">
                  <img src="" alt="" id="phimAdd-anhphimlon-img">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-trailer">Mã Video Trailer :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-trailer" id="phimAdd-trailer">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-thongtin">Nội Dung :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-thongtin" id="phimAdd-thongtin">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-tuoiyeucau">Tuổi Yêu Cầu :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-tuoiyeucau" id="phimAdd-tuoiyeucau">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-thoiluongphim">Thời Lượng Phim :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-thoiluongphim" id="phimAdd-thoiluongphim">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-ngaykhoichieu">Ngày Khởi Chiếu :</label>
                  <input class="phimAdd-input" type="date" name="phimAdd-ngaykhoichieu" id="phimAdd-ngaykhoichieu">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-xuatxu">Xuất Xứ :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-xuatxu" id="phimAdd-xuatxu">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-nhasanxuat">Nhà Sản Xuất :</label>
                  <input class="phimAdd-input" type="text" name="phimAdd-nhasanxuat" id="phimAdd-nhasanxuat">
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-theloai">Thể Loại :</label>
                  <select name="phimAdd-theloai" id="phimAdd-theloai" multiple size="<?php echo count($loaiphim) ?>">
                        <?php
                              foreach($loaiphim as $loai) {
                                    echo "<option value='$loai[MaLoaiPhim]'>$loai[TenLoaiPhim]</option>";
                              }
                        ?>

                  </select>
            </div>
            <div>
                  <label class="phimAdd-label" for="phimAdd-trangthai">Trạng Thái :</label>
                  <select class="phimAdd-select" name="phimAdd-trangthai" id="phimAdd-trangthai">
                        <?php
                              echo "<option value='Sắp Chiếu' selected>Sắp Chiếu</option>
                              <option value='Đang Chiếu'>Đang Chiếu</option>
                              <option value='Ẩn Phim'>Ẩn Phim</option>";
                        ?>

                  </select>
            </div>

      </form>
      <center>
            <button id="add-phimAdd" onclick="addPhim()">Thêm phim</button>
            <button id="close-phimAdd" onclick="window.location.href='index.php?ctrl=Phim'">Đóng</button>
      </center>
</div>