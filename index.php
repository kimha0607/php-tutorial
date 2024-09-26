<?php
session_start();
include "utils/util.php";
include "Controller/User.php";

if (
  isset($_SESSION['username']) &&
  isset($_SESSION['user_id'])
) {

  $user->User($_SESSION['user_id']);
  $user_data = $user->getUser();
  print_r($user_data);
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/style.css">
  </head>

  <body>
    <div class="wrapper">
      <div class="form-holder">
        <h2>Welcome!</h2>
        <form class="form" action="logout.php" method="GET">
          <h4>Username: <?= $user_data['username'] ?> !</h4>
          <div class="form-group">
            <button type="submit">Logout</button>
          </div>
        </form>
      </div>
    </div>
  </body>

  </html>

<?php } else {
  $em = "First login ";
  // Util::redirect("login.php", "error", $em);
} ?>