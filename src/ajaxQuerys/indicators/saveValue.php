<?php
  include_once "../../../config.php"
?>
<?php
  $indicator = $_POST['indicator'];
  $value = $_POST['value'];
  $id = $_POST['id'];
  $table = $_POST['table'];

  if($value == ""){
    $value = NULL;
  }

  //update table with the value
  $sql = "UPDATE $table SET $indicator = ? WHERE id = $id";
  $stmt = mysqli_prepare($connection, $sql);

    mysqli_stmt_bind_param($stmt, "s", $value);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);

  mysqli_close($connection);

  //create a session variable to check if the data was edited
  session_start();
  //set the edited variable to true
  $_SESSION['edited'] = true;

?>