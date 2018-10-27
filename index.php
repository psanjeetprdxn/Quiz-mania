<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
    <meta charset="utf-8">
    <title>Quiz Mania</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <h1>Quiz Mania</h1>

    <div class="wrapper">

      <!--
      ****************************************
            LOGIN FORM FOR QUIZ MANIA
      ****************************************
      -->
      <div class="login">
        <h3>Login</h3>
        <form class="" action="includes/login.inc.php" method="post">

          <!--USERNAME [LABEL, INPUT, ERRORS]-->
          <label>Username</label>
          <label for="msg">
            <?php
              if (isset($_GET['loginUsernameError'])) {
                if ($_GET['loginUsernameError'] == 'required') {
                  echo "Username required";
                }
              }
            ?>
          </label>
          <input type="text" name="username" placeholder="Username">

          <!--PASSWORD [LABEL, INPUT, ERRORS]-->
          <label>Password</label>
          <label for="msg">
            <?php
              if (isset($_GET['loginPasswordError'])) {
                if ($_GET['loginPasswordError'] == 'required') {
                  echo "Password required";
                }
              }
            ?>
          </label>
          <input type="password" name="password" placeholder="Password">

          <!--LOGIN BUTTON [INPUT, ERRORS]-->
          <input type="submit" value="Login">
          <label for="msg">
            <?php
            if (isset($_GET['loginResult'])) {
              if ($_GET['loginResult'] == 'wrong') {
                echo "Username or password is incorrect";
              }
            }
            ?>
          </label>
        </form>
      </div>

      <!--
      ****************************************
            SIGN UP FORM FOR QUIZ MANIA
      ****************************************
      -->

      <div class="signup">
        <h3>Sign up</h3>
        <form class="" action="includes/signup.inc.php" method="post">

          <!--NAME [LABEL, INPUT, ERRORS]-->
          <label>Name</label>
          <label for="msg">
            <?php
              if (isset($_GET['signupNameError'])) {
                if ($_GET['signupNameError'] == 'required') {
                  echo "Name required";
                }
              }
            ?>
          </label>
          <input type="text" name="name" placeholder="Name">

          <!--USERNAME [LABEL, INPUT, ERRORS]-->
          <label>Username</label>
          <label for="msg">
            <?php
              if (isset($_GET['signupUsernameError'])) {
                if ($_GET['signupUsernameError'] == 'required') {
                  echo "Username required";
                }
                if ($_GET['signupUsernameError'] == 'exists') {
                  echo "Username already taken";
                }
              }
            ?>
          </label>
          <input type="text" name="username" placeholder="Username">

          <!--EMAIL [LABEL, INPUT, ERRORS]-->
          <label>E-Mail</label>
          <label for="msg">
            <?php
              if (isset($_GET['signupEmailError'])) {
                if ($_GET['signupEmailError']=='required') {
                  echo "E-mail required";
                }
                if ($_GET['signupEmailError']=='exists') {
                  echo "E-mail already taken";
                }
              }
            ?>
          </label>
          <input type="email" name="email" placeholder="E-mail">

          <!--PASSWORD [LABEL, INPUT, ERRORS]-->
          <label>Password</label>
          <label for="msg">
            <?php
              if (isset($_GET['signupPasswordError'])) {
                if ($_GET['signupPasswordError']=='required') {
                  echo "Password required";
                }
              }
            ?>
          </label>
          <input type="password" name="password" placeholder="Password">

          <!--SUBMIT BUTTON [INPUT, ERRORS]-->
          <input type="submit" value="Signup">
          <label for="msg">
            <?php
            if (isset($_GET['signupResult'])) {
              if ($_GET['signupResult'] == 'success') {
                echo '<label style="color:blue;">Signup successfully completed<label>';
              }
              if ($_GET['signupResult'] == 'fail') {
                echo "Something went wrong";
              }
            }
            ?>
          </label>
        </form>
      </div>
    </div>
  </body>
</html>
