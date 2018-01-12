<?php
  session_start();
  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Halaman admin</title>
    <link rel="icon" href="img/icon.jpg">
    <link rel="stylesheet" href="style/style.css">
  </head>

  <body id="index">
    <header>
      <div class="navbar">
        <?php
            if (isset($_SESSION["login"])) {
              echo "
                        <a href='?logout'>Logout</a>
                        ";
                        if(isset($_GET['logout']))
                        {header('Location: logout.php'); }
            }else {
              echo "
                        <a href='?login'>Login</a>
                        <a href='?registrasi'>Sign Up</a>
                      ";
                        if(isset($_GET['login']))
                        {header('Location: login.php'); }
                        if(isset($_GET['registrasi']))
                        {header('Location: registrasi.php'); }
            }
       ?>

      </div>

        <h1>DATA MAHASISWA</h1>
        </header>
        <div class="clear"> </div>

        <div class="content">
          <?php
            if(isset($_GET["tambah"])){
              include "tambah.php";
            }elseif(isset($_GET["ubah"])) {
              include ("ubah.php");
            }else{
              include "home.php";
            }
          ?>
        </div>

      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/script.js"> </script>

  </body>
</html>
