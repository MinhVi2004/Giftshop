<?php
      session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link rel="icon" href="../IMG/Avatar/galaxy-logo.png">
      <link rel="stylesheet" href="CSS/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="Js/AccountJs.js"></script>
      <title>Galaxy Cinema</title>
</head>
<body>
      <?php
            require("Controller/AccountController.php");
      ?>
</body>
</html>