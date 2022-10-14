<?php
  $title = "Admin Creation";                   
  include "../../components/header.php";                 
?> 
<?php
  if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true){
    header("location: ../login/login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Creation</title>
  <link rel="stylesheet" href="../../../css/pages/adminList/adminCreate.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <form class="forms" method="POST" action="">
      <div class="form-title">
        <h1>
          Admin Creation
        </h1>
        <p>
          Fill with the admin informations
        </p>
      </div>
      <div class="form-input">
        <label for="adm-name">Name</label>
        <input type="text" id="adm-name" class="form"placeholder="Name">
        <p class="error-msg" id="name-error">Invalid name</p>
      </div>
      <div class="form-input">
        <label for="adm-email">Email</label>
        <input type="text" id="adm-email" class="form" placeholder="Email">
        <p class="error-msg" id="email-error">Invalid email</p>
      </div>
      <button class="btn-create" type="button" id="saveadmin" disabled="true">Create</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../ajax/adminCreate.js"></script>
  <script src="../../ajax/sidebarMenu.js"></script>
</body>
</html>