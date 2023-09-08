<?php
  include_once "../../../config.php"
?>
<?php 
  $id_country = $_POST['id_country'];
  $title = $_POST['title'];
  $reference = $_POST['reference'];
  $inc = $_POST['inc'];


  //check if inc is zero an set it to null
  if($inc == 0){
    $inc = NULL;
  } else if($inc == ""){
    $inc = NULL;
  }

  $title = mysqli_real_escape_string($connection, $title);
  $reference = mysqli_real_escape_string($connection, $reference);

  //update table with the value
  $sql = "CALL insertWithIncrementContact($id_country, '$title', '$reference', $inc)";
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>