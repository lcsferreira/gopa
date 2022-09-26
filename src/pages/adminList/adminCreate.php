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
  <link rel="stylesheet" href="../../../css/pages/adminList/adminCreate.css">
  <link rel="stylesheet" href="../../../css/components/header.css">

</head>
<!--
  SQL query post admin
  default password 
-->
<body>
  <div class="container">
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
        <input type="text" placeholder="Name">
      </div>
      <div class="form-input">
        <label for="adm-email">Email</label>
        <input type="text" placeholder="Email">
      </div>
      <button class="btn-create"type="submit">Create</button>
    </form>
  </div>
</body>
</html>