<div id="modal-login">
      <div id="login-container">
            <!-- <img src="../IMG/Avatar/logo_account.png" alt=""> -->
            <h3>Đăng Nhập</h3>
            <button onclick="window.location.href='../index.php'" id="closeLogin-btn">x</button>
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
                  <a id="forgot-password" href="index.php?ctrl=forgotPasswordViewEmail">Quên mật khẩu?</a>
                  <div id="login-options">
                        <button type="button" id="login-submit" onclick="login()">Đăng Nhập</button>
                        <?php
                        $client = new Google_Client();
                        $client->setClientId(GOOGLE_CLIENT_ID);
                        $client->setClientSecret(GOOGLE_CLIENT_SECRET);
                        $client->setRedirectUri(GOOGLE_REDIRECT_URL);
                        $client->addScope('email');
                        $client->addScope('profile');
                        // echo GOOGLE_REDIRECT_URL;
                        // Tạo URL để người dùng đăng nhập
                        $loginUrl = $client->createAuthUrl();
                        echo "<a href='".htmlspecialchars($loginUrl)."'><button type='button' id='login-gmail'><i class='fa-brands fa-google'></i> Google</button></a>";
                        ?>
                        
                        <?php
                              $fb = new Facebook\Facebook([
                              'app_id' => '1119024856177338',
                              'app_secret' => '154734aff5ae5414fe348204250d05b6',
                              'default_graph_version' => 'v2.9',
                              ]);
                              $helper = $fb->getRedirectLoginHelper();
                              $permissions = ['email']; // Optional permissions
                              $loginUrlFB = $helper->getLoginUrl('http://localhost/GiftShop/Account/Controller/loginFBSuccess.php', $permissions);
                              echo "<a href='".$loginUrlFB."'><button type='button' id='login-fb'><i class='fa-brands fa-facebook'></i> Facebook</button></a>";
                        ?>
                        
                        <button type="button" id="signin-btn" onclick="window.location.href='index.php?ctrl=signinView'">Chưa có tài khoản ?</button>
                  </div>
            </form>
      </div>
</div>