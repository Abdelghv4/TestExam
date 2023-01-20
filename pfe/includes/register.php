<?php
  include '../classes.php';
  if (isset($_POST['submit'])) {
    //add database to_get_total_connection
    require 'DBs.php';

    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    $salt = sha1(microtime()) ;
    $Spassword = sha1($password.$salt );

    $test=new user();
    $test->register($username,$email,$password,$confirmpassword,$salt,$Spassword);

    
  }
?>
