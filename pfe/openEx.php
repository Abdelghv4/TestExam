<?php require_once 'includes/headerLgdIn.php';
include 'classes.php';

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $test=new exercice();
    $test->selectSavedEX($id);
}

if(isset($_GET['nbr']))
{
    $nbr=$_GET['nbr'];
    $test=new exercice();
    $test->selectedEX($nbr);
}

require_once 'includes/footer.php';
?>



