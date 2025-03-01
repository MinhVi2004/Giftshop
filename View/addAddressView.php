
<div id="modal-addAddress">
<p style="margin:22px; font-size:25px;" >| Thêm Địa Chỉ Giao Hàng</p>
      <div id="addAddress-container">
                  <!-- <button onclick="window.location.href='../index.php'" id="closeaddAddress-btn">x</button> -->
                  <form>
                        <div>
                              <label for="addAddress-fullname">Họ và tên</label><br>
                              <input type="text" name="addAddress-fullname" id="addAddress-fullname" value="<?php echo $_SESSION['GiftShopUser']['HoTen'] ?>">
                              <p class="error" id="addAddress-fullname-error">Họ và tên không hợp lệ</p>
                        </div>
                        <div>
                              <label for="addAddress-phone">Số Điện Thoại</label><br>
                              <input type="text" name="addAddress-phone" id="addAddress-phone" value="<?php if (isset($_SESSION['GiftShopUser']['SoDienThoaiTK']))echo $_SESSION['GiftShopUser']['SoDienThoaiTK'] ?>">
                              <p class="error" id="addAddress-phone-error">Số điện thoại không hợp lệ</p>
                        </div>
                        <div>
                              <label for="addAddress-province">Chọn Tỉnh/Thành Phố:</label>
                              <br>
                              <select id="addAddress-province" onchange="fetchDistricts()" name="addAddress-province">
                                    <option value="" data-province-name="">-- Chọn Tỉnh/Thành Phố --</option>
                              </select>
                              <p class="error" id="addAddress-province-error">Vui lòng chọn Tỉnh/Thành Phố</p>

                              <label for="addAddress-district">Chọn Quận/Huyện:</label>
                              <br>
                              <select id="addAddress-district" name="addAddress-district" onchange="fetchWards()">
                                    <option value="" data-district-name="">-- Chọn Quận/Huyện --</option>
                              </select>
                              <p class="error" id="addAddress-district-error">Vui lòng chọn Quận/Huyện</p>
                              
                              <label for="addAddress-wards">Chọn Xã/Phường:</label>
                              <br>
                              <select id="addAddress-wards" name="addAddress-wards">
                                    <option value=""  data-wards-name="">-- Chọn Xã/Phường --</option>
                              </select>
                              <p class="error" id="addAddress-wards-error">Vui lòng chọn Xã/Phường</p>
                        </div>
                        <div>
                              <label for="addAddress-diachi">Địa Chỉ</label><br>
                              <input type="text" name="addAddress-diachi" id="addAddress-diachi" value="">
                              <p class="error" id="addAddress-diachi-error">Địa Chỉ không hợp lệ</p>
                        </div>
                        <div id="addAddress-options">
                              <button type="button" id="addAddress-submit" onclick="addAddress('<?php echo $_SESSION['GiftShopUser']['MaTK'] ?>')">Thêm Địa Chỉ</button>
                              <button type="button" id="addAddress-back" class="back" onclick="window.history.back()">Trở Về</button>
                        </div>
                  </form>
                  </div>
                  <?php
                        echo "<script>fetchProvinces()</script>"
                  ?>
            </div>
            </div>
</div>