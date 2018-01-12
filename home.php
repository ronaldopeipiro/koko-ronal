<?php

  require 'function.php';

  // pagination
  $jumlahdataperhalaman = 5;
  $jumlahdata = count(query("SELECT * FROM tabel_mahasiswa"));
  $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
  $halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
  $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

// menampilkan data ke layar
  $mahasiswa = query("SELECT * FROM tabel_mahasiswa ORDER BY id DESC LIMIT $awaldata,$jumlahdataperhalaman");

  if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
  }
?>

<div class="item">
      <div class="pilihan">
        <div class="tomboltambah">
          <a href="index.php?tambah">Tambah data Mahasiswa</a>
        </div>

        <div class="halaman">
          <!--  navigasi halaman -->
          <!-- navigasi mundur -->
          <?php if($halamanaktif > 1 ) : ?>
            <a href="?halaman=<?= $halamanaktif - 1; ?>"
              style="text-decoration:none; margin:5px; padding:8px; border-radius:5px;">
              &laquo; prev
            </a>
          <?php endif; ?>

          <?php for($i = 1; $i <= $jumlahhalaman; $i++ ) : ?>
            <?php if($i == $halamanaktif ) : ?>
                <a href="?halaman=<?= $i; ?>"
                  style="text-decoration:none; font-weight:bold; border:solid 2px #000; margin:5px; padding:8px; border-radius:5px;">
                  <?= $i; ?>
                </a>
            <?php else : ?>
                <a href="?halaman=<?= $i; ?>"
                  style="text-decoration:none; margin:5px; padding:8px; border-radius:5px;">
                  <?= $i; ?>
                </a>
            <?php endif; ?>
          <?php endfor; ?>

          <!-- navigasi maju -->
          <?php if($halamanaktif < $jumlahhalaman ) : ?>
            <a href="?halaman=<?= $halamanaktif + 1; ?> " style="text-decoration:none; margin:5px; padding:8px; border-radius:5px;">
              next &raquo;
            </a>
          <?php endif; ?>
        </div>
      </div>

        <!-- cari data -->
        <div class="cari">
          <form action="" method="post">
            <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian" autocomplete="off" id="keyword">
            <button type="submit" name="cari" id="tombol-cari" >Cari data</button>
            <br><br>
          </form>
        </div>


  </div>

<div id="container">
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
  <?php foreach ($mahasiswa as $row ) : ?>
      <tr>
        <td><?= $i ?></td>
        <td>
          <a href="?ubah&&id=<?= $row['id']; ?>">Ubah</a> |
          <a href="hapus.php?id=<?= $row['id']; ?>"
            onclick="return confirm('Anda yakin ingin menghapus ?');">Hapus</a>
        </td>
        <td><img src="img/<?= $row['gambar']; ?>"></td>
        <td><?= $row['nim']; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= $row['jurusan']; ?></td>
      </tr>
  <?php $i++; ?>
<?php endforeach; ?>
</table>
</div>
