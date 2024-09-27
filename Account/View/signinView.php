<div id="modal-signin">
      <div id="signin-container">    
            <img src="../IMG/Avatar/logo_account.png" alt="">
            <h3>Đăng Ký</h3>
            <button onclick="window.location.href='../User/index.php'" id="closeSignin-btn">x</button>
            <form>
            <div>
            <label for="signin-username">Tên Đăng Nhập</label><br>
            <input type="text" name="signin-username" id="signin-username" autofocus>
            <p class="error" id="signin-username-error">Tên đăng nhập không hợp lệ</p>
            </div>
            <div>
                  <label for="signin-password">Mật Khẩu</label><br>
                  <input type="password" name="signin-password" id="signin-password">
                  <p class="error" id="signin-password-error">Mật khẩu không hợp lệ</p> 
            </div>
            <div>
                  <label for="signin-repassword">Xác nhận mật Khẩu</label><br>
                  <input type="password" name="signin-repassword" id="signin-repassword">
                  <p class="error" id="signin-repassword-error">Vui lòng nhập lại mật khẩu</p>
            </div>
            <div>
                  <label for="signin-fullname">Họ và tên</label><br>
                  <input type="text" name="signin-fullname" id="signin-fullname">
                  <p class="error" id="signin-fullname-error">Họ và tên không hợp lệ</p>
            </div>
            <div>
                  <label for="signin-birthday">Ngày Sinh</label><br>
                  <input type="date" name="signin-birthday" id="signin-birthday">
                  <p class="error" id="signin-birthday-error">Ngày sinh không hợp lệ</p>
            </div>
            <div>
                  <label for="signin-phone">Số Điện Thoại</label><br>
                  <input type="text" name="signin-phone" id="signin-phone">
                  <p class="error" id="signin-phone-error">Số điện thoại không hợp lệ</p>
            </div>
            <div>
                  <label for="signin-email">Email</label><br>
                  <input type="email" name="signin-email" id="signin-email">
                  <p class="error" id="signin-email-error">Email không hợp lệ</p>
            </div>
            <div id="signin-options">
                  <button type="button" id="signin-submit" onclick="signin()">Đăng Ký</button>
                  <button id="login-btn" type="button" onclick="window.location.href='index.php?ctrl=loginView'">Đã đăng ký?</button>
            </div>
            </form>
      </div>
</div>