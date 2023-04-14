<?php
  include_once "../../../config.php"
?>
<?php
  //get the payload from the post request 
  $payload = $_POST['payload'];
  //get the data from the payload
  $name  = $payload['name'];
  $capital = $payload['capital'];
  //get the region from the payload
  $region = $payload['region'];
  $need_translation = $payload['need_translation'];
  $indicators_step = $payload['indicators_step'];
  $translation_step = $payload['translation_step'];
  $country_cards_step = $payload['country_cards_step'];
  $country_cards_step_en = $payload['country_cards_step_en'];

  $sql = "INSERT INTO countries (name, capital, region, indicators_step, translation_step, country_cards_step, need_translation, country_cards_step_en) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "ssssssss", $name, $capital, $region, $indicators_step, $translation_step, $country_cards_step, $need_translation, $country_cards_step_en);
  mysqli_stmt_execute($stmt);

  if(mysqli_stmt_affected_rows($stmt) > 0){
    echo "success";
  }else{
    echo "error creating country";
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);


?>