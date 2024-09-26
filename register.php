<?php
include("utils/validation.php");

$fname = $uname = $phone_number = $address = '';

if (isset($_GET['fname'])) {
  $fname = $_GET['fname'];
}

if (isset($_GET['uname'])) {
  $uname = $_GET['uname'];
}
if (isset($_GET['phone'])) {
  $phone_number = $_GET['phone'];
}
if (isset($_GET['address'])) {
  $address = $_GET['address'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Register</title>
</head>
<body>
  <div class="container">
    <div class="content">
      <h1>Register</h1>

      <?php 
        if (isset($_GET['error'])) {
          ?>
            <div class="errorRegister" style="color: red;"> <?=Validation::clean($_GET['error'])?> </div>
          <?php
        }
      ?>
      <form action="actions/register.php" method="post">
      <div class="field input">
        <label>Username</label>
        <input type="text" name="username" id="username" value="<?= $uname ?>"/>
      </div>
      <div class="field input">
        <label>full name</label>
        <input type="text" name="full_name" id="full_name" value="<?= $fname ?>"/>
      </div>
      <div class="field input">
        <label>Phone number</label>
        <input type="text" name="phone_number" id="phone_number" value="<?= $phone_number ?>"/>
      </div>
      <div class="field input">
        <label>Address</label>
        <input type="text" name="address" id="address" value="<?= $address ?>"/>
      </div>
      <div class="field input">
        <label>Password</label>
        <input name="password" type="password" id="password"/>
      </div>
      <div class="field input">
        <label>Confirm Password</label>
        <input name="confirm_password" type="password" id="confirm_password"/>
      </div>
      <button type="submit" class="btn btn-submit">Register</button>
      </form>
      <div class="link-register">
        <p >Already have an account? <a href="login.php" class="link">Login</a></p>
      </div>
    </div>
  </div>
</body>
</html>