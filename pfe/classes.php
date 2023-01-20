<?php
 class exercice{
    
    function selectEX($str){
        require('includes/DBs.php');
        $sql="SELECT exercices.number,exercices.name,exercices.description from exercices INNER JOIN chapitres on exercices.nbrchapitres=chapitres.number INNER JOIN modules ON chapitres.nbrModule=modules.number where modules.name LIke '%$str%' or chapitres.name Like '%$str%' or exercices.name Like '%$str%'";
        $exe=mysqli_query($conn,$sql)or die("query failed");

        if (mysqli_num_rows($exe)>0)
        { ?>
        <h3 style="font-size: 30px;"><?php echo mysqli_num_rows($exe) ?> results for : <a><?php echo $str?></a></h3>
        <?php
            $count=0;
            while($row = mysqli_fetch_assoc($exe))
            {
                $count++;

        ?>
        <table id="resultsTbl">
            <tr><td style="font-size:24px ;"><a  href="http://localhost:7882/php_projects/pfe/openEx.php?nbr=<?php echo $row['number'] ?>" name="test" ><?php echo $row['name']; ?></a></td></tr>
            <tr><td><p><?php echo $row['description']; ?></p></td></tr>
        </table>
<?php }}else{?> 
   
   <h3 style="font-size: 30px;"> No results for : <a><?php echo $str?></a></h2>
   <p>Check your searching informations to get the exact results you want</p>
    <?php 
    }
    }
    function deleteEx($str){
      require('includes/DBs.php');
      $sql="SELECT exercices.number from exercices  where exercices.name Like '%$str%' LIMIT 1";
      $exe=mysqli_query($conn,$sql)or die("query failed");
      if (mysqli_num_rows($exe)==1)
      {
        $row=mysqli_fetch_assoc($exe);
        $nbr=$row['number'];
        $sql="DELETE from exercices WHERE exercices.number=?";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          //header("Location:?error=sqlerror");
          exit();
        }else {
          mysqli_stmt_bind_param($stmt, "s",$nbr);
          mysqli_stmt_execute($stmt);     
          header("Location:?ex-deleted");
          exit();
        }
      }else{
        echo"<p>no exercice available </p> ";
      }
      
    }

    function selectSavedEX($id){
        require('includes/DBs.php');
        $sql = "SELECT exercices.number,exercices.name,exercices.description,corrections.description1 from exercices inner join corrections on corrections.nbrExercice=exercices.number where exercices.number='$id' and corrections.approved=1 LIMIT 1";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    include 'exPage.phtml';
                }
                mysqli_free_result($result);
            } else{
                echo "No Exercice is matching your request.";
            }
          }
    }

    function selectedEX($nbr){
      require('includes/DBs.php');
        $sql = "SELECT exercices.number,exercices.name,exercices.description,corrections.description1 from exercices inner join corrections on corrections.nbrExercice=exercices.number where exercices.number='$nbr'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
              include 'exPage.phtml';
               break;
          }} else{
            echo "No Exercice is matching your request.";
        }    
      }

      function saveEx($id,$nbr)
      {
        require('includes/DBs.php');
        $sql="SELECT * FROM savedexercices where nbrUser=? and nbrEx=?";
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location:../user.php?error=sqlerror");
                exit();
            }else{
              
                mysqli_stmt_bind_param($stmt,"ss",$id,$nbr);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $rowCount=mysqli_stmt_num_rows($stmt);
            }if ($rowCount>0) {
                echo"saved-already";
                exit();
            }
            else{
                $sql="INSERT INTO savedexercices values(?,?)";
                $stmt=mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)) {
                exit();
              }else {
                mysqli_stmt_bind_param($stmt, "ss", $id,$nbr);
                mysqli_stmt_execute($stmt);  
                echo $id;   
                echo 'done';
                exit();
              }
            }
      }
    function selectAllSavedEx($id){
        require('includes/DBs.php');
        $sql = "SELECT exercices.number,exercices.name,exercices.description from exercices inner join savedExercices on exercices.number=savedExercices.nbrEx inner join users on users.ID=savedExercices.nbrUser where users.ID='$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
    // output data of each row
    ?>
        <table id="tbl"  style="overflow-y:auto;">
        <tr><th>name</th><th>Description</th><th>Actions</th></tr>
        <?php
        while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr><td><?php echo $row['name']?></td><td><p class="pg"><?php echo $row['description']?></p></td><td><button value="<?php echo $row['number']?>" class="viewEX">View</button>|<button value="<?php echo $row['number']?>" class="deleteEX" >Delete</button></td></tr>
        <?php
    }
    ?>
        </table>
    <?php
    } else {
        echo "0 results";
    } 

    }
}


