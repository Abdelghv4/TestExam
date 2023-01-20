<?php
  require_once 'DBs.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EXRSEA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500;700&family=Merriweather&family=Roboto+Mono:wght@300&family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style1.css">
    <link rel="stylesheet" href="styles/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <header>
      <div id="head">
        <a href="acceuil.php"><img src="imgs/logoImg.png" alt="EXRSEA LOGO" height="80px;"width="80px;"></img></a>
        <div class="dropdown">
        <a id="cat">Categories</a>
        <div class="dropdown-content">
          <ul>
            <li><a href="login.php">Web</a></li>
            <li><a href="login.php">Algorithms</a></li>
            <li><a href="login.php">Data structures</a></li>
            <li><a href="login.php">Databases</a><li>
            <li><a href="login.php">Programming languages</a></li>
          </ul>
        </div>
        </div>
        <form method="GET">
        <input type="text" name="srcharea" id="srcharea" placeholder="Search for Exercises">
        <button type="submit" name="srchsubmit" id="srchBtn">&#x1F50E;</button> 
        </form>
        <button class="btns" id="log" type="button" onclick="window.location.href='login.php'">LOGIN</button>
        <button class="btns" id="sign" type="button" onclick="window.location.href='login.php'">SIGN UP</button>
        <!--<button  class="btns" id="switch" type="button"><i class="fa fa-adjust"></i></button>-->
      </div>
   </header>
   <script type="text/javascript">
   </script>
<?php

if (isset($_GET['srchsubmit'])) {
    //add database to_get_total_connection
    require 'DBs.php';

    header("Location:../pfe/login.php?notice=create_your_account_to_access_everything");
}

?>