<?php
  include_once "../../config.php"
?>
<?php
$name  = $_POST['name'];
$email  = $_POST['email'];
$is_active = $_POST['is_active'];
  //update admin values where email = $email
  $sql = "UPDATE admin SET name = ?, email = ?, is_active = ? WHERE email = '$email'";
  
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $is_active);
  mysqli_stmt_execute($stmt);
  
  //select the id of the admin that was just updated
  $sql = "SELECT id FROM admin WHERE email = '$email'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $id = $row['id'];

  echo "firstAccess.php?id='$id'";
  
  if(mysqli_stmt_affected_rows($stmt) > 0){
    echo "success";
  }else{
    echo "error updating account";
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>