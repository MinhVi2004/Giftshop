<div id="content">
      <p style="margin-top:20px; font-size:25px;width:100%;" >| Trang Chủ</p>
      <div id="listSanPham">
            <?php
            if(isset($listSanPham))
                  foreach($listSanPham as $sanPham) {
                        echo "<div class='product'  onclick='productDetail(\"$sanPham[MaSP]\",\"$sanPham[TenSP]\",\"$sanPham[AnhSP]\",\"$sanPham[MoTaSP]\",\"$sanPham[GiaSP]\")'>   
                                    <img src='$sanPham[AnhSP]' alt='' class='product-img'>
                                    <p class='product-name' style='color:#333;font-weight: bold;font-size:23px;'>$sanPham[TenSP]</p>
                                    <p class='product-price' style='color:#ff5733;font-weight: bold;font-size:18px;'>".number_format($sanPham['GiaSP'], 0, ',', '.')." đ</p>
                              </div>";
                  }     
            ?>
      </div>
</div>