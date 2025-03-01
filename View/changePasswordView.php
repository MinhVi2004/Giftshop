<div id="modal-changePassword">
<p style="margin:22px; font-size:25px;" >| Tạo Mật Khẩu</p>
      <div id="changePassword-container">
                  <!-- <h3>Tạo mật khẩu mới</h3> -->
                  <h3 style="font-size:50px;"><i class="fa-solid fa-user"></i></h3>
                  <!-- <button onclick="window.location.href='../index.php'" id="closeChangePassword-btn">x</button> -->
                  <form>
                        <div>
                              <label for="changePassword-oldpassword">Mật khẩu cũ</label><br>
                              <input type="password" name="changePassword-oldpassword" id="changePassword-oldpassword">
                              <p class="error" id="changePassword-oldpassword-error">Mật khẩu cũ không hợp lệ</p>
                        </div>
                        <div>
                              <label for="changePassword-password">Mật khẩu mới</label><br>
                              <input type="password" name="changePassword-password" id="changePassword-password">
                              <p class="error" id="changePassword-password-error">Mật khẩu mới không hợp lệ</p>
                        </div>
                        <div>
                              <label for="changePassword-repassword">Xác nhận mật khẩu</label><br>
                              <input type="password" name="changePassword-repassword" id="changePassword-repassword">
                              <p class="error" id="changePassword-repassword-error">Xác nhận mật khẩu không hợp lệ</p>
                        </div>
                        <div id="changePassword-options">
                              <button type="button" id="changePassword-submit" onclick="changePassword()">Xác nhận</button>
                              <button type="button" id="changePassword-back" class="back" onclick="window.location.href='index.php'">Trở Về</button>   
                        </div>
                  </form>
            </div>
      </div>
</div>