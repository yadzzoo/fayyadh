<?php
include "connection.php";
session_start();

if (isset($_POST['login'])) {
  $username=$_POST['username'];
  $password=$_POST['password'];
  

  $sql=mysqli_query($conn,"SELECT * from user where username='$username' and password='$password'");

  $cek=mysqli_num_rows($sql);

  if($cek==1){
      while($data=mysqli_fetch_array($sql)){
          $_SESSION['userid']=$data['userid'];
          $_SESSION['namalengkap']=$data['namalengkap'];
          $_SESSION['login'] = true;
          $nama = $data['namalengkap'];

      }
      echo "<script>
      alert ('hai $nama, anda telah berhasil login');
      location.href='admin.php';
    </script> ";
  }else{
      echo "<script>
      alert ('maaf, periksa kembali password dan username anda');
      location.href='login.php';
    </script> ";
  }
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

    <main class= "container mt-sm-5">
    <h1 class= "text-center mb-3" style="color: rgb(25, 135, 84)">LOGIN</h1> <br> <br>
        <div class="container row justify-content-center">
          <div class="col-7 ">
          <form class="row g-3" action="login.php" method="POST">
        <div class="form-floating my-3">
  <input type="text" class="form-control border-success"  id="username" name="username" placeholder="name@example.com">
  <label for="username">Username</label>
</div>
<div class="form-floating my-3">
  <input type="password" class="form-control border-success" id="password" name="password" placeholder="Password">
  <label for="password">Password</label>
</div>
  </div>
  <div class=" text-center mt-3">
    <button type="submit" class="btn btn-success" name="login">Login</button> 
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