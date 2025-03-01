<div id="modal-verifyEmail">
      <div id="verifyEmail-container">
                  <img src="../IMG/Avatar/logo_account.png" alt="">
                  <h3>Xác Nhận Email</h3>
                  <button onclick="window.location.href='index.php?ctrl=signinView'" id="closeVerifyEmail-btn">x</button>
                  <form>
                        <input id="token-value" type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                        <div>
                              <label for="verifyEmail">Mã Xác Nhận Email: (6 chữ số)</label><br>
                              <input type="text" name="verifyEmail" id="verifyEmail">
                              <p class="error" id="verifyEmail-error">Mã Xác Nhận không hợp lệ</p>
                        </div>
                        <div id="verifyEmail-options">
                              <button type="button" id="verifyEmail-submit" onclick="verifyEmailFunc()">Xác Nhận</button>
                        </div>
                  </form>
            </div>
      </div>
</div>