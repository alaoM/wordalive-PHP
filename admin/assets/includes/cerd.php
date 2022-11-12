<?php
$host = '127.0.0.1';
$port = 3306;
$db   = 'wordalive';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';



define("DB_HOST", "localhost");
define("DB_PORT", 3306);
define("DB_NAME", "wordalive");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (B) JWT STUFF
define("JWT_SECRET", "gHfKxh%zjqC7ZMKAcY@B(fC(aC0Opv9Q");
define("JWT_ISSUER", "YOUR-NAME");
define("JWT_AUD", "site.com");
define("JWT_ALGO", "HS512");