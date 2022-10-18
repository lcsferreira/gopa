<?php
  include_once "../../../config.php"
?>
<?php
$name  = $_POST['name'];
$capital  = $_POST['capital'];
$region  = $_POST['region'];
$need_translation  = $_POST['need_translation'];
  //update admin values where email = $email
  $sql = "UPDATE country SET name = ?, capital = ?, region = ?, need_translation = ? WHERE name = '$name'";
  
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "sssi", $name, $capital, $region, $need_translation);
  mysqli_stmt_execute($stmt);
  
  if(mysqli_stmt_affected_rows($stmt) > 0){
    echo "success";
  }else{
    echo "error updating country";
  }
  
  
  mysqli_stmt_close($stmt);
  mysqli_close($connection);
?>