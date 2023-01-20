<?php
  session_start();
  require_once 'includes/DBs.php';
  if($_SESSION['sessionId'] || $_SESSION['sessionUser'] || $_SESSION['sessionemail'] || $_SESSION['salt'] || $_SESSION['mdp'])
  { 


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <header>
     
      <div id="head">
        <a href="acceuilLgd.php" id="lg"><img src="imgs/logoImg.png" alt="EXRSEA LOGO" height="80px;"width="80px;"></img></a>
        <div class="dropdown">
        <a id="cat" style="top: 5px;">Categories</a>
        <div class="dropdown-content">
          <ul>
            <li><a onclick="catsearch('web')">Web</a></li>
            <li><a onclick="catsearch('Algorithms')">Algorithms</a></li>
            <li><a onclick="catsearch('Data structures')">Data structures</a></li>
            <li><a onclick="catsearch('Databases')">Databases</a><li>
            <li><a onclick="catsearch('Programming languages')">Programming languages</a></li>
          </ul>
        </div>
        </div>
        <form action="results.php" method="GET">
        <input type="text" name="srcharea" id="srcharea" placeholder="Search for Exercises">
        <button type="submit" name="srchSub" id="srchBtn">&#x1F50E;</button> 
        </form>
        <div class="dropdown2">
          <button class="btns" id="user" type="button"><i class="fa fa-user"></i></button>
            <div class="dropdown-content2">
              <ul>
              <li><a href="user.php">Hi </a><span id="smito"></span></li>
              <li><a href="user.php">Account</a></li>
              <li><a href="logout.php">Log Out</a></li>
              </ul>
            </div>  
        </div>
      <!--<button class="btns" id="stch" type="button"><i class="fa fa-adjust"></i></button>-->
   </header>
   <br>
   <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
   <script type="text/javascript">
     const options = {
    bottom: '64px', // default: '32px'
    right: '32px', // default: '32px'
    left: 'unset', // default: 'unset'
    time: '0.2s', // default: '0.3s'
    mixColor: '#fff', // default: '#fff'
    backgroundColor: '#fff',  // default: '#fff'
    buttonColorDark: '#100f2c',  // default: '#100f2c'
    buttonColorLight: '#fff', // default: '#fff'
    saveInCookies: true, // default: true,
    label: '🌓', // default: ''
    autoMatchOsTheme: true // default: true
  } 

    const darkmode = new Darkmode(options);
    darkmode.showWidget();
   function catsearch(a){
     document.getElementById("srcharea").value=a;
     document.getElementById("srchBtn").click();
   }
   function sessionstop(){
     <?php //session_unset();?>
   }


   $('#srcharea').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"includes/search.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
});
   </script>
<?php }else {
  header("location:acceuil.php");
}?>
