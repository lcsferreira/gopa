<?php
  $title = "Admin List";                   
  include "../../components/header.php";                 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Creation</title>
  <link rel="stylesheet" href="../../../css/pages/adminList/adminEdit.css">
  <link rel="stylesheet" href="../../../css/components/header.css">

</head>

<body>
  <div class="container">
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
          $name = $_GET['admName'];
          //display name in input value
          echo "value='".$name."'";
        ?>
        >
      </div>
      <div class="form-input">
        <label for="adm-email">Email</label>
        <input type="text" id="adm-email" class="form" placeholder="Email"
        <?php
          $email = $_GET['admEmail'];
          //display name in input value
          echo "value='".$email."'";?>
        >
      </div>
      <div class="form-input-rg">
        <label for="is-active">Active: </label>
        <input type="checkbox" name="is-active" id="is-active">
      </div>
      <button class="btn-create"type="button" id="saveadmin">Confirm</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script language="JavaScript" src="../../../scripts/md5.js"></script>
  <script src="../../ajax/adminEdit.js"></script>
</body>
</html>