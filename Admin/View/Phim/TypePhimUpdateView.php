
<div id="typePhimUpdate-wrapper">
      <center><h2>Cập nhật thông tin phim</h2></center>
      <form>
            <div>
                  <label for="typePhimUpdate-tenloaiphim">Tên Loại Phim :</label>
                  <input type="text" name="typePhimUpdate-tenloaiphim" id="typePhimUpdate-tenloaiphim" value="<?php echo $typePhim['TenLoaiPhim'] ?>">
            </div>
            <div>
                  <label for="typePhimUpdate-mota">Mô Tả :</label>
                  <textarea name="typePhimUpdate-mota" id="typePhimUpdate-mota" cols="50" rows="6" ><?php echo $typePhim['MoTa'] ?></textarea>
            </div>
      </form>
      <center>
            <button id="update-typePhimUpdate" onclick="updateLoaiPhim(<?php echo $typePhim['MaLoaiPhim']?>)">Xác nhận</button>
            <button id="close-typePhimUpdate" onclick="window.location.href='index.php?ctrl=Phim'">Đóng</button>
      </center>
</div>