<?php
  include_once "../../../config.php"
?>
<?php
  $country_id = $_POST['id'];
  $value = $_POST['value'];

  //update the country table where the id is equal to the id from the request and set the indicators_step from the request
  $sql = "UPDATE countries SET country_cards_step_en = ? WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "s", $value);
  mysqli_stmt_execute($stmt);

  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    if($value == "approved"){
      echo "approved";
    }else{
      echo "success";
    }
  }else{
    echo "error";
  }


  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>