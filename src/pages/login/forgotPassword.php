<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../../../css/pages/login/login.css">
</head>
<body>
  <div class="container">
    <div class="col-50 forms">
      <div class="form-title">
        <h1>
          Forgot Password
        </h1>
        <img class="logo" src="../../../assets/gopa-logo.svg" alt="gopa-logo">
      </div>
      <p>Enter your email to reset your password</p>

      <form class="forms" method="POST">
        <div class="form-input">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Email@mail.com" onfocus="clearError()">
          <p class="error-msg" id="error-msg">Invalid Email</p>
        </div>
      </form> 
      <button type="button" id="sendEmail">Send Email</button>
    </div>
    <div class="col-50">
      <img class="side-img" src="../../../assets/firstAccess.jpg" alt="gopa-img">
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/login/forgotPassword.js"></script>
</body>
</html>