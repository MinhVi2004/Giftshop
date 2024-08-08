<div id="modal-login">
      <div id="login-container">
            <img src="../IMG/logo_account.png" alt="">
            <h3>Đăng Nhập</h3>
            <button onclick="window.location.href='../User/index.php'" id="closeLogin-btn">x</button>
            <form>
                  <div>
                        <label for="login-username">Tên Đăng Nhập</label><br>
                        <input type="username" name="login-username" id="login-username" autofocus>
                  </div>
                  <div>
                        <label for="login-password">Mật Khẩu</label><br>
                        <input type="password" name="login-password" id="login-password">
                        <p id="login-error" class="error">Tài khoản hoặc mật khẩu không hợp lệ</p>
                  </div>
                  <a id="forgot-password" href="index.php?ctrl=forgotPasswordView">Quên mật khẩu?</a>
                  <div id="login-options">
                        <button type="button" id="login-submit" onclick="login()">Đăng Nhập</button>
                        <button type="button" id="signin-btn" onclick="window.location.href='index.php?ctrl=signinView'">Chưa có tài khoản ?</button>
                  </div>
            </form>
      </div>
</div>