class savedEX{
    function deleteEX($id){
        require('includes/DBs.php');
        $sql="DELETE from savedexercices where nbrEx= ?";
        $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: user.php?error=sqlerror");
        exit();
    }else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);     
        header("Location: user.php?success=Deleted");
    }
    }
}

class user{

    function register($username,$email,$password,$confirmpassword,$salt,$Spassword){
        require('includes/DBs.php');
        if(!preg_match("/^[a-zA-Z0-9]*/",$username)) {
            header("Location:../login.php?error=emptyfields&username=".$username);
            exit();
          }elseif(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$email)){
            header("Location:../login.php?error=emailIncorrect=".$username);
            exit();
          }elseif (strlen($password)<=8 || strlen($password)>50) {
            header("Location:../login.php?error=password-is-not-valid");
            exit();
          }elseif ($password!==$confirmpassword) {
            header("Location:../login.php?error=passwordsdonotmatch&username=".$username);
            exit();
          }else {
            $sql="SELECT userName FROM users where userName=?"; 
            $sql2="SELECT email FROM users where email=?";
            $stmt=mysqli_stmt_init($conn);
            
            $stmt2=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql) ||!mysqli_stmt_prepare($stmt2,$sql2) ) {
              header("Location:../login.php?error=sqlerror");
              exit();
            }else {
              mysqli_stmt_bind_param($stmt,"s",$username);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_store_result($stmt);
              $rowCount=mysqli_stmt_num_rows($stmt);
      
              ///
              mysqli_stmt_bind_param($stmt2,"s",$email);
              mysqli_stmt_execute($stmt2);
              mysqli_stmt_store_result($stmt2);
              $rowCount2=mysqli_stmt_num_rows($stmt2);
      
              if ($rowCount>0) {
                header("Location: ../login.php?error=usernametaken");
                exit();
              }elseif($rowCount2>0){
                header("Location: ../login.php?error=Emailtaken");
                exit();
              }else {
                //$sql="INSERT INTO users(userName,email,Mdp,salt) values(?, ?, ?, ?)
                
                $sql="call insertUsers(?,?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                  header("Location: ../login.php?error=sqlerror");
                  exit();
                }else {
                  mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $Spassword, $salt);
                  mysqli_stmt_execute($stmt);     
                  header("Location: ../login.php?success=registered");
                  exit();
                }

                $stmt=mysqli_stmt_init($Link);
                if (!mysqli_stmt_prepare($stmt, $req)) {
                  header("Location: ../inqsert.php?error=sqlerror");
                  exit();
                }else {
                  mysqli_stmt_bind_param($stmt, "ss", $fullname, $email);
                  mysqli_stmt_execute($stmt);     
                  header("Location: ../insert.php?success=registered");
                  exit();
                }




              }
            }
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
    }
    
    function login($email,$password){
        require('includes/DBs.php');
            $sql="SELECT * FROM users WHERE email= ?";
            $sql2="SELECT salt from users WHERE email=?";
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql) && !mysqli_stmt_prepare($stmt,$sql2)) {
              header("Location:../login.php?error=sqlerror");
              exit();
            }else {
              mysqli_stmt_bind_param($stmt, "s", $email);
              mysqli_stmt_execute($stmt);
              $result=mysqli_stmt_get_result($stmt);
      
              if ($row=mysqli_fetch_assoc($result)) {
                $userSalt=$row["salt"];
                $hpassword=sha1($password.$userSalt);
      
                if ($hpassword!==$row["Mdp"]){
                  header("Location:../login.php?error=wrongpass");
                  exit();
                }elseif($hpassword==$row["Mdp"]) {
                  session_start();
                  $_SESSION['sessionId']=$row['ID'];
                  $_SESSION['sessionUser']=$row['userName'];
                  $_SESSION['sessionemail']=$row['email'];
                  $_SESSION['salt']=$row['salt'];
                  $_SESSION['mdp']=$row['Mdp'];
                  if($_SESSION['sessionemail']=='Admin@admin.admin'){
                    header("location:../admin.php");
                    exit();
                  }  
                  else{
                    header("Location:../acceuilLgd.php?Success=LoggedIn");
                  }
                  exit();
      
                }else {
                  header("Location:../login.php?error=wrongpass");
                  exit();
                }
              }else {
                header("Location:../login.php?error=noUser");
                exit();
              }
            }
        
    }
    function updateUsername($username,$ssname)
    {
        require('includes/DBs.php');
        $sql="SELECT userName FROM users where userName=?";
        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location:../user.php?error=sqlerror");
            exit();
        }else {
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount=mysqli_stmt_num_rows($stmt);
        }if ($rowCount>0) {
            header("Location: ../user.php?error=usernametaken");
            exit();
        }
        else{
            $sql="UPDATE users SET userName = ? WHERE ID = ?";
            $stmt=mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../user.php?error=sqlerror");
            exit();
          }else {
            mysqli_stmt_bind_param($stmt, "ss", $username,$ssid);
            mysqli_stmt_execute($stmt);     
            header("Location: ../user.php?success=Updated1");
            exit();
          }
        } 
    }
    function updateemail($email,$ssemail){
        require('includes/DBs.php');
        if(!empty($email) && $email!= $ssemail && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$email)) 
        {
            $sql="SELECT email FROM users where email=?";
            $stmt=mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location:../user.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $rowCount=mysqli_stmt_num_rows($stmt);
            }if ($rowCount>0) {
                header("Location: ../user.php?error=Emailtaken");
                exit();
            }
            else{
                $sql="UPDATE users SET email = ? WHERE ID = ? ";
                $stmt=mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../user.php?error=sqlerror");
                exit();
              }else {
                mysqli_stmt_bind_param($stmt, "ss", $email,$ssid);
                mysqli_stmt_execute($stmt);     
                header("Location: ../user.php?success=Updated2");
                exit();
              }
            }
        }
        else{
          header("location:../user.php");
          exit();
        }
    }
    function updatepassword($Oldpassword,$Newpassword,$ssmdp,$sssalt)
    {
        require('includes/DBs.php');
        if(!empty($Oldpassword) && sha1($Oldpassword.$sssalt)==$ssmdp)
        {
        if(!empty($Newpassword) && strlen($Newpassword)>=8 && strlen($Newpassword)<50){
            $mdp=sha1($Newpassword.$sssalt);

            $sql="UPDATE users SET mdp = ? WHERE ID = ?";
            $stmt=mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../user.php?error=sqlerror");
            exit();
          }else {
            mysqli_stmt_bind_param($stmt, "ss", $mdp,$ssid);
            mysqli_stmt_execute($stmt);     
            header("Location: ../user.php?success=Updated3");
            exit();
          }
        }else {
            header("Location:../user.php?error=wrongpass");
            exit();
        }
        }else {
        header("Location:../user.php?error=wrongpass");
        exit();
    }
    }

    function deleteAccount($ssname){
      require('includes/DBs.php');
      $sql="DELETE FROM users WHERE userName=?";
      $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../user.php?error=sqlerror");
      exit();
    }else {
      mysqli_stmt_bind_param($stmt, "s",$ssname);
      mysqli_stmt_execute($stmt);     
      header("Location: ../Acceuil.php?Account=Deleted");
      exit();
    }
    }

    function sendSolution($nbrEx,$description,$idUser)
    {
      require('includes/DBs.php');
      $sql="INSERT INTO corrections(nbrExercice,description1,owner) values(?,?,?)";
      $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "<p>error</p>";
      exit();
    }else {
      mysqli_stmt_bind_param($stmt, "sss",$nbrEx,$description,$idUser);
      mysqli_stmt_execute($stmt);     
      echo "<p>Done</p>";
      exit();
    }
    }

    function selectnotif($id){
      require('includes/DBs.php');
      $sql = "SELECT idCorrection,exercices.name from notifications inner join
      corrections on corrections.number1=notifications.idCorrection inner join
      exercices on corrections.nbrExercice=exercices.number where notifications.idUser='$id'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
  // output data of each row
  ?>
      <table id="tbl"  style="overflow-y:auto;">
      <tr><th>notifications</th></tr>
      <?php
      while($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr><td>Your Correction number : <?php echo $row['idCorrection'] ?> for the Ex with the name : <?php echo $row['name'] ?> is been approved by the admin</td></tr>
      <?php
  }
  ?>
      </table>
  <?php
  } else {
      echo "0 results";
  } 

  }
}
class Admin{

