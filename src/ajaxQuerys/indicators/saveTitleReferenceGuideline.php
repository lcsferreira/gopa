<?php
  include_once "../../../config.php"
?>
<?php 
  $id_country = $_POST['id_country'];
  $title = $_POST['title'];
  $reference = $_POST['reference'];
  $inc = $_POST['inc'];

  //check if the value is all blank spaces
  if($title != NULL){
    if(preg_match('/^\s*$/', $title)){
      $title = NULL;
    }
  }else if($title == ""){
    $title = NULL;
  }

  //check if the value is all blank spaces
  if($reference != NULL){
    if(preg_match('/^\s*$/', $reference)){
      $reference = NULL;
    }
  }else if($reference == ""){
    $reference = NULL;
  }

  //check if inc is zero an set it to null
  if($inc == 0){
    $inc = NULL;
  } else if($inc == ""){
    $inc = NULL;
  }

  //update table with the value
  $sql = "CALL InsertGuidelineWithIncrement($id_country, '$title', '$reference', $inc)";

  $stmt = mysqli_prepare($connection, $sql);
  
  mysqli_stmt_execute($stmt);
  

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>