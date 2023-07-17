<?php 
// Path: config_db.php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "db_vsga");

$db_connect =  mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$db_connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>