  function addModule($name,$cat){
    require('includes/DBs.php');
    $sql="SELECT name FROM modules where name=?";
    $stmt=mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location:?error=sqlerror");
      exit();
    }else {
      mysqli_stmt_bind_param($stmt,"s",$name);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $rowCount=mysqli_stmt_num_rows($stmt);
    if ($rowCount>0) {
    header("Location:?error=module-Already-Available");
    exit();
    }else{
      $sql="INSERT INTO modules(name,categorie) values(?, ?)";
      $stmt=mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:?error=sqlerror");
        exit();
      }else {
        mysqli_stmt_bind_param($stmt, "ss", $name, $cat);
        mysqli_stmt_execute($stmt);     
        header("Location:?success=Module-added");
        exit();
      }
    
      }
    }  
  }

  function addChapitre($name,$nbrMdl)
  {
    require('includes/DBs.php');
    $sql="SELECT name FROM chapitres where name=?";
    $stmt=mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location:?error=sqlerror");
      exit();
    }else {
      mysqli_stmt_bind_param($stmt,"s",$name);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $rowCount=mysqli_stmt_num_rows($stmt);
    if ($rowCount>0) {
    header("Location:?error=chapter-Already-Available");
    exit();
    }else{
      $sql="INSERT INTO chapitres(name,nbrModule) values(?, ?)";
      $stmt=mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:?error=sqlerror");
        exit();
      }else {
        mysqli_stmt_bind_param($stmt, "ss", $name, $nbrMdl);
        mysqli_stmt_execute($stmt);     
        header("Location:?success=chapter-added");
        exit();
      }
    
      }
    }  
  }

  function addExercice($name,$desc,$nbrCh)
  {
    require('includes/DBs.php');
    $sql="SELECT name FROM exercices where name=?";
    $stmt=mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location:?error=sqlerror");
      exit();
    }else {
      mysqli_stmt_bind_param($stmt,"s",$name);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $rowCount=mysqli_stmt_num_rows($stmt);
    if ($rowCount>0) {
    header("Location:?error=Exercice-Already-Available");
    exit();
    }else{
      $sql="INSERT INTO exercices(name,description,nbrChapitres) values(?, ?, ?)";
      $stmt=mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:?error=sqlerror");
        exit();
      }else {
        mysqli_stmt_bind_param($stmt, "sss", $name, $desc,$nbrCh);
        mysqli_stmt_execute($stmt);     
        header("Location:?success=Exercice-added");
        echo"<p>Done</p>";
        exit();
      }
    
      }
    }  
  }
  function addSolution($nbr,$description){
    require('includes/DBs.php');
    $sql="SELECT * FROM corrections where nbrExercice=?";
    $stmt=mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      //header("Location:?error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt,"s",$nbr);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $rowCount=mysqli_stmt_num_rows($stmt);
    if ($rowCount>0) {
    //header("Location:?error=Exercice-has-Already-solution");
    echo "<p>Exercice has already a Solution</p>";
    exit();
    }else{
      $n=1;
      $sql="INSERT INTO corrections(nbrExercice,description1,approved) values(?, ?, ?)";
      $stmt=mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        //header("Location:?error=sqlerror");
        exit();
      }else {
        mysqli_stmt_bind_param($stmt, "sss", $nbr,$description,$n);
        mysqli_stmt_execute($stmt);     
        //header("Location:?success=solution-added");
        echo"<p>Solution Added</p>";
        exit();
      }
    
      }
    }  
  }

  /*function deleteModule($nbr)
  {
    require('includes/DBs.php');
      $sql="DELETE FROM modules WHERE modules.number=?";
      $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      //header("Location:?error=sqlerror");
      exit();
    }else {
      mysqli_stmt_bind_param($stmt, "s",$nbr);
      mysqli_stmt_execute($stmt);     
     // header("Location:admin.php?module-deleted");
      exit();
    }
  }

  function deleteChapter($nbr)
  {
    require('includes/DBs.php');
      $sql="DELETE FROM Chapitres WHERE chapitres.number=?";
      $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      //header("Location:?error=sqlerror");
      exit();
    }else {
      mysqli_stmt_bind_param($stmt, "s",$nbr);
      mysqli_stmt_execute($stmt);     
      //header("Location:?chapter-deleted");
      exit();
    }
  }*/
  function delSolution($nbr)
  {
    require('includes/DBs.php');
      $sql="DELETE FROM corrections WHERE nbrExercice=?";
      $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      //header("Location:?error=sqlerror");
      exit();
    }else {
      mysqli_stmt_bind_param($stmt, "s",$nbr);
      mysqli_stmt_execute($stmt);     
      echo "<p>Done</p>";
      exit();
    }
  }

  function suggestions()
  {
 
    require('includes/DBs.php');
    $sql="SELECT corrections.number1,corrections.owner ,exercices.name,corrections.description1  FROM corrections inner join exercices on corrections.nbrExercice=exercices.number where corrections.approved=0";
    $exe=mysqli_query($conn,$sql)or die("query failed");
    session_start();
        if (mysqli_num_rows($exe)>0)
        { ?>
        <?php
            $count=0;?>
            
            <table>
          <tr>
            <th>Exercice name</th>
            <th>Solution Description</th>
            <th>Id User</th>
            <th>Action</th>
          </tr>
          <?php
            while($row = mysqli_fetch_assoc($exe))
            {
              
                $count++;

        ?>
        
            <tr>
              <td><?php   echo $row['name'] ?></td>
              <td><?php  echo $row['description1'] ?> </td>
              <td><?php echo $row['owner'] ?></td>
              <td><a href="accepteSolutions.php?nbr=<?php echo $row['number1'] ?>"><button>accepte</button></a></td>
            </tr>

<?php } ?></table> <?php }else{?> 
   
   <h3 style="font-size: 30px;"> No Suggestions available </h2>

    <?php 
    }

  }

  function acceptSolution($nbr,$idCorrection)
  {
    require('includes/DBs.php');
    $sql="UPDATE corrections set approved=1 where number1=?";
    
    $stmt=mysqli_stmt_init($conn);

    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      //header("Location:?error=sqlerror");
      exit();
    }else {
      mysqli_stmt_bind_param($stmt, "s",$nbr);
      mysqli_stmt_execute($stmt);  
      $sql2="INSERT INTO notifications(idUser,idCorrection) values(?,?)";
      $stmt2=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt2, $sql2))
      {
        exit();
      }else{
        $s="SELECT corrections.owner from corrections where number1='$nbr'";
      $exe=mysqli_query($conn,$s)or die("query failed");
      if (mysqli_num_rows($exe)>0)
      {
          while($row = mysqli_fetch_assoc($exe)){
            $id=$row['owner'];
          
        }
      }
      
      mysqli_stmt_bind_param($stmt2,"ss",$id,$idCorrection);
      mysqli_stmt_execute($stmt2);   
      }
      
      
      
      echo "<p>Done</p>";
      exit();
    }
  }
  function approvedSuggestions()
  { session_start();
    require('includes/DBs.php');
    $sql="SELECT corrections.number1,corrections.owner ,exercices.name,corrections.description1  FROM corrections inner join exercices on corrections.nbrExercice=exercices.number where corrections.approved=1 and corrections.owner!=21";
    $exe=mysqli_query($conn,$sql)or die("query failed");

        if (mysqli_num_rows($exe)>0)
        { ?>
        <?php
            $count=0;?>
            
            <table id="tbl">
          <tr>
            <th>Exercice name</th>
            <th>Solution Description</th>
            <TH>Id User</TH>
            <th>Action</th>
          </tr>
          <?php
            while($row = mysqli_fetch_assoc($exe))
            {
              
                $count++;

        ?>
        
            <tr>
              <td><?php   echo $row['name'] ?></td>
              <td><?php  echo $row['description1'] ?> </td>
              <td><?php echo $row['owner'] ?></td>
              <td><a href="acceptedSolutions.php?nbr=<?php echo $row['number1'] ?>"><button name="delSln" >Delete</button></a></td>
            </tr>

<?php } ?></table> <?php }else{ ?>
   
   <h3 style="font-size: 30px;"> No Suggestions Are Approved </h2>
<?php
    }
  }

  function deleteApSln($nbr)
  {
    require('includes/DBs.php');
        $sql="DELETE from corrections where number1= ?";
        $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo'<p>error</p>';
        exit();
    }else {
        mysqli_stmt_bind_param($stmt, "s", $nbr);
        mysqli_stmt_execute($stmt);     
        echo '<p>Done</p>';
        exit();
    }
    }
}
?>