<?php
  include_once "../../../config.php"
?>
<?php
  $indicator = $_POST['indicator'];
  $value = $_POST['value'];
  $id = $_POST['id'];

  //update demographic_values_admin table
  $sql = "UPDATE demographic_values_admin SET $indicator = ? WHERE id = $id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "s", $value);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>