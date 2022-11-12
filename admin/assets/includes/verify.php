<?php
if(!isset($_POST["email"]) || !isset($_POST["password"])){ exit("No");}

require "config.php";
require "userlib.php";
$USER = new User();


$user = $USER->verify($_POST["email"], $_POST["password"]);

if ($user ===false) {exit("No");}

require "vendor/autoload.php";
use Firebase\JWT\JWT;
$now = strtotime("now");
echo JWT::encode([
  "iat" => $now, 
  "nbf" => $now, 
  "exp" => $now + 3600, 
  "jti" => base64_encode(random_bytes(16)), 
  "aud" => JWT_AUD, 
  
  "data" => [
    "id" => $user["id"],
    "name" => $user["name"],
    "email" => $user["email"]
  ]
], JWT_SECRET, JWT_ALGO);


?>