<?php
  session_start();

  require "function.php";

  // cek cookie
  if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result =  mysqli_query($conn,"SELECT username FROM users WHERE id = $id ");
    $row = mysqli_fetch_assoc($result);

    // cek cookie
    if ($key === hash('sha256', $row['username'])) {
      $_SESSION['login'] = true;
    }
  }

  // cek session
  if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
  }

  if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username ='$username' ");

    if (mysqli_num_rows($result) === 1 ) {
      $row = mysqli_fetch_assoc($result);
      if(password_verify($password, $row["password"]) ){
        // set session
        $_SESSION["login"] = true;

        if (isset($_POST['remember'])) {
          setcookie('id', $row['id'], time() +60);
          setcookie('key', hash('sha256', $row['username']), time() +60);
        }
        header("Location: index.php");
        exit;
      }
    }
    $error = true;
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body id="form">
    <form action="" method="post" id="formlogin">
      <div class="head">
        <h3>LOGIN</h3><br><br>
      </div>
      <div class="unit">
      <?php if (isset($error)) : ?>
        <p style="color:red; font-style:italic; ">
          Username atau Password salah
        </p>
      <?php endif; ?>
      <div id="masuk">
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
      </div>
        <br>
        <div class="remember">
          <input type="checkbox" name="remember" id="remember" >
          <label for="remember">Remember me </label>
        </div>
        <br><br><br>
        <input type="submit" name="login" value="Login">
        <br><br>
        Belum punya akun ?<a href="registrasi.php">&nbsp;&nbsp; Daftar</a>
     </div>
    </form>

  </body>
</html>
