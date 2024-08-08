<div id="homePage-wrapper">
      <div id="movie-trailer-video-modal" onclick="closeTrailer()">
      </div>
      <?php
            foreach($phimList as $phim) {
                  if($phim['TrangThai'] != "Ẩn Phim")
                        echo "<div class='card' onclick='window.location.href=\"index.php?ctrl=movie&id=$phim[MaPhim]\"'>
                                    <div class='card-img'>
                                          <img src='../IMG/$phim[AnhPhimNho]' alt=''>
                                          <div class='card-float'>
                                                <button class='card-buy'><i class='fa-solid fa-ticket'></i> Mua vé</button>
                                                <button class='card-trailer' onclick='event.stopPropagation(); playTrailer(\"$phim[Trailer]\")'><i class='fa-solid fa-circle-play'></i> Trailer</button>
                                          </div>
                                    </div>
                                    <h3 id='card-name'>$phim[TenPhim]</h3>
                              </div>";
            }
      ?>
</div>