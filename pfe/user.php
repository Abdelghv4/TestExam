<?php require_once 'includes/headerLgdIn.php';
include 'classes.php';
$id=intval($_SESSION['sessionId']);
$name=$_SESSION['sessionUser'];
$email=$_SESSION['sessionemail'];
?>
<style>
    table, th, td{
        border:5px solid black;
        border-color: #06bbce;
    }
    .pg{

        overflow: hidden;
        max-width: 100ch;
    }
    #card11{
        background-color: white;
        text-align: center;
    }
    table{
        position: relative;
        left: 60px;
    }

    h3{
        text-align: center;
        font-size: 55px;
    }
    h4{
        position: relative;
        left: 20px;
    }
    input{
        border-radius: 8px;
    }
    button{
        border-radius:  8px;
    }
    input[name=uname]{
        position: relative;
        left: 140px;
    }
    input[name=email]{
        position: relative;
        left: 169px;
    }
    input[name=oldpswrd]{
        position: relative;
        left: 70px;
    }
    input[name=nwpswrd]{
        position: relative;
        left: 105px;
    }
    button[name=submitUp1]{
        position: relative;
        left: 140px;
    }
    button[name=submitUp2]{
        position: relative;
        left: 169px;
    }
    button[name=submitUp3]{
        position: relative;
        left: 105px;
    }
    #card2{
        position: relative;
        left: 60px;
    }
    p{
        text-align: center;
    }
    table button{
        border-color: white;
    }
    #card3{
        text-align: center;
    }
</style>
<h3> Hello <?php echo $name;?></h3><br>
<h4>Your Saved Exercices</h4>
<hr>
<div id="card11">
<?php $test=new exercice();
$test->selectAllSavedEx($id);
?></div>
<br>
<hr>
<h4>your notifications</h4>
<div id="card3">
<?php $test=new user();
$test->selectnotif($id);
?></div>
<br>
<h4>Your Account settings</h4>
<hr>
<div id=card2>
    <h6>Update your info's :</h6>
    <form method="POST" action="includes/updateStg.php">
        Username: <input type="text" name="uname" value="<?php echo $name; ?>"><button name="submitUp1" type="submit">Update</button><br>
        Email : <input type="text" name="email" value="<?php echo $email; ?>"><button name="submitUp2" type="submit">Update</button><br>
        Enter Old Password : <input name="oldpswrd" placeholder="type your current password" type="password"><br>
        New Password : <input name="nwpswrd" placeholder="type your new one" type="password"><button name="submitUp3" type="submit">Update</button>
        <hr> In case you wan't to quit us&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="dlAccount" style="color: white;background:#06bbce;">Delete Account</button>
    </form>
</div>
<br>
<hr>
<p>if you have any problem never hesitate to contact us on our email <a id="contact" href="mailto:EXRSEA@gmail.com?subject=feedback">EXRSEA@GMAIL.COM</a> we are always here to help everyone .</p>

<?php if (isset($_GET['id'])){
    $id=$_GET['id'];
    $test=new savedEX();
    $test->deleteEX($id);
} ?>
<script>
    $(document).ready(function()
        {
            $(".viewEX").click(function()
                {
                    var idEX=$(this).val();
                    window.location.href="http://localhost:7882/php_projects/pfe/openEx.php?id="+idEX;
                })
            $(".deleteEX").click(function()
                {
                    var idEX=$(this).val();
                    window.location.href="http://localhost:7882/php_projects/pfe/user.php?id="+idEX;
                    location.reload();
                })
    
        }
    )
</script>

<?php require_once 'includes/footer.php'; ?>