<?php
  $singin = false;
  session_start();
  session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../../../css/pages/login/login.css">
</head>
<body>
  <div class="container">
    <div class="col-50 forms">
      <div class="form-title">
        <h1>
          Login
        </h1>
        <img class="logo" src="../../../assets/gopa-logo.svg" alt="gopa-logo">
      </div>
      <p>Enter with your credentials to login with your account</p>
      <form class="forms" method="POST">
        <div class="form-input">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Email@mail.com" onfocus="clearError()">
        </div>
        <div class="form-input">
          <label for="password">Password <a href="forgotPassword.php">Forgot Password?</a></label>
          <input type="password" id="password" placeholder="Password" onfocus="clearError()">
          <p class="error-msg" id="error-msg"></p>
        </div>
      </form>
        
      <button type="button" id="login" onclick="clickLogin()">Login</button>
      <footer>
        <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
        ©  2023 GoPA. All rights reserved.
        </p>
      </footer>
    </div>
    <div class="col-50">
      <img class="side-img" src="../../../assets/firstAccess.jpg" alt="gopa-img">
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/login/getLogin.js"></script>
</body>
</html>