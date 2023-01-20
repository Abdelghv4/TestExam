<?php
session_start();
$username=$_POST['uname'];
    $Oldpassword=$_POST['oldpswrd'];
    $Newpassword=$_POST['nwpswrd'];

    $ssname=$_SESSION['sessionUser'];
    $ssid=intval($_SESSION['sessionId']);
    $ssemail=$_SESSION['sessionemail'];
    $sssalt=$_SESSION['salt'];
    $ssmdp=$_SESSION['mdp'];
    require 'DBs.php';
    include '../classes.php';

if (isset($_POST['submitUp1'])) {

    if(!empty($username) && $username!= $ssname && preg_match("/^[a-zA-Z0-9]*/",$username))
    {
      $test=new user();
      $test->updateUsername($username,$ssname);
    }
    else{
      header("location:../user.php");
      exit();
    }
  }
  if (isset($_POST['submitUp2'])){
    $email=$_POST['email'];
    $test=new user();
    $test->updateemail($email,$ssemail);
  }
  if (isset($_POST['submitUp3'])){
    $Oldpassword=$_POST['oldpswrd'];
    $Newpassword=$_POST['nwpswrd'];
    $test=new user();
    $test->updatepassword($Oldpassword,$Newpassword,$ssmdp,$sssalt);
  }
  if(isset($_POST['dlAccount'])){
    $test=new user();
    $test->deleteAccount($ssname);
  }
 ?>
 <script>
   $(document).ready(function(){
     location.reload();
   })
 </script>
