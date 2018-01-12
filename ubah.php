<?php

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "function.php";

  $id = $_GET["id"];
  $mhs = query("SELECT * FROM tabel_mahasiswa WHERE id = $id")[0];

  if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0 ) {
              echo "
                        <script>
                          alert('Data berhasil diubah ');
                          document.location.href = 'index.php';
                        </script>
                      ";
    }else {
              echo "
                        <script>
                          alert('Data gagal diubah ');
                          document.location.href = 'index.php';
                        </script>
                      ";
    }
  }
 ?>
    <h1>Ubah Data Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $mhs['id']; ?>" >
      <input type="hidden" name="gambarlama" value="<?= $mhs['gambar']; ?>" >
        <ul>
          <li>
            <label for="nim">NIM :</label>
            <input type="text" name="nim" id="nim" required value="<?= $mhs['nim']; ?>">
          </li>
          <li>
            <label for="nama">Nama :</label>
            <input type="text" name="nama" id="nama" required value="<?= $mhs['nama']; ?>">
          </li>
          <li>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required value="<?= $mhs['email']; ?>">
          </li>
          <li>
            <label for="jurusan">Jurusan :</label>
            <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs['jurusan']; ?>">
          </li>
          <li>
            <label for="gambar">Gambar :</label><br>
            <img src="img/<?= $mhs['gambar']; ?>" > <br>
            <input type="file" name="gambar" id="gambar">
          </li><br><br>
          <li>
            <button type="submit" name="submit">Ubah Data</button>
          </li>
        </ul>
    </form>
