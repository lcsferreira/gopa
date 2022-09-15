<?php
  include_once "../../../config.php"
?>
<?php
  $title = "Login";                   
  include "header.php";                 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../../../css/pages/login/style.css">
</head>
<body>
  <div class="container">
    <div class="col-50 forms">
      <div class="form-title">
        <h1>
          First Access 
        </h1>
        <img class="logo" src="../../../assets/gopa-logo.svg" alt="gopa-logo">
      </div>
      <p>Create your account password</p>

      <form class="form-input" method="POST">
        <label for="create-password">Create Password</label>
        <input type="password" id="create-password" placeholder="Password">
      </form>
      <div class="form-input">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" placeholder="Password">
      </div>

      <button type="submit">Create</button>
    </div>
    <div class="col-50">
      <img class="side-img" src="../../../assets/firstAccess.jpg" alt="gopa-img">
    </div>
  </div>
</body>
</html>