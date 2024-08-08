<div id="modal-changePassword">
      <div id="changePassword-container">
                  <img src="../IMG/logo_account.png" alt="">
                  <h3>Tạo mật khẩu mới</h3>
                  <button onclick="window.location.href='../User/index.php'" id="closeChangePassword-btn">x</button>
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
                        </div>
                  </form>
            </div>
      </div>
</div>