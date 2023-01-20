<?php
//parameters to connect to a database
 $dbHost="localhost";
 $dbUser="root";
 $dbPass="";
 $dbName="exrsea";

//connection to database
 $conn=mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

 if (!$conn) {
   die("database connection is failed");
 }
?>
