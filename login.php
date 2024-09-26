<?php
session_start();
include("utils/validation.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Login</title>
</head>

<body>
  <div class="container">
    <div class="content">
      <h1>Login</h1>

      <?php
      if (isset($_GET['error'])) {
        ?>
        <div class="errorRegister" style="color: red;"> <?= Validation::clean($_GET['error']) ?> </div>
        <?php
      }
      ?>
      <form action="actions/login.php" method="post">
        <div class="field input">
          <label>Username</label>
          <input type="text" name="username" id="username" />
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" id="password" />
        </div>
        <button type="submit" class="btn btn-submit">Login</button>
      </form>
      <div class="link-register">
        <p>Don't have an account? <a class="link" href="register.php">Register</a></p>
      </div>
    </div>
  </div>
</body>

</html>