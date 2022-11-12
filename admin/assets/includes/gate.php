<?php
// (A) JWT COOKIE NOT SET!
if (!isset($_COOKIE["jwt"])) { header("Location: sign-in.php"); exit(); }
 
// (B) VERIFY JWT
require "libs.php";
$user = $database->validate($_COOKIE["jwt"]); 

if ($user===false || isset($_POST["logout"]) || $user['role'] != 90) {
  setcookie("jwt", null, -1);
  header("Location: sign-in.php");
  exit();
}