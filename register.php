<?php
    include "connection.php";

    if (isset($_POST['register'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $namalengkap=$_POST['namalengkap'];
    $alamat=$_POST['alamat'];

    $sql=mysqli_query($conn,"insert into user values('','$username','$password','$email','$namalengkap','$alamat')");

    echo "<script>
  alert('akun anda berhasil terdaftar');
  location.href='login.php';
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
    include "layout/header.html";
    ?>

    <main class="container mt-5">
<div class="container row justify-content-center">
  <div class="col-7">
  <h1 class= "text-center mb-3" style="color: rgb(25, 135, 84)">REGISTER</h1> <br> <br>
    <form class="row g-3" action="register.php" method="POST">
          <div class="form-floating my-2">
    <input type="email" class="form-control border-success" id="email" name="email" placeholder="name@example.com">
    <label for="email">Email Address</label>
  </div>
  <div class="form-floating my-2">
    <input type="text" class="form-control border-success" id="username" name="username" placeholder="name@example.com">
    <label for="username">Username</label>
  </div>
  <div class="form-floating my-2">
    <input type="password" class="form-control border-success" id="password" name="password" placeholder="name@example.com">
    <label for="password">Password</label>
  </div>
  <div class="form-floating my-2">
    <input type="text" class="form-control border-success" id="namalengkap" name="namalengkap" placeholder="Password">
    <label for="namalengkap">Nama Lengkap</label>
  </div>
  <div class="form-floating my-2">
    <input type="text" class="form-control border-success" id="alamat" name="alamat" placeholder="name@example.com">
    <label for="alamat">Alamat</label>
  </div>
  </div>
    <div class="col-12 text-center mt-2">
      <button type="submit" class="btn btn-success" name="register">Sign Up</button>
    </div>
</form>
  </div>
</div>

        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
    include "layout/footer.html";
    ?>
</body>
</html>