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

  //get the error code
  $error = mysqli_stmt_errno($stmt);
  if($error){
    echo $error;
  }else{
    if(mysqli_stmt_affected_rows($stmt) > 0){
      echo "success";
    }else{
      echo "No account was created! Please try again.";
    }
  }
    
  mysqli_stmt_close($stmt);

  mysqli_close($connection);


?>