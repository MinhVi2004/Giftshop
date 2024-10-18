<div id="movie-wrapper">
      <div id="movie-trailer-video-modal" onclick="closeTrailer()">
      </div>
      <div id="movie-trailer">
            <div id="movie-trailer-container">
                  <img src="../IMG/Web/<?php echo $phim['AnhPhimLon'];?>">
            </div>
            <div id="movie-trailer-modal">
                  <i class="fa-solid fa-circle-play" id="movie-trailer-start" onclick="playTrailer('<?php echo $phim['Trailer']?>')"></i>
            </div>
      </div>
      <div id="movie-detail-container">
            <div id="movie-detail">
                  <div id="movie-detail-left">
                        <img src="../IMG/Web/<?php echo $phim['AnhPhimNho']?>" id="movie-detail-anhphimnho">
                  </div>
                  <div id="movie-detail-right">
                        <p id="movie-detail-tenphim"><h1><?php echo $phim['TenPhim']?></h1></p>
                        <p id="movie-detail-tuoiyeucau">Tuổi Yêu Cầu : <span class="text-bolder"><?php echo $phim['TuoiYeuCau']?> Tuổi</span></p>
                        <p id="movie-detail-thoiluongphim">Thời Lượng Phim : <span class="text-bolder"><?php echo $phim['ThoiLuongPhim']?> Phút</span></p>
                        <p id="movie-detail-ngaykhoichieu">Ngày Khởi Chiếu : <span class="text-bolder"><?php echo $phim['NgayKhoiChieu']?></span></p>
                        <p id="movie-detail-xuatxu">Xuất Xứ : <span class="text-bolder"><?php echo $phim['XuatXu']?></span></p>
                        <p id="movie-detail-nhasanxuat">Nhà Sản Xuất : <span class="text-bolder"><?php echo $phim['NhaSanXuat']?></span></p>
                  </div>
            </div>
            <div id="movie-detail-about">
                  <h2>Nội dung phim</h2>
                  <p id="movie-detail-noidungphim"><?php echo $phim['ThongTin']?></p>
            </div>
      </div>
      <div id="movie-xuatchieu-container">
            <div id="movie-xuatchieu">
                  <?php
                        // Nhóm các phần tử theo NgayChieu
                        if ($lichChieu) {
                              echo "<h2>Lịch Chiếu</h2>";
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
      <div id="movie-binhluan-container">
            <div id="movie-binhluan">
                  <h2>Bình Luận</h2>
                  <?php
                        // if(isset($_SESSION['UserLogin']))
                        // Nhóm các phần tử theo BinhLuan
                        if ($binhLuan) {
                              foreach($binhLuan as $bl) {
                                    if($bl['TrangThaiBinhLuan'] !== "Đã Xóa") {
                                          //? Định dạng thời gian - ngày tháng năm
                                          $dateObject = new DateTime($bl['NgayBinhLuan']);
                                          $formatted_date = $dateObject->format('H:i:s - d/m/Y');
                                          if($bl['TrangThaiBinhLuan'] == "Bình Thường") { //? Bình thường
                                                echo "<div class='binhluan-card'>";
                                                            if($bl['AnhDaiDien']) 
                                                            echo "<img src='../IMG/Avatar/$bl[AnhDaiDien]' class='binhluan-avatar'>";
                                                            else 
                                                            echo "<img src='../IMG/Avatar/user-default.png' class='binhluan-avatar'>";
                                                            echo "<div class='binhluan-card-infomation'>";
                                                                  if(isset($_SESSION['UserLogin'])) //? Nếu đã đăng nhập, mà là bản thân bình luận thì hiện "Bạn"
                                                                        if($bl['MaTaiKhoan'] !== $_SESSION['UserLogin']['MaTaiKhoan'])
                                                                              echo "<h4>$bl[HoTen]</h4>";
                                                                        else 
                                                                              echo "<h4>Bạn</h4>";
                                                                  else //?Nếu chưa đăng nhập, Chỉ hiện tên người bình luận
                                                                              echo "<h4>$bl[HoTen]</h4>";
                                                                  echo "
                                                                  <p class='binhluan-card-infomation-date'>$formatted_date</p>
                                                                  <p>$bl[NoiDung]</p>
                                                            </div>
                                                      </div>";//? kết thúc binhluan-card
                                          } else { //? Ẩn danh
                                                echo "<div class='binhluan-card'>";
                                                            echo "<img src='../IMG/Avatar/user-default.png' class='binhluan-avatar'>";
                                                            echo "<div class='binhluan-card-infomation'>";
                                                                  echo "<h4>Ẩn danh</h4>";
                                                                  echo "
                                                                  <p class='binhluan-card-infomation-date'>$formatted_date</p>
                                                                  <p>$bl[NoiDung]</p>
                                                            </div>
                                                      </div>";//? kết thúc binhluan-card
                                          }
                                    }
                              }
                        } else {
                              echo "Không có bình luận.";
                        }
                  ?>
            </div>
            <div id="movie-binhluan-add">
                  <?php
                        if(isset($_SESSION['UserLogin']))
                              echo "<div id='movie-binhluan-add-info'><img src='../IMG/Avatar/".$_SESSION['UserLogin']['AnhDaiDien']."' class='binhluan-avatar'><span>Bạn</span></div>";
                        else 
                              echo "<div id='movie-binhluan-add-info'><img src='../IMG/Avatar/user-default.png' class='binhluan-avatar'><span>Bạn</span></div>";
                  ?>
                  <textarea id="movie-binhluan-box" rows="4" cols="70" placeholder="Nhập bình luận của bạn..."></textarea>
                  <center>Bình luận ẩn danh <input type='checkbox' id="movie-binhluan-andanh" ></center>
                  <?php
                        if(isset($_SESSION['UserLogin'])) {
                              echo "<center><button id='movie-binhluan-submit' onclick='binhLuan(".$_GET['id'].",  ".$_SESSION['UserLogin']['MaTaiKhoan'].")'>Gửi bình luận</button></center>";
                        } else {
                              echo "<center><button id='movie-binhluan-submit' onclick='loginBeforeComment()'>Gửi bình luận</button></center>";
                        }
                  ?>
                  
            </div>
      </div>
</div>