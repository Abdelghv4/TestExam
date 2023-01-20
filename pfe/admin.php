<?php require_once 'includes/header.php';include 'classes.php'; ?>
<style>

    h4,H3,H5{
        text-align: center;
    }
    #f1,#f2,#f4{
        position: absolute;
        left: 500px;
    }
    #f3{
        position: absolute;
        left: 350px;
    }
    #f5,#f6{
        position: absolute;
        left: 600px;
    }
    .sug{
        position: relative;
        left: 620px;
    }
    hr{
        color: #06bbce;
    }
    h4{
        color: #06bbce;
    }
    button{
        background-color: #06bbce;
        color: white;
    }

    
</style>
<h3 style="font-size: 30px;">Hello AV4</h3>
<h5>welcome to your lab</h5>

<H4>Add Module</H4>
<hr>
<form method="POST" id="f1">
    Name : <input type="text" name="nameMdl" id="Mdlname">
    Category : <input type="text" name="catMdl" id="Mdlcat">
    <button type="submit" name="addM">Add</button>
    <?php 
    if(isset($_POST['addM']))
    {
        $a=$_POST['nameMdl'];
        $b=$_POST['catMdl'];
        $test=new Admin();
        $test->addModule($a,$b);
    }
    ?>
</form>
<br><br>
<H4>Add Chapter</H4>
<hr>
<form method="POST" id="f2">
Modules : 
<select class="options" name="modules">
    <option selected >choose a module</option>
  <?php 
  $sql="SELECT * From modules";
  $results=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($results))
  {
      echo '<option  value='.$row['number'].'>'.$row['name'].'</option>';
  }
  ?>
</select>
name : <input type="text" name="namech">
<button type="submit" name="addCh" >Add</button>
</form>
<?php 
 if(isset($_POST['addCh']))
 {
     $a=$_POST['namech'];
     $b=$_GET['nbr'];
     $test=new Admin();
     $test->addChapitre($a,$b);
 }
?>
<br><br>
<h4>Add Exercice</h4>
<hr>
<form method="POST" id="f3">
Chapters : 
<select class="options" name="chapters">
    <option selected >choose a chapter</option>
  <?php 
  $sql="SELECT * From chapitres";
  $results=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($results))
  {
      echo '<option  value='.$row['number'].'>'.$row['name'].'</option>';
  }
  ?>
</select>
Name : <input type="text" name="nameEx">
description : <textarea name="txtdescription" cols="30" rows="1"></textarea>
<button type="submit" name="addEx">Add</button>
</form>
<?php 
    if(isset($_POST['addEx']))
    {
        $a=$_POST['nameEx'];
        $b=$_POST['txtdescription'];
        $c=$_GET['nbr'];
        $test=new Admin();
        $test->addExercice($a,$b,$c);
    }
?>
<br><br>
<h4>Add Solution</h4>
<hr>
<form method="POST" id="f4">
    Exercices : <select class="options" name="exercices">
    <option selected >choose an exercice</option>
  <?php 
  $sql="SELECT * From exercices";
  $results=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($results))
  {
      echo '<option  value='.$row['number'].'>'.$row['name'].'</option>';
  }
  ?>
  </select>
  description : <textarea name="cordescription" cols="30" rows="1"></textarea>
  <button type="submit" name="subCorrection">Submit</button>
</form>
<?php  
    if(isset($_POST['subCorrection']))
    {
        $b=$_POST['cordescription'];
        $c=$_GET['nbr'];
        $test=new Admin();
        $test->addSolution($c,$b);
    }
?>

<!--  <h4>Delete Module</h4>
<hr>
<form method="POST">
Modules : 
<select class="options" name="modules">
    <option selected >choose a module</option>  -->
<?php
  /* $sql="SELECT * From modules";
  $results=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($results))
  {
      echo '<option value='.$row['number'].'>'.$row['name'].'</option>';
  }
  ?>
</select>
<br>
<button type="submit" name="delModule">delete</button></form>
<?php
if(isset($_POST['delModule']))
 {
    $a=$_GET['nbr'];
    $test=new Admin();
    $test->deleteModule($a);
 }
?>
<br>
<H4>Delete Chapters</H4>
<hr>
Chapters : 
<form method="POST">
<select class="options" name="chapters">
    <option selected >choose a chapter</option>
  <?php 
  $sql="SELECT * From chapitres";
  $results=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($results))
  {
      echo '<option  value='.$row['number'].'>'.$row['name'].'</option>';
  }
  ?>
</select><br>
<button type="submit" name="dlChapter">Delete</button></form>
<?php
if(isset($_POST['delChapter']))
 {
    $a=$_GET['nbr'];
    $test=new Admin();
    $test->deleteChapter($a);
 }
*/?>
<br><br>
<h4>Delete Exercice</h4>
<hr>

<form method="GET" id="f5">
Exercice : <input placeholder="Exercice name" type="text" name="ex">
 <button type="submit" name="delEx">Delete</button>
</form>
<?php if (isset($_GET['delEx'])) {
        //add database to_get_total_connection
        $str=$_GET["ex"];
        $test=new exercice();
        $test->deleteEX($str);
}?>
<br><br>
<h4>Delete Solution</h4>
<hr>

<form method="POST" id="f6">
Exercices : <select class="options" name="exercices">
    <option selected >choose an exercice</option>
  <?php 
  $sql="SELECT * From exercices";
  $results=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($results))
  {
    echo '<option  value='.$row['number'].'>'.$row['name'].'</option>';
  }
  ?>
  </select>
  <button type="submit" name="delSolution">Delete</button>
</form>
<?php 
if (isset($_POST['delSolution'])) {
        //add database to_get_total_connection
        $nbr=$_GET["nbr"];
        $test=new Admin();
        $test->delSolution($nbr);
}?>

<br><br>
<H4>Suggestions</H4>
<hr>
<a class="sug" href="accepteSolutions.php"><button>Waiting suggestions</button></a>

<a class="sug" href="acceptedSolutions.php"><button>Approved suggestions</button></a><br><br>

<script type="text/javascript">
    $(document).ready(function(){

        $(".options").on('change',function()
            {
                    var nbr=$(this).val(); 
                    window.location.href="http://localhost:7882/php_projects/pfe/admin.php?nbr="+nbr; 
            });
    })
</script>
<?php require_once 'includes/footer.php'; ?>