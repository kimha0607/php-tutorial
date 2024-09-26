<?php
session_start();

include("../utils/validation.php");
include("../utils/util.php");
include("../Database.php");
include("../Models/user.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $inputs = [
    'username' => Validation::clean($_POST['username']),
    'password' => Validation::clean($_POST['password']),
  ];

  "&uname=" . $inputs['username'];

  $requiredFields = [
    'username' => 'Username is required',
    'password' => 'Password is required'
  ];

  foreach ($requiredFields as $field => $errorMessage) {
    if (!Validation::require($inputs[$field])) {
      Util::redirect("../login.php", "error", $errorMessage, $data);
    }
  }

  $db = new Database();
  $conn = $db->connect();
  $user = new User($conn);
  $auth = $user->auth($inputs['username'], $inputs['password']);
  if ($auth) {


    $user_data = $user->getUser();
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['user_id'] = $user_data['user_id'];
    print_r($_SESSION);
    $sm = "logged in!";
    Util::redirect("../index.php", "success", $sm);
  } else {
    $em = "Incorrect username or password";
    Util::redirect("../index.php", "error", $em);
  }

} else {
  $em = "An error occurred";
  Util::redirect("../index.php", "error", $em);
}
?>