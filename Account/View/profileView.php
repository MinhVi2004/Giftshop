
<div id="modal-profile">
      <div id="profile-container">
                  <h3>Thông tin tài khoản</h3>
                  <?php 
                        if($_SESSION['UserLogin']['AnhDaiDien']) {
                              echo "<img src='../IMG/Avatar/".$_SESSION["UserLogin"]["AnhDaiDien"]."'>";
                        } else {
                              echo "<form id='uploadForm' enctype='multipart/form-data'>
                                    <img src='../IMG/Avatar/user-default.png'>
                                    <input type='file' name='inputUploadAvatar' id='inputUploadAvatar' accept='image/*'>
                                    <button type='button' onclick='uploadAvatar()'>Xác nhận</button>
                                    </form>";
                        }
                  ?>
                  <button onclick="window.location.href='../User/index.php'" id="closeProfile-btn">x</button>
                  <form>
                        <div>
                              <label for="profile-fullname">Họ và tên</label><br>
                              <input type="text" name="profile-fullname" id="profile-fullname" value="<?php echo $_SESSION['UserLogin']['HoTen'] ?>">
                              <p class="error" id="profile-fullname-error">Họ và tên không hợp lệ</p>
                        </div>
                        <div>
                              <label for="profile-birthday">Ngày Sinh</label><br>
                              <input type="date" name="profile-birthday" id="profile-birthday" value="<?php echo $_SESSION['UserLogin']['NgaySinh'] ?>">
                              <p class="error" id="profile-birthday-error">Ngày sinh không hợp lệ</p>
                        </div>
                        <div>
                              <label for="profile-phone">Số Điện Thoại</label><br>
                              <input type="text" name="profile-phone" id="profile-phone" value="<?php echo $_SESSION['UserLogin']['SoDienThoai'] ?>">
                              <p class="error" id="profile-phone-error">Số điện thoại không hợp lệ</p>
                        </div>
                        <div>
                              <label for="profile-email">Email</label><br>
                              <input type="email" name="profile-email" id="profile-email" value="<?php echo $_SESSION['UserLogin']['Email'] ?>">
                              <p class="error" id="profile-email-error">Email không hợp lệ</p>
                        </div>
                        <div id="profile-options">
                              <button type="button" id="profile-submit" onclick="updateAccount()">Cập nhật thông tin</button>
                              <button type="button" id="profile-changePassword" onclick="window.location.href='index.php?ctrl=changePasswordView'">Đổi mật khẩu</button>
                        </div>
                  </form>
            </div>
            </div>
</div>