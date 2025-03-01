<div id="DonHang-wrapper">
      <center><h1>Quản Lý Đơn Hàng</h1></center>
      <div style="text-align: center; margin-bottom: 10px;">
            <label for="filter-status" style="font-size:20px; font-weight:bold;">Lọc theo trạng thái </label>
            <select id="filter-status" onchange="locDonHangTheoTrangThai()">
                  <option value="">Tất cả</option>
                  <option value="Chưa Xác Nhận">Chưa Xác Nhận</option>
                  <option value="Đã Xác Nhận">Đã Xác Nhận</option>
                  <option value="Hoàn Thành">Hoàn Thành</option>
                  <option value="Hủy">Hủy</option>
            </select>
      </div>

      <center>
      <table id="DonHang-table">
            <thead>
            <tr>
                  <th>#</th>
                  <th>Mã DH</th>
                  <th>Ngày Đặt</th>
                  <th>Tổng Giá Trị</th>
                  <th>Tiền Giảm Giá</th>
                  <th>Tổng Thanh Toán</th>
                  <th>Trạng Thái</th>
                  <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
                  <?php
                        if($listDonHang!=null) {
                              $i = 1;
                              foreach($listDonHang as $donHang) {
                                    echo "<tr>";
                                    echo "<td class='DonHang-stt'>$i</td>";
                                    echo "<td class='DonHang-hoten'>$donHang[MaDH]</td>";
                                    echo "<td class='DonHang-ngaytao'>$donHang[NgayDatHang]</td>";
                                    echo "<td class='DonHang-ngaytao'>".number_format($donHang['TongGiaTri'], 0, ',', '.')." đ</td>";
                                    echo "<td class='DonHang-ngaytao'>".number_format($donHang['TienGiamGia'], 0, ',', '.')." đ</td>";
                                    echo "<td class='DonHang-ngaytao'>".number_format($donHang['TongThanhToan'], 0, ',', '.')." đ</td>";
                                    // echo "<td class='DonHang-trangthai'>$donHang[TrangThaiDH]</td>";
                                    switch ($donHang['TrangThaiDH']) {
                                          case 'Chưa Xác Nhận':
                                                echo '<td class="DonHang-trangthai" style="color:orange">'.$donHang["TrangThaiDH"].'</td>';
                                                break;
                                          case 'Đã Xác Nhận':
                                                echo '<td class="DonHang-trangthai" style="color:orange">'.$donHang["TrangThaiDH"].'</td>';
                                                break;
                                          case 'Hoàn Thành':
                                                echo '<td class="DonHang-trangthai" style="color:#05cc06;">'.$donHang["TrangThaiDH"].'</td>';
                                                break;
                                          case 'Hủy':
                                                echo '<td class="DonHang-trangthai" style="color:red;">'.$donHang["TrangThaiDH"].'</td>';
                                                break;
                                          
                                          default:
                                                echo '<td class="DonHang-trangthai" style="color:red;">'.$donHang["TrangThaiDH"].'</td>';
                                                break;
                                    }
                                    echo "
                                    <td class='DonHang-thaotac'>
                                          <button class='DonHang-chitiet' onclick='openChiTietDonHang(\"".$donHang['MaDH']."\", \"".$donHang['MaTK']."\")'>Chi Tiết</button>
                                    </td>";
                                    echo "</tr>";
                                    $i++;
                                    
                              }
                        }
                  ?>    
            </tbody>
      </table>
      </center>
      <div id="modal-chiTietDonHang">
      </div>
</div>