
<div id="typePhimAdd-wrapper">
      <center><h2>Thêm Loại Phim</h2></center>
      <form>
            <div>
                  <label for="typePhimAdd-tenloaiphim">Tên Loại Phim :</label>
                  <input type="text" name="typePhimAdd-tenloaiphim" id="typePhimAdd-tenloaiphim">
            </div>
            <div>
                  <label for="typePhimAdd-mota">Mô Tả :</label>
                  <textarea name="typePhimAdd-mota" id="typePhimAdd-mota" cols="50" rows="6" ></textarea>
            </div>
      </form>
      <center>
            <button id="add-typePhimAdd" onclick="addTypePhim()">Thêm Loại Phim</button>
            <button id="close-typePhimAdd" onclick="window.location.href='index.php?ctrl=Phim'">Đóng</button>
      </center>
</div>