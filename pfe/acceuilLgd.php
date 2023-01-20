<?php
  require_once 'includes/headerLgdIn.php';
?>
<div id="p1">
  <img ID="cover1" src="imgs/cover.png" height="650px" width="1350px">
  <video disablePictureInPicture controlsList="nodownload" id="vid1" src="imgs/v1.mp4" autoplay loop muted height="300px;" width="600px;">
  </video>
  <div id="seperator"><h2 id="sep">Different selection of exercices</h2>
  <p id="sep2">exercices in different subjects, More than 50 subject to train and jump over your difficulities </p></div>
  <h3 id="part2">Top Categories</h3>
  <div id="card1">
    <a><img id="im1" src="imgs/db.jpg" alt="Databases" title="Databases"><a>

    <a><img id="im2" src="imgs/algos.jpg" alt="Algorithms" title="Algorithms"><a>

    <a><img id="im3" src="imgs/dev.jpg" alt="Web Development" title="Web Development"><a>

    <a><img id="im4" src="imgs/ds.jpg" alt="Data Structures" title="Data Structures"><a>
    <a id="d" onclick="catsearch('Databases')" >Databases</a>
    <a id="al" onclick="catsearch('Algorithms')">Algorithms</a>
    <a id="wd" onclick="catsearch('Web Development')">Web Development</a>
    <a id="sd" onclick="catsearch('Data Structures')">Data Structures</a>
  </div>

    <div id="card2">
      <h2 id="sep3">Featured topics by category</h2>
      <h3 id="t1">Databases</h3>
      <ul id="ul1">
        <li><a onclick="catsearch('sql')">SQL</a></li>
        <ul>
          <li>10.020 students</li>
        </ul>
        <li><a  onclick="catsearch('MySql')">MySql</a></li>
        <ul>
          <li>15.600 students</li>
        </ul>
        <li><a  onclick="catsearch('ajax')">ajax</a></li>
        <ul>
          <li>1.600 students</li>
        </ul>
      </ul>
      <h3 id="t2">Algorithms</h3>
      <ul id="ul2">
        <li><a  onclick="catsearch('breath first search')">BFS</a></li>
        <ul>
          <li>11.000 students</li>
        </ul>
        <li><a  onclick="catsearch('Binary search')">BS</a></li>
        <ul>
          <li>19.000 students</li>
        </ul>
      </ul>
      <h3 id="t3">Web Development</h3>
      <ul id="ul3">
        <li><a  onclick="catsearch('web')">Html/Css</a></li>
        <ul>
          <li>9.000 students</li>
        </ul>
        <li><a  onclick="catsearch('Jquery')" >Jquery</a></li>
        <ul>
          <li>2.000 students</li>
        </ul>
        <li><a  onclick="catsearch('Asp.net')">Asp.net</a></li>
        <ul>
          <li>1.500 students</li>
        </ul>
      </ul>
    </div>
    <div id="card3">
      <h2 id="s3ep">You should create your account</h2>
      <div id="content">
        <img src="imgs/acc.jpg" alt="Create Account" height="270px" width="270px">
        <div id="infos"> Creating Account on EXRSEA can afford you a lot of things as:
          <ul>
            <li>Saving exercices</li>
             all the exercices those who you already did or the futur ones that you will do
            <li>suggest for you more exercices</li>
             exercices related to your learning process <br>
          </ul>
          and many more things...
        </div>
      </div>
    </div>
</div>
<script>
     function catsearch(a){
     document.getElementById("srcharea").value=a;
     document.getElementById("srchBtn").click();
   }
</script>
<?php
require_once 'includes/footer.php';
?>
