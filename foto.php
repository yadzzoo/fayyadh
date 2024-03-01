<?php
include "connection.php";
session_start();

if (isset($_POST['tambah'])) {
  $judulfoto = $_POST['judulfoto'];
  $deskripsifoto = $_POST['deskripsifoto'];
  $albumid = $_POST['albumid'];
  $tanggalunggah = date("Y-m-d");
  $userid = $_SESSION['userid'];

  $rand = rand();
  $ekstensi =  array('png', 'jpg', 'jpeg', 'gif', 'webp');
  $filename = $_FILES['lokasifile']['name'];
  $ukuran = $_FILES['lokasifile']['size'];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  // //opsi cek ekstensi file
  // $type1 = explode('.', $filename);
  // $type2 = $type1[1];

  if (!in_array($ext, $ekstensi)) {
    echo "<script>
        alert('format file foto tidak sesuai');
        location.href='foto.php';
        </script>";
  } else {
    if ($ukuran < 1044070) {
      $xx = $rand . '_' . $filename;
      move_uploaded_file($_FILES['lokasifile']['tmp_name'], 'photo_storage/' . $rand . '_' . $filename);
      mysqli_query($conn, "INSERT INTO foto VALUES(NULL,'$judulfoto','$deskripsifoto','$tanggalunggah','$xx','$albumid','$userid')");
      echo "<script>
            alert('tambah foto berhasil');
            location.href='foto.php';
            </script>";
    } else {
      echo "<script>
          alert('format ukuran file foto tidak sesuai');
          location.href='foto.php';
          </script>";
    }
    $conn->close();
  }
}

// if (isset($_GET['fotoid'])) {
//   $albumid = $_GET['fotoid'];
//   $sql = mysqli_query($conn, "delete from foto where fotoid='$fotoid'");
//   echo "<script>
//         alert('hapus foto berhasil');
//         location.href='album.php';
//       </script>";
// }

if (isset($_GET['fotoid'])) {
  $fotoid = $_GET['fotoid'];

  $sql = mysqli_query($conn, "delete from foto where fotoid='$fotoid'");
  if ($sql) {
    echo "<script>
            alert('delete foto berhasil');
            location.href='foto.php';
            </script>";
  } else {
    echo "<script>
            alert('delete foto gagal');
            location.href='foto.php';
            </script>";
  }
  $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PICTKLISE </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <style>
    h1 {
      font-family: "Poppins", sans-serif;
  font-weight: 700;
  font-style: normal;
      }
    </style>
  </head>
<body>
    <?php
    include "layout/header_admin.html";
    ?>

    <main>
    <div class="container">
    <h1 class="mt-2 text-center" style="color: rgb(25, 135, 84)" id="font">Selamat Datang <?= $_SESSION['namalengkap'] ?> </h1>
    <hr>

    <div class="container row">
      <div class="col-sm-3">
        <h1 style="color: rgb(25, 135, 84)" class="text-center">FOTO</h1>
        <form action="foto.php" method="POST" enctype="multipart/form-data" class=" pb-sm-3">
          <div class="mb-3 mt-3">
            <label for="judulfoto">Judul Foto</label>
            <input type="text" class="form-control" id="judulfoto" placeholder="Enter Judul Foto" name="judulfoto">
          </div>
          <div class="mb-3">
            <label for="deskripsifoto">Deskripsi Foto</label>
            <textarea name="deskripsifoto" id="deskripsifoto" class="form-control" rows="7" placeholder="enter deskripsi foto"></textarea>
          </div>
          <div class="mb-3">
            <label for="lokasifile">Upload Foto</label>
            <input type="file" name="lokasifile" id="lokasifile" class="form-control">
          </div>
          <div class="mb-3">
            <label for="albumid">Album</label>
            <select name="albumid" id="albumid" class="form-control">
              <?php
              $userid = $_SESSION['userid'];
              $sql = mysqli_query($conn, "select * from album where userid='$userid'");
              while ($data = mysqli_fetch_array($sql)) {
              ?>
                <option value="<?= $data['albumid'] ?>"><?= $data['namaalbum'] ?></option>
              <?php
              }

              ?>
            </select>
          </div>
          <button type="submit" class="btn btn-success" name="tambah">Tambah Foto</button>
        </form>
      </div>
      <div class="col-sm-9">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul Foto</th>
              <th>Deskripsi</th>
              <th>Tanggal Upload</th>
              <th>Foto</th>
              <th>Nama Album</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $urut = 1;
            $userid = $_SESSION['userid'];
            $sql = mysqli_query($conn, "select * from foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
              <tr>
                <td><?= $urut++ ?></td>
                <td><?= $data['judulfoto'] ?></td>
                <td><?= $data['deskripsifoto'] ?></td>
                <td><?= $data['tanggalunggah'] ?></td>
                <td><img src="photo_storage/<?= $data['lokasifile'] ?>" width="100px"></td>
                <td><?= $data['namaalbum'] ?></td>
                <td>
                  <a href="foto.php?fotoid=<?= $data['fotoid'] ?>" onclick="return confirm('Yakin menghapus data?')"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                  <a href="foto_edit.php?fotoid=<?= $data['fotoid'] ?>"><button type="button" class="btn btn-outline-success">Edit</button></a>
                </td>
              </tr>
            <?php
            }

            ?>
          </tbody>

        </table>
      </div>
    </div>

  </div>
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
    include "layout/footer.html";
    ?>
</body>
</html>