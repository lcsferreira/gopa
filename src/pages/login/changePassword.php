<?php
  include_once "../../../config.php"
?>
<?php
  include "../../ajaxQuerys/login/checkFirstAccess.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="../../../css/pages/login/login.css">
</head>
<body>
  <div class="container">
    <div class="col-50 forms">
      <div class="form-title">
        <h1>
          Reset Password
        </h1>
        <img class="logo" src="../../../assets/gopa-logo.svg" alt="gopa-logo">
      </div>
      <p>Reset your account password! It MUST have 8 characters, including a lower and uper case letter, a number and a special character(ex: @, !, #).</p>

      <form class="forms" method="POST">
        <div class="form-input">
          <label for="create-password">New Password</label>
          <input type="password" id="create-password" placeholder="Password">
          <p class="error-msg" id="error-msg-pw1">Password don't match the requirements</p>
        </div>
        <div class="form-input">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" id="confirm-password" placeholder="Password">
          <p class="error-msg" id="error-msg-pw2">Passwords not equal</p>
        </div>
      </form>

      <button type="button" id="post-password">Reset</button>
    </div>
    <div class="col-50">
      <img class="side-img" src="../../../assets/firstAccess.jpg" alt="gopa-img">
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/login/passwordReset.js"></script>
</body>
</html>