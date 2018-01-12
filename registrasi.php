<?php
  require "function.php";

  if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
      echo "<script>
                alert('user baru berhasil ditambahkan ! ');
              </script>
             ";
    }else {
      echo mysqli_error($conn);
    }
  }

?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body id="form">
    <form action="" method="post" id="formlogin">
      <div class="head">
        <h3>REGISTRASI</h3><br><br>
      </div>
      <div class="unit">
        <div id="registrasi">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password2" placeholder="Konfirmasi Password" required>
       </div>
        <br>
        <input type="submit" name="register" value="Daftar" >
        <br><br>
        Sudah punya akun ? <a href="login.php">&nbsp;&nbsp; Login</a>
      </div>
    </form>

  </body>
</html>
