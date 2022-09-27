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
    <form class="forms" method="PUT">
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
        <input type="text" id="adm-name" placeholder="Name">
      </div>
      <div class="form-input">
        <label for="adm-email">Email</label>
        <input type="text" id="adm-email" placeholder="Email">
      </div>
      <div class="form-input">
        <label for="is-active">Active: </label>
        <div id="is-active">
          <label for="active">Yes</label>
          <input type="radio" name="is-active" id="active" value="true">
          <label for="inactive">No</label>
          <input type="radio" name="is-active" id="inactive" value="false" checked>
        </div>
      </div>
      <button class="btn-create"type="button" id="saveadmin">Confirm</button>
    </form>
  </div>
  <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="../../ajax/putAdmin.js"></script>
</body>
</html>