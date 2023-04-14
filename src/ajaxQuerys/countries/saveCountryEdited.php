<?php
  include_once "../../../config.php"
?>
<?php
  $payload = $_POST['payload'];
  //get the data from the payload
  $id = $payload['id'];
  $name  = $payload['name'];
  $capital = $payload['capital'];
  $region = $payload['region'];
  $need_translation = $payload['need_translation'];
  $translation_step = $payload['translation_step'];
  
  //update admin values where email = $email
  $sql = "UPDATE countries SET name = ?, capital = ?, region = ?, translation_step = ?, need_translation = ? WHERE id = '$id'";
  
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "ssssi", $name, $capital, $region,$translation_step, $need_translation);
  mysqli_stmt_execute($stmt);
  
  if(mysqli_stmt_affected_rows($stmt) > 0){
    echo "success";
  }else{
    echo "error updating country";
  }
  
  mysqli_stmt_close($stmt);
  mysqli_close($connection);
?>