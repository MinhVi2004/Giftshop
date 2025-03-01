<div id="SanPham-wrapper">
      <div id="danhSachSanPham-container">
            <center><h1>Quản Lý Sản Phẩm</h1></center>
            <center><table id="SanPham-table">
                  <thead>
                  <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Mô Tả</th>
                        <th>Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php
                              if($listSanPham!=null) {
                                    $i = 1;
                                    foreach($listSanPham as $sanPham) {
                                          echo "<tr>";
                                          echo "<td class='SanPham-stt'>$i</td>";
                                          echo "<td class='SanPham-anh'><img src='".$sanPham["AnhSP"]."' alt=''></td>";
                                          echo "<td class='SanPham-ten'>$sanPham[TenSP]</td>";
                                          echo "<td class='SanPham-gia'>".number_format($sanPham['GiaSP'], 0, ',', '.')." đ</td>";
                                          echo "<td class='SanPham-mota'>$sanPham[MoTaSP]</td>";
                                          echo "
                                          <td class='SanPham-thaotac'>
                                                <button class='SanPham-chitiet' onclick='chiTietSP(\"$sanPham[MaSP]\", \"$sanPham[TenSP]\", \"$sanPham[AnhSP]\", \"$sanPham[GiaSP]\",\"$sanPham[MoTaSP]\")'>Chi Tiết</button>
                                          </td>";
                                          echo "</tr>";
                                          $i++;
                                          
                                    }
                              }
                        ?>    
                  </tbody>
            </table></center>
      </div>
      <form id="thongTinSanPham-container"  enctype='multipart/form-data'>
            <h3>Sản Phẩm</h3>
            <div>
            <center><img src="" alt="" id="addSP-showAnh"></center>
            <div>
                  <label class="addSP-label" for="addSP-ma">Mã sản phẩm</label><br>
                  <input class="addSP-input" type="text" name="addSP-ma" id="addSP-ma" disabled style="pointer-events: none; background-color:black; color:white;">
            </div>
            <div>
                  <label class="addSP-label" for="addSP-ten">Tên</label><br>
                  <input class="addSP-input" type="text" name="addSP-ten" id="addSP-ten">
            </div>
            <div>
                  <label class="addSP-label" for="addSP-anh">Ảnh</label>
                  <input class="addSP-input" type="file" name="addSP-anh" id="addSP-anh" onchange="handleFileSelect('event')">
                  
            </div>
            <div>
                  <label class="addSP-label" for="addSP-gia">Giá</label><br>
                  <input class="addSP-input" type="text" name="addSP-gia" id="addSP-gia">
            </div>
            <div>
                  <label class="addSP-label" for="addSP-mota">Mô Tả</label><br>
                  <textarea class="addSP-input" type="text" name="addSP-mota" id="addSP-mota"></textarea>
            </div>
            <div>
                  <label class="addSP-label" for="addSP-loaiSP">Loại Sản Phẩm</label><br>
                  <ul name="addSP-loaiSP" id="addSP-loaiSP">
                        <?php
                        if(isset($loaiSP))
                              foreach($loaiSP as $loai) {
                                    echo "<li>
                                                <input type='checkbox' id='$loai[MaLoaiSP]' name='loaiSP' value='$loai[MaLoaiSP]'>
                                                <label for='$loai[MaLoaiSP]'>$loai[TenLoaiSP]</label>
                                          </li>";
                              }
                        ?>
                  </ul>
            </div>
            <div id='addSP-thaotac'>
                  <button class='addSP-them' type="button" onclick="addSP()">Tạo</button>
                  <button class='addSP-sua' type="button" onclick="updateSP()">Sửa</button>
                  <button class='addSP-xoa' type="button" onclick="deleteSP()">Xóa</button>
                  <button class='addSP-refesh' type="button" onclick="refeshSP()">Refesh</button>
            </div>
      </div>
      </form>
</div>