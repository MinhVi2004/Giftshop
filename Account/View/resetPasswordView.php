<div id="modal-resetPassword">
      <div id="resetPassword-container">
                  <img src="../IMG/logo_account.png" alt="">
                  <h3>Tạo mật khẩu mới</h3>
                  <button onclick="window.location.href='index.php?ctrl=loginView'" id="closeResetPassword-btn">x</button>
                  <form>
                        <input id="token-value" type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                        <div>
                              <label for="resetPassword-password">Mật khẩu mới</label><br>
                              <input type="password" name="resetPassword-password" id="resetPassword-password">
                              <p class="error" id="resetPassword-password-error">Mật khẩu mới không hợp lệ</p>
                        </div>
                        <div>
                              <label for="resetPassword-repassword">Xác nhận mật khẩu</label><br>
                              <input type="password" name="resetPassword-repassword" id="resetPassword-repassword">
                              <p class="error" id="resetPassword-repassword-error">Xác nhận mật khẩu không hợp lệ</p>
                        </div>
                        <div id="resetPassword-options">
                              <button type="button" id="resetPassword-submit" onclick="resetPassword()">Đặt lại mật khẩu</button>
                        </div>
                  </form>
            </div>
      </div>
</div>