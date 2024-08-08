<div id="booking-wrapper">
      <div id="booking-movie-trailer-video-modal" onclick="closeTrailer()">
      </div>
      <div id="booking-movie-trailer">
            <div id="booking-movie-trailer-container">
                  <img src="../IMG/<?php echo $phongChieu['AnhPhimLon'];?>">
            </div>
            <div id="booking-movie-trailer-modal">
                  <i class="fa-solid fa-circle-play" id="booking-movie-trailer-start" onclick="playTrailer('<?php echo $phongChieu['Trailer']?>')"></i>
            </div>
      </div>
      <div id="booking-movie-detail-container">
            <div id="booking-movie-detail">
                  <div id="booking-movie-detail-left">
                        <img src="../IMG/<?php echo $phongChieu['AnhPhimNho']?>" id="booking-movie-detail-anhphimnho">
                  </div>
                  <div id="booking-movie-detail-right">
                        <p id="booking-movie-detail-ngaykhoichieu">Ngày Khởi Chiếu : <?php echo $phongChieu['NgayKhoiChieu']?></p>
                        <p id="booking-movie-detail-tuoiyeucau">Tuổi Yêu Cầu : <?php echo $phongChieu['TuoiYeuCau']?> Tuổi</p>
                        <p id="booking-movie-detail-thoiluongphim">Thời Lượng Phim : <?php echo $phongChieu['ThoiLuongPhim']?> Phút</p>
                        <p id="booking-movie-detail-xuatxu">Xuất Xứ : <?php echo $phongChieu['XuatXu']?></p>
                        <p id="booking-movie-detail-nhasanxuat">Nhà Sản Xuất : <?php echo $phongChieu['NhaSanXuat']?></p>
                  </div>
            </div>
      </div>
      <div id="booking-detail">
            <h3>
                  <?php
                        echo date('d.m.Y', strtotime($phongChieu['NgayChieu'])) . "-" . $phongChieu['ThoiGianBatDau'];
                  ?>
            </h3>
      </div>
      
      <center id="booking-screen">
            Màn Hình
            <div id="booking-seat-container">
                  <?php
                        for($i = 1; $i <= $phongChieu['SoLuongGhe']; $i++) {
                              if(!in_array($i,$ve)) {
                                    echo "<input type='checkbox' id='seat-$i' class='seat-checkbox' value='$i' onchange='showPrice()'>
                                          <label for='seat-$i' class='seat'><span>$i</span></label>";
                              }
                              else {
                                    echo "<input type='checkbox' id='seat-$i' class='seat-checkbox' value='$i' onchange='showPrice()' disabled>
                                          <label for='seat-$i' class='seat'><span>$i</span></label>";
                              }
                        }
                  ?>
            </div>
            <div id="booking-ticket-class">
                  <?php
                        foreach($loaiVe as $loai) {
                              echo "<input type='radio' name='ticket-class' class='ticket-class' id='ticket-class-$loai[MaLoaiVe]' value='$loai[MaLoaiVe]' price='$loai[DonGia]' onchange='showPrice()'>
                              <label for='ticket-class-$loai[MaLoaiVe]' class='seat'><span>$loai[TenLoaiVe]</span></label>";
                        }
                  ?>
            </div>
            <div id="booking-total">
                  <p>Tổng : <span id="booking-total-price" value="0">0</span></p>
            </div>
            <br>
            <!-- <button id="muave-btn" onclick="muave(<?php echo $phongChieu['MaLichChieu']?>)">Thanh Toán</button> -->
            <button id="muave-btn" onclick="thanhToan(<?php echo $phongChieu['MaLichChieu']?>)">Thanh Toán</button>
      </center>
</div>