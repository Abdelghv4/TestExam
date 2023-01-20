<?php require_once 'includes/header.php';
include 'classes.php'; 

$test=new admin();
$test->approvedSuggestions();


    
    if(isset($_GET['nbr']) && intval($_GET['nbr'])>0)
    {$nbr=$_GET['nbr'];
        $test2=new admin();
        $test2->deleteApSln($nbr);
    }

?>

<?php 
require_once 'includes/footer.php';
?>