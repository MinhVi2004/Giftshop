
<div id="PhanQuyen-wrapper">
      <table id="PhanQuyen-table">
            <thead>
            <tr>
                  <th>Vai Trò</th>
                  <th>Phim</th>
                  <th>Người Dùng</th>
                  <th>Phân Quyền</th>
                  <th>Lịch Chiếu</th>
                  <th>Phòng Chiếu</th>
                  <th>Doanh Thu</th>
                  <th>Bình Luận</th>
                  <th>Vé</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php

                        foreach($listPhanQuyen as $PhanQuyen) {
                              $temp = "";
                              echo "<tr>";
                              foreach($PhanQuyen as $key) {
                                    if($key != 0 && $key != 1) {
                                          $temp = $key;
                                          echo "<td>$key</td>";
                                          continue;
                                    }
                                    if($key == 0) {
                                          echo "<td>-</td>";
                                    } else {
                                          echo "<td>X</td>";
                                    }
                              }
                              echo "<td class='PhanQuyen-thaotac PhanQuyen-thaotac-suaphanquyen' onclick='window.location.href=\"index.php?ctrl=Phân%20Quyền&move=SuaChiTietPhanQuyen&VaiTro=$temp\"'>Sửa</td>";
                              echo "</tr>";
                        }
                  ?>    
            </tbody>
      </table>
      <center><a href="index.php?ctrl=Phân Quyền"><button id="capNhatPhanQuyen-btn">Xác Nhận</button></a></center>
</div>