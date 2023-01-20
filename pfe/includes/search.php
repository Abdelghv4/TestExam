<?php
require 'includes/DBs.php';
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "
SELECT exercices.number,exercices.name,exercices.description from exercices INNER JOIN chapitres on exercices.nbrchapitres=chapitres.number INNER JOIN modules ON chapitres.nbrModule=modules.number where modules.name LIke '%".$request."%' or chapitres.name Like '%".$request."%' or exercices.name Like '%".$request."% ";

$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["name"];
 }
 echo json_encode($data);
}
?>