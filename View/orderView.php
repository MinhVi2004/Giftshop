<div id="order-container">
      <p style="margin:22px; font-size:25px;" >| Đơn Mua | Bạn đã đặt 
      <?php 
            if(isset($listDonHang)) {
                  echo count($listDonHang);
            } else {
                  echo 0;
            }
      ?> 
      đơn hàng</p>
      <div id="order-listDonHang">
            <div class="order-header-item">
                  <div class="order-header-item-img" style="font-size: 22px;">Sản Phẩm</div>
                  <div class="order-header-item-name"></div>
                  <div class="order-header-item-price">Đơn Giá</div>
                  <div class="order-header-item-quantity-change">Số Lượng</div>
                  <div class="order-header-item-total-price"><p>Thành Tiền</p></div>
            </div>
            <?php
            if(isset($listDonHang) && count($listDonHang) > 0) {
                  for($i = 0; $i < count($listDonHang); $i++) {
                        echo '<div class="order-item">';
                        echo '';
                        foreach($listDetailDonHang[$i] as $chiTietDonHang) {
                              echo '<div class="order-item-sanpham">';
                              echo '<img src="'.$chiTietDonHang['AnhSP'].'" alt="Ảnh Sản Phẩm">
                                    <div class="order-item-name">
                                          <p>'.$chiTietDonHang['TenSP'].'</p>
                                    </div>
                                    <div class="order-item-price">
                                    <p>'.number_format($chiTietDonHang['GiaLucMua'], 0, ',', '.').' đ</p>
                                    </div>
                                    <div class="order-item-quantity-change">
                                          <span> '.$chiTietDonHang['SoLuong'].'</span>
                                    </div>
                                    <div  class="order-item-total-price">
                                          <p>'.number_format($chiTietDonHang['TongThanhToan'], 0, ',', '.').' đ</p>
                                    </div>';
                              echo '</div>';
                        }
                        echo '<div id="order-thaotac">
                              <div style="display:flex; flex-direction: column; justify-content: center; width:auto; min-width:250px;">';
                                    // <div style="display:flex; justify-content: space-between;">
                                    //       <span>Tổng giá trị: </span>
                                    //       <span id="order-total" data-value="0" class="money-amount">'.number_format($listDonHang[$i]['TongGiaTri'], 0, ',', '.').' đ</span>
                                    // </div>
                                    // <div style="display:flex; justify-content: space-between;">
                                    //       <span>Giảm giá: </span>
                                    //       <span id="order-discount" data-value="0" class="money-amount">'.number_format($listDonHang[$i]['TienGiamGia'], 0, ',', '.').' đ</span>
                                    // </div>
                                    echo '<div style="display:flex; justify-content: space-between;">
                                          <span>Thanh toán: </span>
                                          <span id="order-final" data-value="0" class="money-amount">'.number_format($listDonHang[$i]['TongThanhToan'], 0, ',', '.').' đ</span>
                                    </div>
                                    <div style="display:flex; justify-content: space-between;">
                                          <span>Trạng thái: </span>';
                                    switch ($listDonHang[$i]['TrangThaiDH']) {
                                          case 'Chưa Xác Nhận':
                                    echo '<span id="order-final" data-value="0" class="order-trangthai" style="color:orange;">'.$listDonHang[$i]['TrangThaiDH'].'</span>';
                                                break;
                                          case 'Đã Xác Nhận':
                                    echo '<span id="order-final" data-value="0" class="order-trangthai" style="color:orange;">'.$listDonHang[$i]['TrangThaiDH'].'</span>';
                                                break;
                                          case 'Hoàn Thành':
                                    echo '<span id="order-final" data-value="0" class="order-trangthai" style="color:#05cc06;">'.$listDonHang[$i]['TrangThaiDH'].'</span>';
                                                break;
                                          case 'Hủy':
                                    echo '<span id="order-final" data-value="0" class="order-trangthai" style="color:red;">'.$listDonHang[$i]['TrangThaiDH'].'</span>';
                                                break;
                                          
                                          default:
                                          echo '<span id="order-final" data-value="0" class="order-trangthai">'.$listDonHang[$i]['TrangThaiDH'].'</span>';
                                                break;
                                    }
                                    echo '</div>
                              </div>
                              <button id="order-orderDetail" onclick="window.location.href=\'index.php?ctrl=orderDetailView&id='.$listDonHang[$i]['MaDH'].'\'">Xem Chi Tiết</button>
                        </div>';
                        echo '</div>';
                  }
            }
            ?>
      </div>
</div>