<?php

define('DB_SERVER1', 'localhost');
define('DB_USERNAME1', 'root');
define('DB_PASSWORD1', '');
define('DB_NAME1', 'details');
 
/* Attempt to connect to MySQL database */
$link1 = mysqli_connect(DB_SERVER1, DB_USERNAME1, DB_PASSWORD1, DB_NAME1);
 
// Check connection
if($link1 === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>