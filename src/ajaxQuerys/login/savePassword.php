<?php 
  include_once "../../../config.php";
?>
<?php
  $id = $_POST['id'];
  $userType = $_POST['userType'];
  //update admin password where id = $id
  if($userType == "contact"){
    $sql = "UPDATE contacts SET password = ? WHERE id = '$id'";
  }else if($userType == "admin"){
    $sql = "UPDATE admin SET password = ? WHERE id = '$id'";
  }
  $stmt = mysqli_prepare($connection, $sql);
  $password = md5($_POST['password']);
  mysqli_stmt_bind_param($stmt, "s", $password);
  mysqli_stmt_execute($stmt);
  
  if(mysqli_stmt_affected_rows($stmt) > 0){
    echo "success";
  }else{
    echo "error creating password";
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
  
?>