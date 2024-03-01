<?php
include "connection.php";
session_start();

if (isset($_GET['albumid'])) {
  $albumid = $_GET['albumid'];
  $sql = mysqli_query($conn, "select * from album where albumid='$albumid'");
}

if (isset($_POST['update'])) {
  $albumid = $_POST['albumid'];
  $namaalbum = $_POST['namaalbum'];
  $deskripsi = $_POST['deskripsi'];

  $sql = mysqli_query($conn, "UPDATE album set namaalbum='$namaalbum',deskripsi='$deskripsi' where albumid='$albumid'");
  echo "<script>
  alert('update album berhasil');
  location.href='album.php';
</script>";
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

<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-3 text-center" style="color: rgb(25, 135, 84)" id="font">Selamat Datang <?= $_SESSION['namalengkap'] ?> </h1>
    <hr>
    
    <div class="container">
      <div class="container mt-2 row justify-content-center">
        <div class="col-sm-3">
          <h1 class="mt-2 text-center" style="color: rgb(25, 135, 84)">ALBUM</h1>
          <form action="album_edit.php" method="POST">
            <?php
            while ($data = mysqli_fetch_array($sql)) {
            ?>
              <input type="text" name="albumid" value="<?= $data['albumid'] ?>" hidden>
              <div class="mb-3 mt-3">
                <label for="namaalbum" >Nama Album</label>
                <input type="text" class="form-control" id="namaalbum" name="namaalbum" value="<?= $data['namaalbum'] ?>">
              </div>
              <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="7"> <?= $data['deskripsi'] ?> </textarea>
              </div>
            <?php } ?>
            <button type="submit" class="btn btn-success" name="update">Update</button>
          </form>
        </div>
        <div class="col-sm-8">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Album</th>
                <th>Deskripsi</th>
                <th>Tanggal dibuat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $urut = 1;
              $userid = $_SESSION['userid'];
              $sql = mysqli_query($conn, "select * from album where userid='$userid'");
              while ($data = mysqli_fetch_array($sql)) {
              ?>
                <tr>
                  <td><?= $urut++ ?></td>
                  <td><?= $data['namaalbum'] ?></td>
                  <td><?= $data['deskripsi'] ?></td>
                  <td><?= $data['tanggaldibuat'] ?></td>
                  <td>
                    <a href="album.php?albumid=<?= $data['albumid'] ?>" onclick="return confirm('Yakin menghapus data?')"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                    <a href="album_edit.php?albumid=<?= $data['albumid'] ?>"><button type="button" class="btn btn-outline-success">Edit</button></a>
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

  </div>
</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
    include "layout/footer.html";
    ?>
</body>
</html>