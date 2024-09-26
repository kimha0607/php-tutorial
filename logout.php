<?php  

session_start();
include "utils/util.php";

session_unset();
session_destroy();

$em = "logdded out! ";
Util::redirect("login.php", "error", $em);