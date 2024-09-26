<?php

include("../utils/validation.php");
include("../utils/util.php");
include("../Database.php");
include("../Models/user.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $inputs = [
    'username' => Validation::clean($_POST['username']),
    'full_name' => Validation::clean($_POST['full_name']),
    'phone_number' => Validation::clean($_POST['phone_number']),
    'address' => Validation::clean($_POST['address']),
    'password' => Validation::clean($_POST['password']),
    'confirm_password' => Validation::clean($_POST['confirm_password']),
  ];

  $data = "fname=" . $inputs['full_name'] . "&uname=" . $inputs['username'] . "&phone=" . $inputs['phone_number'] . "&address=" . $inputs['address'];

  $requiredFields = [
    'username' => 'Username is required',
    'full_name' => 'Full name is required',
    'phone_number' => 'Phone number is required',
    'address' => 'Address is required',
    'password' => 'Password is required',
    'confirm_password' => 'Confirm password is required'
  ];

  foreach ($requiredFields as $field => $errorMessage) {
    if (!Validation::require($inputs[$field])) {
      Util::redirect("../register.php", "error", $errorMessage, $data);
    }
  }

  if ($inputs['password'] !== $inputs['confirm_password']) {
    Util::redirect("../register.php", "error", "Passwords do not match", $data);
  }

  $db = new Database();
  $conn = $db->connect();
  $user = new User($conn);
  if ($user->is_username_unique($inputs['username'])) {
    $passwordHash = password_hash($inputs['password'], PASSWORD_DEFAULT);
    $userData = [
      ':username' => $inputs['username'],
      ':full_name' => $inputs['full_name'],
      ':phone_number' => $inputs['phone_number'],
      ':address' => $inputs['address'],
      ':password' => $passwordHash
    ];
    $res = $user->insert($userData);
    if ($res) {
      Util::redirect("../login.php", "success", "User created successfully");
    } else {
      $em = "An error occurred while creating the user";
      Util::redirect("../register.php", "error", $em, $data);
    }
  } else {
    $em = "The username (" . $inputs['username'] . ") is already taken";
    Util::redirect("../register.php", "error", $em, $data);
  }

} else {
  $em = "An error occurred";
  Util::redirect("../register.php", "error", $em);
}
?>