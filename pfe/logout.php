<?php
session_start();
unset($_SESSION['sessionId']);
unset($_SESSION['sessionUser']);
unset($_SESSION['sessionemail']);
unset($_SESSION['salt']);
unset($_SESSION['mdp']);
header("location: login.php");
?>