<div id="cart-container">
      <p style="margin:22px; font-size:25px;" >| Giỏ Hàng</p>
      <div id="cart-listSanPham">
      <div class="buy-item">
            <div class="buy-item-img">Sản Phẩm</div>
            <div class="buy-item-name"></div>
            <div class="buy-item-price">Đơn Giá</div>
            <div class="buy-item-quantity-change">Số Lượng</div>
            <div class="buy-item-total-price"><p>Thành Tiền</p></div>
            <div class="buy-item-remove"></div>
      </div>
      <?php
      $total = 0;
      if(isset($listGioHang))
            foreach($listGioHang as $gioHang) {
            $thanhTien = $gioHang['GiaSP'] * $gioHang['SoLuong'];
            echo '<div class="cart-item">
                        <img src="'.$gioHang['AnhSP'].'" alt="Ảnh Sản Phẩm">
                        <div class="cart-item-name">
                              <p>'.$gioHang['TenSP'].'</p>
                        </div>
                        <div class="cart-item-price">
                              <p>'.number_format($gioHang['GiaSP'], 0, ',', '.').' đ</p>
                        </div>
                        <div class="cart-item-quantity-change">
                              <button onclick="decreaseQuantityCart(\''.$gioHang['MaTK'].'\', \''.$gioHang['MaSP'].'\')">-</button>
                              <input type="text" value="'.$gioHang['SoLuong'].'" readonly id="cart-item-quantity-'.$gioHang['MaSP'].'">
                              <button onclick="increaseQuantityCart(\''.$gioHang['MaTK'].'\', \''.$gioHang['MaSP'].'\')">+</button>
                        </div>
                        <div  class="cart-item-total-price">
                              <p>'.number_format($thanhTien, 0, ',', '.').' đ</p>
                        </div>
                        <div class="cart-item-remove">
                              <button onclick="deleteCartItem(\''.$gioHang['MaTK'].'\', \''.$gioHang['MaSP'].'\')">Xóa</button>
                        </div>
                  </div>';
                  $total += $thanhTien;
            }
      ?>
      </div>
      <div id="cart-thaotac">
            <p>Tổng thanh toán: <span id="cart-total"><?php echo number_format($total, 0, ',', '.');?></span> đ</p>
            <button id="cart-buy" onclick="moveBuyView()">Mua Hàng</button>
      </div>
</div>