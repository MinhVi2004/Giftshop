<div id="modal-fillEmail">
      <div id="fillEmail-container">
                  <img src="../IMG/logo_account.png" alt="">
                  <h3>Khôi phục mật khẩu</h3>
                  <button onclick="window.location.href='index.php?ctrl=loginView'" id="closeFillEmail-btn">x</button>
                  <form>
                        <div>
                              <label for="fillEmail-email">Email</label><br>
                              <input type="email" name="fillEmail-email" id="fillEmail-email">
                              <p class="error" id="fillEmail-email-error">Email không hợp lệ</p>
                        </div>
                        <div id="fillEmail-options">
                              <button type="button" id="fillEmail-submit" onclick="fillEmail()">Xác nhận</button>
                              <button type="button" id="fillEmail-login-btn" onclick="window.location.href='index.php?ctrl=loginView'">Đăng nhập</button>
                        </div>
                  </form>
            </div>
      </div>
</div>