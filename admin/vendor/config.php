<?php
// KEEP CONFIG FILE IN A SECURE FOLDER!
// CHANGE ALL SETTINGS TO YOUR OWN!
// (A) DATABASE SETTINGS
define("DB_HOST", "localhost");
define("DB_NAME", "wordalive");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");
 
// (B) JWT STUFFccc
define("JWT_SECRET", "gHfKxh%zjqC7ZMKAcY@B(fC(aC0Opv9Qdffgffffhrdfgrese@%^#^^");
define("JWT_ISSUER", "YOUR-NAME");
define("JWT_AUD", "mysite.com");
define("JWT_ALGO", "HS512");