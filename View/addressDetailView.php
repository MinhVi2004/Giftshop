<div id="modal-addressDetail">
      <div style="display:flex; justify-content: space-between; align-items: center;">
            <p style="margin:22px; font-size:25px;" >| Địa Chỉ Giao Hàng</p>
            <button onclick="window.location.href='index.php?ctrl=addAddressView'" id="btnMoveAddAddress"> + Thêm Địa Chỉ Giao Hàng</button>
      </div>
      <div id="addressDetail-container">
                  <h3>Địa Chỉ Giao Hàng</h3>
                  <!-- <button onclick="window.location.href='../index.php'" id="closeaddressDetail-btn">x</button> -->
                  
            <table id="addressDetail-table">
                  <thead>
                        <tr>
                              <th colspan="2">Bạn đã có <?php echo count($listDiaChi);?> địa chỉ</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                              foreach($listDiaChi as $diaChi) {
                              echo "<tr>
                                          <td class='addressDetail-diachi' style='width:80%;'>
                                                <p>".$diaChi['HoTen']."</p>
                                                <p>".$diaChi['SoDienThoai']."</p>
                                                <p>".$diaChi['ChiTietDC']."</p>
                                          </td>
                                          <td class='addressDetail-thaotac' style='width:20%;'>
                                                <button class='addressDetail-sua'  onclick='window.location.href=\"index.php?ctrl=updateAddressView&id=$diaChi[MaDC]\"' >Cập Nhật</button><br>
                                                <button class='addressDetail-xoa' onclick='deleteAddress(\"$diaChi[MaDC]\")'>Xóa</button>
                                          </td>
                                    </tr>";
                              }
                        ?>
                  </tbody>
            </table>
            <center><button type="button" class="back" id="addAddress-back" onclick="window.location.href='index.php'">Trở Về</button>   </center>
      </div>
      </div>
</div>