<?php require_once 'includes/headerLgdIn.php' ; include 'classes.php';?>
<?php

    if (isset($_GET['srchSub'])) {
        //add database to_get_total_connection
        $str=$_GET["srcharea"];
        $test=new exercice();
        $test->selectEX($str);
        }?>

<?php require_once 'includes/footer.php'; ?>