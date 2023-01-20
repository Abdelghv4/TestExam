
<?php require_once 'includes/header.php';
include 'classes.php';

$test=new admin();
$test->suggestions();
if(isset($_GET['nbr']) && intval($_GET['nbr'])>0)
{
    $nbr=$_GET['nbr'];
    $test->acceptSolution($nbr,$nbr);
}
    
   
require_once 'includes/footer.php';
?>

