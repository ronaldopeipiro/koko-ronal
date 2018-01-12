<?php
// koneksi
  $conn = mysqli_connect("localhost","root","","phpdasar");

  function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  }

// tambah data
  function tambah($data){
    global $conn;

    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
      return false;
    }

    $query = "INSERT INTO tabel_mahasiswa VALUES ('','$nama','$nim','$email','$jurusan','$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  // function upload
  function upload(){
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4 ) {
      echo "<script>
                alert('Silahkan pilih gambar terlebih dahulu ! ');
              </script>
              ";
      return false;
    }

    // cek apakah yang akan diupload adalah gambar
    $ekstensigambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar = explode('.',$namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));

    if (!in_array($ekstensigambar,$ekstensigambarvalid)) {
      echo "<script>
                alert('File yang anda pilih bukan gambar ! ');
              </script>
              ";
      return false;
    }

    if ($ukuranfile > 1000000 ) {
      echo "<script>
                alert('Ukuran gambar terlalu besar ! ');
              </script>
              ";
      return false;
    }

    // generate nama file agar unik
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpname, 'img/'.$namafilebaru);
    return $namafilebaru;

  }

  // hapus data
  function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM tabel_mahasiswa WHERE id = $id ");
    return mysqli_affected_rows($conn);
  }

  // ubah data
  function ubah($data){
    global $conn;

    $id = $data["id"];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4 ) {
      $gambar = $gambarlama;
    }else {
      $gambar = upload();
    }

    $query = "UPDATE tabel_mahasiswa SET nim='$nim', nama='$nama', email='$email', jurusan='$jurusan', gambar='$gambar' WHERE id=$id ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
  }

  // cari data
  function cari($keyword) {
    $query = "SELECT * FROM tabel_mahasiswa WHERE
                  nama LIKE '%$keyword%' OR
                  nim LIKE '%$keyword%' OR
                  email LIKE '%$keyword%' OR
                  jurusan LIKE '%$keyword%'
                ";

    return query($query);
  }

  // Registrasi
      function registrasi($data){
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn,$data["password"]);
        $password2 = mysqli_real_escape_string($conn,$data["password2"]);

        // cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM users WHERE username='$username' ");
        if(mysqli_fetch_assoc($result)){
          echo "<script>
                    alert('Username sudah terdaftar ! ');
                  </script>";
                  return false;
        }
        if ($password !== $password2) {
          echo "<script>
                    alert('Password tidak sesuai dengan konfirmasi ! ');
                  </script>";
          return false;
        }
        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // tambah user baru ke database
        mysqli_query($conn, "INSERT INTO users VALUES ('','$username','$password')");
        return mysqli_affected_rows($conn);

      }

 ?>
