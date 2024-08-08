<div id="movie-wrapper">
      <div id="movie-trailer-video-modal" onclick="closeTrailer()">
      </div>
      <div id="movie-trailer">
            <div id="movie-trailer-container">
                  <img src="../IMG/<?php echo $phim['AnhPhimLon'];?>">
            </div>
            <div id="movie-trailer-modal">
                  <i class="fa-solid fa-circle-play" id="movie-trailer-start" onclick="playTrailer('<?php echo $phim['Trailer']?>')"></i>
            </div>
      </div>
      <div id="movie-detail-container">
            <div id="movie-detail">
                  <div id="movie-detail-left">
                        <img src="../IMG/<?php echo $phim['AnhPhimNho']?>" id="movie-detail-anhphimnho">
                  </div>
                  <div id="movie-detail-right">
                        <p id="movie-detail-tenphim"><h1><?php echo $phim['TenPhim']?></h1></p>
                        <p id="movie-detail-tuoiyeucau"><span>Tuổi Yêu Cầu : <?php echo $phim['TuoiYeuCau']?> Tuổi</span></p>
                        <p id="movie-detail-thoiluongphim"><span>Thời Lượng Phim : <?php echo $phim['ThoiLuongPhim']?> Phút</span></p>
                        <p id="movie-detail-ngaykhoichieu"><span>Ngày Khởi Chiếu : <?php echo $phim['NgayKhoiChieu']?></span></p>
                        <p id="movie-detail-xuatxu"><span>Xuất Xứ : <?php echo $phim['XuatXu']?></span></p>
                        <p id="movie-detail-nhasanxuat"><span>Nhà Sản Xuất : <?php echo $phim['NhaSanXuat']?></span></p>
                  </div>
            </div>
            <div id="movie-detail-about">
                  <h2>Nội dung phim</h2>
                  <p id="movie-detail-noidungphim"><?php echo $phim['ThongTin']?></p>
            </div>
      </div>
      <div id="movie-xuatchieu-container">
            <div id="movie-xuatchieu">
                  <h2>Lịch Chiếu</h2>
                  <?php
                        // Nhóm các phần tử theo NgayChieu
                        if ($lichChieu) {
                              $groupedLichChieu = [];
                              foreach ($lichChieu as $lich) {
                                    $groupedLichChieu[$lich['NgayChieu']][] = $lich;
                              }

                              // Hiển thị dữ liệu đã được nhóm
                              foreach ($groupedLichChieu as $ngay => $lichList) {
                                    $formattedNgay = date('d.m.Y', strtotime($ngay));
                                    echo "<div class='lichchieu-ngaychieu'>
                                          <h3>$formattedNgay</h3>";
                                    echo "<div class='lichchieu-thoigianbatdau'>";
                                    foreach ($lichList as $lich) {
                                          echo "<button onclick='checkLogin($lich[MaLichChieu])'>$lich[ThoiGianBatDau]</button>";
                                    }
                                    echo "</div>";
                                    echo"</div>";
                              }
                        }
                  ?>
            </div>
      </div>
</div>