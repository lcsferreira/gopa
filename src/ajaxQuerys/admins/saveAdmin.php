<?php
  include_once "../../../config.php"
?>
<?php
  $name  = $_POST['name'];
  $email  = $_POST['email'];

  $sql = "INSERT INTO admin (name, email) VALUES (?, ?)";
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "ss", $name, $email);
  mysqli_stmt_execute($stmt);

  if(mysqli_stmt_affected_rows($stmt) > 0){
    echo "success";
  }else{
    echo "error creating account";
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);


?>