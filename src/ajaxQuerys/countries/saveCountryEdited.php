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
  $indicators_step = $payload['indicators_step'];
  $country_cards_step = $payload['country_cards_step'];
  $country_cards_step_en = $payload['country_cards_step_en'];

  if ($need_translation == 1) {
    // $sql = "UPDATE countries SET name = ?, capital = ?, region = ?, need_translation = ? WHERE id = '$id'";
    $sql = "UPDATE countries SET name = ?, capital = ?, region = ?, need_translation = ?, country_cards_step = ?, country_cards_step_en = ?, translation_step = ?, indicators_step = ? WHERE id = '$id'";
    $stmt = $connection->prepare($sql);
    // $stmt->bind_param("sssi", $name, $capital, $region, $need_translation);
    $stmt->bind_param("sssissss", $name, $capital, $region, $need_translation, $country_cards_step, $country_cards_step_en, $translation_step, $indicators_step);
    $stmt->execute();
    $result = $stmt->get_result();
    $error = mysqli_error($connection);
    if (mysqli_stmt_affected_rows($stmt) > 0) {
      // $message = "Country updated successfully";
      // $_SESSION['message'] = $message;
      echo "success";
    } else {
      echo  "error updating country";
    }
  } else {
    $sql = "UPDATE countries SET name = '$name', capital = '$capital', region = '$region', need_translation = '$need_translation', translation_step = NULL, country_cards_step = NULL, country_cards_step_en = '$country_cards_step_en', indicators_step = '$indicators_step' WHERE id = '$id'";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $error = mysqli_error($connection);
    if (mysqli_stmt_affected_rows($stmt) > 0) {
      echo "success";
    } else {
      echo  "error updating country";
    }
  }
  
  // //update admin values where email = $email
  // $sql = "UPDATE countries SET name = ?, capital = ?, region = ?, translation_step = ?, need_translation = ? WHERE id = '$id'";
  
  // $stmt = mysqli_prepare($connection, $sql);

  // mysqli_stmt_bind_param($stmt, "ssssi", $name, $capital, $region,$translation_step, $need_translation);
  // mysqli_stmt_execute($stmt);
  
  // if(mysqli_stmt_affected_rows($stmt) > 0){
  //   echo "success";
  // }else{
  //   echo "error updating country";
  // }
  
  // mysqli_stmt_close($stmt);
  // mysqli_close($connection);
?>