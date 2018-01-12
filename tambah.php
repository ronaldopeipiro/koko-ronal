<?php

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

  require "function.php";

  if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0 ) {
      echo "
        <script>
          alert('Data berhasil ditambahkan ');
          document.location.href = 'index.php';
        </script>
      ";
    }else {
      echo "
        <script>
          alert('Data gagal ditambahkan ');
          document.location.href = 'index.php';
        </script>
      ";
    }
  }
 ?>
  <div class="tambahdata">
    <h3>Tambah Data Mahasiswa</h3>
  </div>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
          <li>
            <label for="nim">NIM </label><br>
            <input type="text" name="nim" id="nim" required>
          </li>
          <li>
            <label for="nama">Nama </label><br>
            <input type="text" name="nama" id="nama" required>
          </li>
          <li>
            <label for="email">Email </label><br>
            <input type="email" name="email" id="email" required>
          </li>
          <li>
            <label for="jurusan">Jurusan </label><br>
            <input type="text" name="jurusan" id="jurusan" required>
          </li>
          <li>
            <label for="gambar">Gambar </label><br>
            <input type="file" name="gambar" id="gambar" required>
          </li><br><br>
              <button type="submit" name="submit">Tambah Data</button>
              <div class="tombolreset">
                <a href="?tambah">Reset</a>
              </div>
        </ul>
    </form>
<br><br>
<div class="tombolkembali">
  <a href="index.php">Kembali</a>
</div>
