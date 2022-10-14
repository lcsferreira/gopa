<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>First Access</title>
  <link rel="stylesheet" href="../../../css/pages/login/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <p>Your password has been saved. We'll redirect you to sign in area.</p>
      <div style="margin-top: 20px; color: #03a9f4">
        <i class="fa fa-check-circle fa-4x"></i>
      </div>
    </div>
    <div class="col-50">
      <img class="side-img" src="../../../assets/firstAccess.jpg" alt="gopa-img">
    </div>
  </div>
  <script>
    setTimeout(function() {
      window.location.href = "../login/login.php";
    }, 3000);
  </script>
</body>
</html>