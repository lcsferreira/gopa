<?php 
  include_once "../../../config.php";

  $id = $_POST['id'];
  $userType = $_POST['userType'];
  $password = md5($_POST['password']);

  if($userType == "contact"){
    $checkSql = "SELECT password FROM contacts WHERE id = $id";
  }else if($userType == "admin"){
    $checkSql = "SELECT password FROM admin WHERE id = $id";
  }

  $result = mysqli_query($connection, $checkSql);
  $row = mysqli_fetch_assoc($result);

  // Determine if this is a password update or a new password creation
  if ($row && !empty($row['password'])) {
    $action = "updated";
  } else {
    $action = "created";
  }

  if($userType == "contact"){
    $sql = "UPDATE contacts SET password = ? WHERE id = $id";
  }else if($userType == "admin"){
    $sql = "UPDATE admin SET password = ? WHERE id = $id";
  }

  $stmt = mysqli_prepare($connection, $sql);
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