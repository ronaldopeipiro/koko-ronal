<?php
  $conn = mysqli_connect("localhost","root","","phpdasar");
  $result = mysqli_query($conn, "SELECT * FROM tabel_mahasiswa");

  // $mhs = mysqli_fetch_row($result);

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Halaman admin</title>
  </head>
  <body>

    <h1>Daftar mahasiswa</h1>

    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
      </tr>

      <?php $i =1; ?>
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= $i ?></td>
            <td>
              <a href="#">Ubah</a> |
              <a href="#">Hapus</a>
            </td>
            <td><img src="img/<?= $row['gambar']; ?>"></td>
            <td><?= $row['nim']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['jurusan']; ?></td>
          </tr>
      <?php $i++; ?>
      <?php endwhile; ?>
    </table>

  </body>
</html>
