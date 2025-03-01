<div id="KhuyenMai-wrapper">
      <div id="danhSachKhuyenMai-container">
            <center><h1>Quản Lý Khuyến Mãi</h1></center>
            <center><table id="KhuyenMai-table">    
                  <thead>
                  <tr>
                        <th>#</th>
                        <th>Tên Khuyến Mãi</th>
                        <th>Phần Trăm Giảm (%)</th>
                        <th>Ngày Bắt Đầu</th>
                        <th>Ngày Kết Thúc</th>
                        <th>Trạng Thái</th>
                        <th>Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php
                              if($listKhuyenMai !=null) {
                                    $i = 1;
                                    foreach($listKhuyenMai  as $KhuyenMai) {
                                          echo "<tr>";
                                          echo "<td class='KhuyenMai-stt'>$i</td>";
                                          echo "<td class='KhuyenMai-ten'>$KhuyenMai[TenKM]</td>";
                                          echo "<td class='KhuyenMai-phantram'>$KhuyenMai[PhanTramGiamGia]</td>";
                                          echo "<td class='KhuyenMai-ngaybatdau'>".DateTime::createFromFormat('Y-m-d', $KhuyenMai["NgayBatDau"])->format('d-m-Y')."</td>";
                                          echo "<td class='KhuyenMai-ngayketthuc'>".DateTime::createFromFormat('Y-m-d', $KhuyenMai["NgayKetThuc"])->format('d-m-Y')."</td>";
                                          echo "<td class='KhuyenMai-trangthai'>$KhuyenMai[TrangThaiKM]</td>";
                                          echo "
                                          <td class='KhuyenMai-thaotac'>
                                                <button class='KhuyenMai-chitiet' onclick=\"chiTietKhuyenMai('".$KhuyenMai['MaKM']."')\">Chi Tiết</button>
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
      <div id="thongTinKhuyenMai-container">
            <h2>Khuyến Mãi</h2>
            <div>
            <div>
                  <label class="addKM-label" for="addKM-ma">Mã Khuyến Mãi</label><br>
                  <input class="addKM-input" type="text" name="addKM-ma" id="addKM-ma" disabled style="pointer-events: none; background-color:black; color:white;">
            </div>
            <div>
                  <label class="addKM-label" for="addKM-ten">Tên Khuyến Mãi</label><br>
                  <input class="addKM-input" type="text" name="addKM-ten" id="addKM-ten">
            </div>
            <div>
                  <label class="addKM-label" for="addKM-phantram">Phần Trăm Khuyến Mãi</label>
                  <select name="addKM-phantram" id="addKM-phantram"  class="addKM-input">
                        <?php
                              for($i = 0; $i <= 100; $i=$i+5) {
                                    echo "<option value='$i'>$i %</option>";
                              }
                        ?>
                  </select>
            </div>
            <div>
                  <label class="addKM-label" for="addKM-ngaybatdau">Ngày Bắt Đầu</label><br>
                  <input class="addKM-input" type="date" name="addKM-ngaybatdau" id="addKM-ngaybatdau">
            </div>
            <div>
                  <label class="addKM-label" for="addKM-ngayketthuc">Ngày Kết Thúc</label><br>
                  <input class="addKM-input" type="date" name="addKM-ngayketthuc" id="addKM-ngayketthuc">
            </div>
            <div>
                  <label class="addKM-label" for="addKM-mota">Mô Tả </label><br>
                  <textarea class="addKM-input" type="text" name="addKM-mota" id="addKM-mota"></textarea>
            </div>
            <!-- <div>
                  <label class="addKM-label" for="addKM-KM">Khuyến Mãi</label><br>
                  <ul name="addKM-KM" id="addKM-KM">
                  </ul>
            </div> -->
            <div id='addKM-thaotac'>
                  <button class='addKM-them' onclick='addKM()'>Tạo</button>
                  <button class='addKM-sua' onclick='updateKM()'>Sửa</button>
                  <button class='addKM-xoa' onclick='deleteKM()'>Xóa</button>
                  <button class='addKM-refesh' onclick='refeshKM()'>Refesh</button>
            </div>
      </div>
      </div>
</div>