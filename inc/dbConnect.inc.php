<?php
/*$mysql_db_hostname = "Host name";
$mysql_db_user = "UserName";
$mysql_db_password = "Password";
$mysql_db_database = "Database Name";*/

$mysql_db_hostname = "localhost";
$mysql_db_user = "root";
$mysql_db_password = "root";
$mysql_db_database = "fundsinn_development";

$con = mysqli_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password,$mysql_db_database);// or die("Could not connect database");
//mysql_select_db($mysql_db_database, $con) or die("Could not select database");
?>