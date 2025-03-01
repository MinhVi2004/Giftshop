
<div id="modal-updateAddress">
      <p style="margin:22px; font-size:25px;" >| Sửa Địa Chỉ Giao Hàng</p>
      <div id="updateAddress-container">
                  <!-- <h3>Sửa Địa Chỉ Giao Hàng</h3> -->
                  <!-- <button onclick="window.location.href='../index.php'" id="closeupdateAddress-btn">x</button> -->
                  <form>
                        <div>
                              <label for="updateAddress-fullname">Họ và tên</label><br>
                              <input type="text" name="updateAddress-fullname" id="updateAddress-fullname" value="<?php echo $diaChi['HoTen'] ?>">
                              <p class="error" id="updateAddress-fullname-error">Họ và tên không hợp lệ</p>
                        </div>
                        <div>
                              <label for="updateAddress-phone">Số Điện Thoại</label><br>
                              <input type="text" name="updateAddress-phone" id="updateAddress-phone" value="<?php echo $diaChi['SoDienThoai'] ?>">
                              <p class="error" id="updateAddress-phone-error">Số điện thoại không hợp lệ</p>
                        </div>
                        <div>
                              <label for="updateAddress-province">Chọn Tỉnh/Thành Phố:</label>
                              <br>
                              <select id="updateAddress-province" onchange="fetchDistrictsUpdate(null)" name="updateAddress-province">
                                    <option value="">-- Chọn Tỉnh/Thành Phố --</option>
                              </select>
                              <p class="error" id="updateAddress-province-error">Vui lòng chọn Tỉnh/Thành Phố</p>
                              <label for="updateAddress-district">Chọn Quận/Huyện:</label>
                              <br>
                              <select id="updateAddress-district" name="updateAddress-district" onchange="fetchWardsUpdate(null)">
                                    <option value="">-- Chọn Quận/Huyện --</option>
                              </select>
                              <p class="error" id="updateAddress-district-error">Vui lòng chọn Quận/Huyện</p>
                              <label for="updateAddress-wards">Chọn Phường/Xã:</label>
                              <br>
                              <select id="updateAddress-wards" name="updateAddress-wards">
                                    <option value="">-- Chọn Phường/Xã --</option>
                              </select>
                              <p class="error" id="updateAddress-wards-error">Vui lòng chọn Phường/Xã</p>
                        </div>
                        <div>
                              <label for="updateAddress-diachi">Địa Chỉ</label><br>
                              <input type="text" name="updateAddress-diachi" id="updateAddress-diachi" value="<?php echo $diaChi['DiaChiNha'] ?>">
                              <p class="error" id="updateAddress-diachi-error">Địa Chỉ không hợp lệ</p>
                        </div>
                        <div id="updateAddress-options">
                              <button type="button" id="updateAddress-submit" onclick="updateAddress('<?php echo $diaChi['MaDC'] ?>')">Xác Nhận Thay Đổi</button>
                              <button type="button" id="updateAddress-back" class="back" onclick="window.location.href='index.php?ctrl=addressDetailView'">Trở Về</button>
                        </div>
                  </form>
                  </div>
                  <?php
                        echo "<script>
                        callMethodUpdateAddress('$diaChi[TinhThanhPho]', '$diaChi[QuanHuyen]', '$diaChi[PhuongXa]')
                        </script>";
                  ?>
            </div>
            </div>
</div>