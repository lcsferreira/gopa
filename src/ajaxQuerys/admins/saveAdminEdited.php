<?php
  include_once "../../../config.php"
?>
<?php
$id = $_POST['id'];
$name  = $_POST['name'];
$email  = $_POST['email'];
$is_active = $_POST['is_active'];
  //update admin values where email = $email
  $sql = "UPDATE admin SET name = ?, email = ?, is_active = ? WHERE id = '$id'";
  
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $is_active);
  mysqli_stmt_execute($stmt);
  
  //get the id of the admin that was just updated
  $sql = "SELECT id, password FROM admin WHERE email = '$email'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $id = $row['id'];
  $password = $row['password'];
  
  if(mysqli_stmt_affected_rows($stmt) > 0){
    //if is_active = 1 and password is null, send email to admin
    if($is_active == 1 && $password == null){
      //send email to admin
      //get the id of the admin that was just inserted
      // firstAccess.php?id='$admin_id'
      echo "success! firstAccess.php?id='$id'";
    }
    else{
      echo "success!";
    }
  }else{
    echo "error updating account";
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>