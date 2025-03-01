<div id="ThongBao-wrapper">
      <div id="danhSachThongBao-container">
            <center><h1>Quản Lý Thông Báo</h1></center>
            <center><table id="ThongBao-table">    
                  <thead>
                  <tr>
                        <th>#</th>
                        <th>Tiêu Đề</th>
                        <th>Nội Dung</th>
                        <th>Ngày Thông Báo</th>
                        <th>Trạng Thái</th>
                        <th>Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php
                              if($listThongBao !=null) {
                                    $i = 1;
                                    foreach($listThongBao  as $ThongBao) {
                                          echo "<tr>";
                                          echo "<td class='ThongBao-stt'>$i</td>";
                                          echo "<td class='ThongBao-tieude'>$ThongBao[TieuDe]</td>";
                                          echo "<td class='ThongBao-noidung' style='text-align:left;'>$ThongBao[NoiDung]</td>";
                                          echo "<td class='ThongBao-ngaythongbao'>".DateTime::createFromFormat('Y-m-d H:i:s', $ThongBao["NgayThongBao"])->format('d-m-Y H:i:s')."</td>";
                                          // echo "<td class='ThongBao-ngaythongbao'>".$ThongBao["NgayThongBao"]."</td>";
                                          echo "<td class='ThongBao-trangthai'>$ThongBao[TrangThaiTB]</td>";
                                          echo "
                                          <td class='ThongBao-thaotac'>
                                                <button class='ThongBao-chitiet' onclick=\"chiTietThongBao('".$ThongBao['MaTB']."')\">Chi Tiết</button>
                                          </td>";
                                          echo "</tr>";
                                          $i++;
                                    }
                              }
                        ?>    
                  </tbody>
            </table></center>
      </div>
      <div id="thongTinThongBao-container">
            <h2>Thông Báo</h2>
            <div>
            <div>
                  <label class="addTB-label" for="addTB-ma">Mã Thông Báo</label><br>
                  <input class="addTB-input" type="text" name="addTB-ma" id="addTB-ma" disabled style="pointer-events: none; background-color:black; color:white;">
            </div>
            <div>
                  <label class="addTB-label" for="addTB-tieude">Tiêu Đề</label><br>
                  <input class="addTB-input" type="text" name="addTB-tieude" id="addTB-tieude">
            </div>
            <div>
                  <label class="addTB-label" for="addTB-noidung">Nội Dung</label>
                  <textarea name="addTB-noidung" id="addTB-noidung" class="addTB-input"></textarea>
            </div>
            <div id='addTB-thaotac'>
                  <button class='addTB-them' onclick='addTB()'>Tạo</button>
                  <button class='addTB-xoa' onclick='deleteTB()'>Xóa</button>
                  <button class='addTB-refesh' onclick='refeshTB()'>Refesh</button>
            </div>
      </div>
      </div>
</div>