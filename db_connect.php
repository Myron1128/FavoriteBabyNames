<?php
// Do not change the following two lines.
$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

// You will need to require this file on EVERY php file that uses the database.
// Be sure to use $db->close(); at the end of each php file that includes this!

$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'mzambrano2016';   // Needs to be changed to your designated table database name
$dbuser = 'mzambrano2016';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = 'nhmCC5cT+c'; // Needs to be changed to reflect your LAMP server credentials

//for XAMPP development
// $dbhost = 'localhost';  // Most likely will not need to be changed
// $dbname = 'mzambrano2016';   // Needs to be changed to your designated table database name
// $dbuser = 'root';   // Needs to be changed to reflect your LAMP server credentials
// $dbpass = ''; // Needs to be changed to reflect your LAMP server credentials

$db_link = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db_link->connect_errno > 0) {
    die('Unable to connect to database [' . $db_link->connect_error . ']');
}

