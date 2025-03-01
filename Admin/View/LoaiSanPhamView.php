<div id="LoaiSanPham-wrapper">
      <div id="danhSachLoaiSanPham-container">
            <center><h1>Quản Lý Loại Sản Phẩm</h1></center>
            <center><table id="LoaiSanPham-table">    
                  <thead>
                  <tr>
                        <th>#</th>
                        <th>Mã</th>
                        <th>Loại Sản Phẩm</th>
                        <th>Mô Tả</th>
                        <th>Trạng thái</th>
                        <th>Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php
                              if($listLoaiSanPham!=null) {
                                    $i = 1;
                                    foreach($listLoaiSanPham as $LoaisanPham) {
                                          echo "<tr>";
                                          echo "<td class='LoaiSanPham-stt'>$i</td>";
                                          echo "<td class='LoaiSanPham-ma'>$LoaisanPham[MaLoaiSP]</td>";
                                          echo "<td class='LoaiSanPham-ten'>$LoaisanPham[TenLoaiSP]</td>";
                                          echo "<td class='LoaiSanPham-mota'>$LoaisanPham[MoTaLoaiSP]</td>";
                                          echo "<td class='LoaiSanPham-trangthai'>$LoaisanPham[TrangThaiLoaiSP]</td>";
                                          echo "
                                          <td class='LoaiSanPham-thaotac'>
                                                <button class='LoaiSanPham-chitiet' onclick='chiTietLoaiSP(\"$LoaisanPham[MaLoaiSP]\", \"$LoaisanPham[TenLoaiSP]\", \"$LoaisanPham[MoTaLoaiSP]\")'>Chi Tiết</button>
                                          </td>";
                                          // echo "<td class='TaiKhoan-thaotac TaiKhoan-thaotac-khoiphuc'  onclick='khoiPhucMatKhau($taiKhoan[MaTK])'>Khôi Phục</td>";
                                          echo "</tr>";
                                          $i++;
                                    }
                              }
                        ?>    
                  </tbody>
            </table></center>
      </div>
      <div id="thongTinLoaiSanPham-container">
            <h2>Loại Sản Phẩm</h2>
            <div>
            <img src="" alt="" id="addLSP-anh">
            <div>
                  <label class="addLSP-label" for="addLSP-ma">Mã loại sản phẩm</label><br>
                  <input class="addLSP-input" type="text" name="addLSP-ma" id="addLSP-ma" disabled style="pointer-events: none; background-color:black; color:white;">
            </div>
            <div>
                  <label class="addLSP-label" for="addLSP-ten">Tên Loại</label><br>
                  <input class="addLSP-input" type="text" name="addLSP-ten" id="addLSP-ten">
            </div>
            <!-- <div>
                  <label class="addLSP-label" for="addLSP-anh">Ảnh :</label>
                  <input class="addLSP-input" type="text" name="addLSP-anh" id="addLSP-anh">
                  
            </div> -->
            <!-- <div>
                  <label class="addLSP-label" for="addLSP-gia">Giá</label><br>
                  <input class="addLSP-input" type="text" name="addLSP-gia" id="addLSP-gia">
            </div> -->
            <div>
                  <label class="addLSP-label" for="addLSP-mota">Mô Tả</label><br>
                  <textarea class="addLSP-input" type="text" name="addLSP-mota" id="addLSP-mota"></textarea>
            </div>
            <!-- <div>
                  <label class="addLSP-label" for="addLSP-loaiSP">Loại Sản Phẩm</label><br>
                  <ul name="addLSP-loaiSP" id="addLSP-loaiSP">
                  </ul>
            </div> -->
            <div id='addLSP-thaotac'>
                  <button class='addLSP-them' onclick="addLoaiSP()">Thêm</button>
                  <button class='addLSP-sua' onclick="updateLoaiSP()">Sửa</button>
                  <button class='addLSP-xoa' onclick="deleteLoaiSP()">Xóa</button>
                  <button class='addLSP-refesh' onclick="refeshLoaiSP()">Refesh</button>
            </div>
      </div>
      </div>
</div>