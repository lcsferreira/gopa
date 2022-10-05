<?php 
  include_once "../../config.php";
?>
<?php
  $id = $_POST['id'];
  //update admin password where id = $id
  $sql = "UPDATE admin SET password = ? WHERE id = '$id'";
  $stmt = mysqli_prepare($connection, $sql);
  $password = $_POST['password'];
  mysqli_stmt_bind_param($stmt, "s", $password);
  mysqli_stmt_execute($stmt);
  $connection = null;
  //redirect to login page
  
?>