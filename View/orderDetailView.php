<div id="orderDetail-container">
      <p style="margin:22px; font-size:25px;" >| Chi Tiết Đơn Hàng</p>
      <p style=" font-size:27px; vertical-align: middle;">Trạng Thái Đơn Hàng: 
      <?php
      switch ($donHang['TrangThaiDH']) {
            case 'Chưa Xác Nhận':
                  echo '<span id="order-final" class="order-trangthai" style="font-size:27px; color:orange;">'.$donHang['TrangThaiDH'].'<button onclick="huyDonHang(\''.$donHang['MaDH'].'\')" id="huyDonHang">Hủy Đơn Hàng</button></span>';
                  break;
            case 'Đã Xác Nhận':
                  echo '<span id="order-final" class="order-trangthai" style="font-size:27px; color:orange;">'.$donHang['TrangThaiDH'].'</span>';
                  break;
            case 'Hoàn Thành':
                  echo '<span id="order-final" class="order-trangthai" style="font-size:27px; color:#05cc06;">'.$donHang['TrangThaiDH'].'</span>';
                  break;
            case 'Hủy':
                  echo '<span id="order-final" class="order-trangthai" style="font-size:27px; color:red;">'.$donHang['TrangThaiDH'].'</span>';
                  break;
            
            default:
            echo '<span id="order-final" class="order-trangthai">'.$donHang['TrangThaiDH'].'</span>';
                  break;
      }
      ?>
      </p>
      <div id="orderDetail-diachi">
            <div style="display:flex; justify-content: space-between; align-items: center;">
                  <p id="orderDetail-diachi-title"><i class="fa-solid fa-location-dot"></i> Địa Chỉ Giao Hàng</p>
            </div>
            <!-- <div class="orderDetail-diachi-item">
                  <div class="orderDetail-diachi-item-info">
                        <p class="orderDetail-diachi-item-name">Minh vi</p>
                        <p class="orderDetail-diachi-item-sodienthoai">091123098</p>
                  </div>
                  <div class="orderDetail-diachi-item-chitietdiachi">63/2e, đường Tân Xuân-Trung Chánh 2, hẻm số 07-ấp Mỹ Hòa 3, Tân Xuân, Hóc Môn, Xã Tân Xuân, Huyện Hóc Môn, TP. Hồ Chí Minh</div>
                  <button class="orderDetail-diachi-item-thaydoi" onclick="addressDetail()">Thay Đổi</button>
            </div> -->
            <?php
                  echo '<div class="orderDetail-diachi-item">
                              <div class="orderDetail-diachi-item-info">
                                    <p class="orderDetail-diachi-item-name">'.$diaChi['HoTen'].'</p>
                                    <p class="orderDetail-diachi-item-sodienthoai">'.$diaChi['SoDienThoai'].'</p>
                              </div>
                              <div class="orderDetail-diachi-item-chitietdiachi">'.$diaChi['ChiTietDC'].'</div>
                        </div>';
            ?>
      </div>
      <div id="orderDetail-listSanPham">
            <div class="orderDetail-item">
                  <div class="orderDetail-item-img" style="font-size: 22px;">Sản Phẩm</div>
                  <div class="orderDetail-item-name"></div>
                  <div class="orderDetail-item-price">Đơn Giá</div>
                  <div class="orderDetail-item-quantity-change">Số Lượng</div>
                  <div class="orderDetail-item-total-price"><p>Thành Tiền</p></div>
                  <div class="orderDetail-item-remove"></div>
            </div>
            <?php
            foreach($chiTietDonHang as $ctdh) {
                  echo '<div class="orderDetail-item">
                              <img src="'.$ctdh['AnhSP'].'" alt="Ảnh Sản Phẩm">
                              <div class="orderDetail-item-name">
                                    <p>'.$ctdh['TenSP'].'</p>
                              </div>
                              <div class="orderDetail-item-price">
                                    <p>'.number_format($ctdh['GiaLucMua'], 0, ',', '.').' đ</p>
                              </div>
                              <div class="orderDetail-item-quantity-change">
                                    <span>'.$ctdh['SoLuong'].'</span>
                              </div>
                              <div  class="orderDetail-item-total-price">
                                    <p>'.number_format($ctdh['ThanhTien'], 0, ',', '.').' đ</p>
                              </div>
                        </div>';
            }
            
            ?>
      </div>
      <div id="orderDetail-khuyenmai">
            <p id="orderDetail-khuyenmai-title">Khuyến Mãi Đã Áp Dụng</p>
            <?php
            if(isset($khuyenMai))
                  echo '<div class="orderDetail-khuyenmai-item">
                              <div class="orderDetail-khuyenmai-item-info">
                                    <p class="orderDetail-khuyenmai-item-name"><i class="fa-solid fa-circle-dot" style="font-size: 12px;"></i> '.$khuyenMai['TenKM'].'</p>
                                    <p class="orderDetail-khuyenmai-item-mota">'.$khuyenMai['MoTaKM'].'</p>
                              </div>
                        </div>';
                  
            else echo "<p><i class='fa-solid fa-circle-dot'></i> Không có khuyến mãi khả dụng.</p>";
            ?>
      </div>
      <div id="orderDetail-thaotac">
            <div style="display:flex; flex-direction: column; justify-content: center; width:auto; min-width:300px;">
                  <div style="display:flex; justify-content: space-between;">
                        <span>Tổng giá trị: </span>
                        <span id="orderDetail-total" class="money-amount"><?php echo number_format($donHang['TongGiaTri'], 0, ',', '.') ." đ"; ?></span>
                  </div>
                  <div style="display:flex; justify-content: space-between;">
                        <span>Giảm giá: </span>
                        <span id="orderDetail-discount" class="money-amount"><?php echo number_format($donHang['TienGiamGia'], 0, ',', '.') ." đ"; ?></span>
                  </div>
                  <div style="display:flex; justify-content: space-between;">
                        <span>Thanh toán: </span>
                        <span id="orderDetail-final" class="money-amount"><?php echo number_format($donHang['TongThanhToan'], 0, ',', '.') ." đ"; ?></span>
                  </div>
            </div>
      </div>
</div>