
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
      p {
        font-family: "Poppins", sans-serif;
  font-weight: 300;
  font-style: normal;
      }
    </style>
</head>
<body>
    <?php
    include "layout/header.html";
    ?>

    <main class="container">

        <br><br><br><br><br><br> <br> <br>
        <h1 class="text-center" style="color: rgb(25, 135, 84)">HOMEPAGE</h1> <br>
        <p class="text-center" style="color: rgb(25, 135, 84)">selamat datang di web kami, jika ingin mengakses silahkan lakukan <a href="login.php">login</a> atau <a href="register.php"> register</a> terlebih dahulu</p>


        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
    include "layout/footer.html";
    ?>
</body>
</html>