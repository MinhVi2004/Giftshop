<div id="buy-container">
      <p style="margin:22px; font-size:25px;" >| Thanh Toán</p>
      <div id="buy-diachi">
            <div style="display:flex; justify-content: space-between; align-items: center;">
                  <p id="buy-diachi-title"><i class="fa-solid fa-location-dot"></i> Địa Chỉ Giao Hàng</p>
                  <button onclick="window.location.href='index.php?ctrl=addAddressView'" id="btnMoveAddAddress"> + Thêm Địa Chỉ Giao Hàng</button>
            </div>
            <!-- <div class="buy-diachi-item">
                  <div class="buy-diachi-item-info">
                        <p class="buy-diachi-item-name">Minh vi</p>
                        <p class="buy-diachi-item-sodienthoai">091123098</p>
                  </div>
                  <div class="buy-diachi-item-chitietdiachi">63/2e, đường Tân Xuân-Trung Chánh 2, hẻm số 07-ấp Mỹ Hòa 3, Tân Xuân, Hóc Môn, Xã Tân Xuân, Huyện Hóc Môn, TP. Hồ Chí Minh</div>
                  <button class="buy-diachi-item-thaydoi" onclick="addressDetail()">Thay Đổi</button>
            </div> -->
            <?php
            if(isset($listDiaChi))
                  foreach($listDiaChi as $diaChi) {
                  echo '<div class="buy-diachi-item">
                              <input type="radio" name="selectAddress" class="hidden-radio" value="'.$diaChi['MaDC'].'" style="width:25px;">
                              <div class="buy-diachi-item-info">
                                    <p class="buy-diachi-item-name">'.$diaChi['HoTen'].'</p>
                                    <p class="buy-diachi-item-sodienthoai">'.$diaChi['SoDienThoai'].'</p>
                              </div>
                              <div class="buy-diachi-item-chitietdiachi">'.$diaChi['ChiTietDC'].'</div>
                        </div>';
                  }
            ?>
      </div>
      <div id="buy-listSanPham">
            <div class="buy-item">
                  <div class="buy-item-img" style="font-size: 22px;">Sản Phẩm</div>
                  <div class="buy-item-name"></div>
                  <div class="buy-item-price">Đơn Giá</div>
                  <div class="buy-item-quantity-change">Số Lượng</div>
                  <div class="buy-item-total-price"><p>Thành Tiền</p></div>
                  <div class="buy-item-remove"></div>
            </div>
            <?php
            if(isset($listGioHang)) {
                  $total = 0;
                  foreach($listGioHang as $gioHang) {
                        $thanhTien = $gioHang['GiaSP'] * $gioHang['SoLuong'];
                        echo '<div class="buy-item">
                                    <img src="'.$gioHang['AnhSP'].'" alt="Ảnh Sản Phẩm">
                                    <div class="buy-item-name">
                                          <p>'.$gioHang['TenSP'].'</p>
                                    </div>
                                    <div class="buy-item-price">
                                          <p>'.number_format($gioHang['GiaSP'], 0, ',', '.').' đ</p>
                                    </div>
                                    <div class="buy-item-quantity-change">
                                          <input type="text" value="'.$gioHang['SoLuong'].'" readonly id="buy-item-quantity-'.$gioHang['MaSP'].'">
                                    </div>
                                    <div  class="buy-item-total-price">
                                          <p>'.number_format($thanhTien, 0, ',', '.').' đ</p>
                                    </div>
                              </div>';
                              $total += $thanhTien;
                  }
            }
            ?>
      </div>
      <div id="buy-khuyenmai">
            <p id="buy-khuyenmai-title">Khuyến Mãi</p>
            <?php
            if(isset($listKhuyenMai)) {
                  foreach($listKhuyenMai as $khuyenMai) {
                        echo '<div class="buy-khuyenmai-item">
                                    <input  type="radio" name="selectKhuyenMai" class="hidden-radio" value="'.$khuyenMai['MaKM'].'" style="width:25px;" onchange="updateKhuyenMaiPrice()">
                                    <div class="buy-khuyenmai-item-info">
                                          <p class="buy-khuyenmai-item-name">'.$khuyenMai['TenKM'].'</p>
                                          <p class="buy-khuyenmai-item-mota">'.$khuyenMai['MoTaKM'].'</p>
                                          <p id="buy-khuyenmai-item-chitietkhuyenmai-'.$khuyenMai['MaKM'].'" data-value='.$khuyenMai['PhanTramGiamGia'].'></p>
                                    </div>
                              </div>';
                        }
                  
            }
            else echo "<p>Không có khuyến mãi khả dụng.</p>";
            ?>
      </div>
      <script>
      document.addEventListener("DOMContentLoaded", function () {
      let radios = document.querySelectorAll('input[name="selectKhuyenMai"]');

      radios.forEach(radio => {
            radio.addEventListener("click", function () {
                  if (this.checked && this.getAttribute("data-clicked") === "true") {
                  this.checked = false;
                  this.removeAttribute("data-clicked");
                  updateKhuyenMaiPrice(); // Gọi lại hàm khi bỏ chọn
                  } else {
                  this.setAttribute("data-clicked", "true");
                  updateKhuyenMaiPrice(); // Gọi lại hàm khi chọn
                  }
            });
      });
      });
      </script>

      <div id="buy-thaotac">
            <div style="display:flex; flex-direction: column; justify-content: center; width:auto; min-width:250px;">
                  <div style="display:flex; justify-content: space-between;">
                        <span>Tổng giá trị: </span>
                        <span id="buy-total" data-value="<?php if(isset($total))echo $total;else echo 0; ?>" class="money-amount"><?php if(isset($total))echo number_format($total, 0, ',', '.'); else echo 0;?> đ</span>
                  </div>
                  <div style="display:flex; justify-content: space-between;">
                        <span>Giảm giá: </span>
                        <span id="buy-discount" data-value="0" class="money-amount">0 đ</span>
                  </div>
                  <div style="display:flex; justify-content: space-between;">
                        <span>Thanh toán: </span>
                        <span id="buy-final" data-value=" data-value="<?php if(isset($total))echo $total;else echo 0; ?> class="money-amount"><?php if(isset($total))echo number_format($total, 0, ',', '.'); else echo 0;?> đ</span>
                  </div>
            </div>
            <button id="buy-buy" onclick="buy()">Đặt Hàng</button>
      </div>
</div>