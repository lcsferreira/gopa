<?php
  $title = "Admin Edit";                   
  include "../../components/header.php";                 
?>
<?php
  include_once "../../../config.php";
//select admin values where id = $id
  $id = $_GET['admId'];
  $sql = "SELECT * FROM admin WHERE id = '$id'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
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
  <title>Admin Edit</title>
  <link rel="stylesheet" href="../../../css/pages/list/forms.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <form class="forms" method="POST">
      <div class="form-title">
        <h1>
          Admin Edit
        </h1>
        <p>
          Fill with the admin informations
        </p>
      </div>
      <div class="form-input">
        <label for="adm-name">Name</label>
        <input type="text" class="form" id="adm-name" placeholder="Name" 
        <?php 
          $name = $row['name'];
          //display name in input value
          echo "value='".$name."'";
        ?>
        >
        <p class="error-msg" id="name-error">Invalid name</p>
      </div>
      <div class="form-input">
        <label for="adm-email">Email</label>
        <input type="text" id="adm-email" class="form" placeholder="Email"
        <?php
          $email = $row['email'];
          //display name in input value
          echo "value='".$email."'";?>
        >
        <p class="error-msg" id="email-error">Invalid email</p>
      </div>
      <div class="form-input-rg">
        <label for="is-active">Active: </label>
        <input type="checkbox" name="is-active" id="is-active" 
          <?php
            $is_active = $row['is_active'];
            if($is_active == 1){
              echo "checked";
            }
          ?>
        >
      </div>
      <button class="btn-create"type="button" id="saveadmin">Confirm</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script language="JavaScript" src="../../../scripts/md5.js"></script>
  <script src="../../js/admins/adminEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>