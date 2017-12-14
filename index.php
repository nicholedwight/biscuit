<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Biscuit</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php
    if (!isset($_SESSION)) { ?>
    <a href="login.php">Login</a>
    <?php 
    } 
    echo "<pre>";
    var_dump($_SESSION); 
    ?>
    </pre>
  </body>
</html>
