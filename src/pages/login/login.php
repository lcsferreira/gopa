
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
          Login
        </h1>
        <img class="logo" src="../../../assets/gopa-logo.svg" alt="gopa-logo">
      </div>
      <p>Enter with your credentials to login with your acconut</p>

      <form class="form-input" method="POST">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Email@mail.com">
      </form>
      <div class="form-input">
        <label for="password">Password <a href="forgotPassword.php">Forgot Password?</a></label>
        <input type="password" id="password" placeholder="Password">
      </div>

      <button type="submit">Login</button>
    </div>
    <div class="col-50">
      <img class="side-img" src="../../../assets/firstAccess.jpg" alt="gopa-img">
    </div>
  </div>
</body>
</html>