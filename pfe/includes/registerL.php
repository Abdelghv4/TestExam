<?php
  include '../classes.php';
  if (isset($_POST['submitL'])) {
    require 'DBs.php';

    $email=$_POST['emailL'];
    $password=$_POST['passwordL'];

    $test=new user();
    $test->login($email,$password);
  }else {
    header("Location:../index.php?error=accessforbidden");
    exit();
  }
 ?>
