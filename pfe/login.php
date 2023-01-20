<?php
require_once 'includes/header.php';
?>
  <style>
  body {
  height: 100vh;
  width: 100vw;
  background-size: cover;
  font-family: sans-serif;
}

.container {
  width: 600px;
  height: 420px;
  position: relative;
  perspective: 800px;
	margin: 3rem auto;
}

#options {
	margin: 0px auto;
  margin-top: -20px;
	width: 200px;
	text-align: center;
}

#card {
  width: 100%;
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition: transform 1s;
}

#card figure {
  margin: 0;
  position: absolute;
  border-radius: 8px;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: space-between;
  width: 100%;
  height: 105%;
  box-shadow: 0px 1px 3px rgba(0,0,0,.3);
  backface-visibility: hidden;
  bottom: -10px;
}

.logo {
  position: absolute;
  top: 1rem;
  left: 1rem;
  height: 30px;
  width: 30px;
}

.back-logo {
  position: absolute;
  top: 1rem;
  right: 1.5rem;
  height: 30px;
  width: 30px;
}

.logo img, .back-logo img {
  height: 40px;
}

#card .front {
  background: white;
}
#card .back {
  background: white;
  transform: rotateY( 180deg );
}

#card.flipped {
  transform: rotateY( 180deg );
}

@keyframes powerFlip {
  from {
    box-shadow: 5px 10px 5px rgba(0,0,0,0);
  }

  50% {
    transform: translateY(-10px);
    box-shadow: 0px 4px 20px 20px rgba(142, 68, 173,0.1);
  }
}

@keyframes powerFlipTwo {
  from {
    box-shadow: 5px 10px 5px rgba(0,0,0,0);
  }

  50% {
    transform: translateY(-10px);
    box-shadow: 0px 4px 20px 20px rgba(142, 68, 173,0.1);
  }
}


#flip {
  animation-name: powerFlipTwo;
  animation-timing-function: easeIn;
  animation-duration: .5s;
  animation-fill-mode: both;
  animation-iteration: 1;
  height: 30px;
  width: 200px;
  background: #9b59b6;
  border: none;
  font-size: 1rem;
  color: white;
  transition: all 150ms;
  cursor: pointer;
}

#flip:hover {
  background: #8e44ad;
}

#flip.powered {
  animation-name: powerFlip;
  animation-timing-function: easeIn;
  animation-duration: .35s;
  animation-fill-mode: both;
  animation-iteration: 1;
}

.form {
  display: flex;
  flex-direction: column;
}

.form input {
  margin-bottom: 1rem;
}

.front .form-side {
  padding-top: 50px;
  padding-left: 1rem;
  width: 40%;
  height: 100%;
}

.back .form-side {
  padding-top: 50px;
  padding-right: 1rem;
  width: 40%;
  height: 100%;
}


.front .photo-side {
  width: 50%;
  height: 100%;
  background: url('https://image.freepik.com/free-vector/startup-background-with-rocket_1302-791.jpg');
  background-size: cover;
  background-position: right;
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
}

.back .photo-side {
  width: 50%;
  height: 100%;
  background: url('https://image.freepik.com/free-vector/startup-background-with-rocket-laptop_1302-813.jpg');
  background-size: cover;
  background-position: left;
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;

}

label {
  font-size: 90%;
  margin-bottom: 5px;
}

.form input {
  height: 20px;
  padding-left: 3px;
}

.lgn-btn {
  background: #06bbce;
  color: white;
  border: none;
  height: 30px;
  cursor: pointer;
}

.terms a {
  color: #06bbce;
  text-decoration: none;
}

.github {
  position: absolute;
  top: 10px;
  left: 10px;
  background: rgba(155, 89, 182,1.0);
  padding: 9px 20px 9px 20px;
  color: white;
  text-decoration: none;
  font-family: sans-serif;
  border-radius: 20px;
  cursor: pointer;
  z-index: -1;
  font-size: 10px;
}
  </style>
  <section class="container">
    <div id="card">
      <p name="wewe"></p>
      <figure class="front">
        <div class="logo"><img src="imgs/logoImg.png" />
        </div>
        <div class="form-side">
          <h1>Sign up</h1>
        <form action="includes/register.php" method="post">
          <div class="form">
            <label>Username</label>
            <input name="username"  placeholder="username" required>
            <label>Email</label>
            <input name="email"  placeholder="Email" required>
            <label>Password</label>
            <input name="password" type="password" placeholder="password" required>
            <label>Confirm Password</label>
            <input name="confirmpassword" type="password" placeholder="confirm password" required>
            <input name="submit" type="submit" class="lgn-btn" value="SIGN UP">
            <p class="terms">By signing up you agree to our <a href="#">terms</a> and <a href="#">conditions</a></p>
          </div>
        </form>
        </div>
        <div class="photo-side">

        </div>

      </figure>

      <figure class="back">
        <div class="back-logo"><img src="imgs/logoImg.png" /></div>
        <div class="photo-side">

        </div>

        <div class="form-side">
          <h1>Login</h1>
           <div class="form">
          <form action="includes/registerL.php" method="post">
            <label>Email</label><br>
            <input id="un" name="emailL" placeholder="Email" required><br>
            <label>Password</label><br>
            <input name="passwordL" type="password" placeholder="password" required><br>
            <button name="submitL" type="submit" class="lgn-btn" required>Login</button>
          </form>
             <p class="terms">By logging in you agree to our <a href="#">terms</a> and <a href="#">conditions</a></p>
          </div>
        </div>

      </figure>
    </div>
  </section>
  <section id="options">
      <p id="message">Already have an account?
      <p><button id="flip" class="powered">Login</button</p>
  </section>
  <script src="jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
  $('#flip').on('click', function(e)
{
	e.preventDefault();


	$('#card').toggleClass('flipped');

  $('#flip').toggleClass('powered');

  if ($('#card').hasClass('flipped')) {
    $('#message').text("Need to sign up?");
    $('#flip').text("Create an account");
  } else {
    $('#message').text("Already have an account?");
    $('#flip').text("Log in");
  }
  let uN=$("#un").html;

});
  </script>
  <script src="includes/js.js" charset="utf-8"></script>
<?php
require_once 'includes/footer.php';
?>
