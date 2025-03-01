
<p style="margin:22px; font-size:25px;" >| Thông tin tài khoản</p>
<div id="updateProfile-container">
            <h3 style="font-size:50px;"><i class="fa-solid fa-user"></i></h3>
            <!-- <button onclick="window.location.href='../index.php'" id="closeupdateProfile-btn">x</button> -->
            <form>
                  <div>
                        <label for="updateProfile-fullname">Họ và tên</label><br>
                        <input type="text" name="updateProfile-fullname" id="updateProfile-fullname" value="<?php echo $_SESSION['GiftShopUser']['HoTen'] ?>">
                        <p class="error" id="updateProfile-fullname-error">Họ và tên không hợp lệ</p>
                  </div>
                  <div>
                        <label for="updateProfile-phone">Số Điện Thoại</label><br>
                        <input type="text" name="updateProfile-phone" id="updateProfile-phone" value="<?php
                        if($_SESSION['GiftShopUser']['SoDienThoaiTK'] !== null) 
                              echo $_SESSION['GiftShopUser']['SoDienThoaiTK'] ;
                        else 
                              echo "0"; 
                        ?>">
                        <p class="error" id="updateProfile-phone-error">Số điện thoại không hợp lệ</p>
                  </div>
                  <div>
                        <label for="updateProfile-email">Email</label><br>
                        <input type="email" name="updateProfile-email" id="updateProfile-email" value="<?php echo $_SESSION['GiftShopUser']['Email'] ?>">
                        <p class="error" id="updateProfile-email-error">Email không hợp lệ</p>
                  </div>
                  <div id="updateProfile-options">
                        <button type="button" id="updateProfile-submit" onclick="updateAccount()">Cập nhật thông tin</button>
                        <button type="button" id="updateProfile-changePassword" onclick="window.location.href='index.php?ctrl=changePasswordView'">Đổi mật khẩu</button>
                        <button type="button" id="updateProfile-back" class="back" onclick="window.location.href='index.php'">Trở về</button>
                  </div>
            </form>
            </div>
      </div>
</div>