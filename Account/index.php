<?php
      session_start();
      require_once( '../vendor/autoload.php' );
      require_once ('../Resource/configGmail.php');
      // ini_set('display_errors', 1);
      // ini_set('display_startup_errors', 1);
      // error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link rel="icon" href="../IMG/Web/logo_square.png">
      <link rel="stylesheet" href="Css/styleAccount.css">
      <!-- <link href="../Lib/bootstrap-5.2.3-dist/css/bootstrap.min.css" rel="stylesheet"> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="Js/AccountJs.js"></script>
      <title>Gift Shop</title>
</head>
<body>
      <div id="customalert">
      </div>
      <div id="customConfirm" class="confirm-box" style="display: none;">
            <div class="confirm-content">
                  <p id="confirmMessage">Bạn có chắc chắn?</p>
                  <button id="confirmYes">Đồng ý</button>
                  <button id="confirmNo">Hủy</button>
            </div>
      </div>
      <?php
            require("Controller/AccountController.php");
      ?>
</body>
</html>