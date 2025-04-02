<?php
  include_once "../../../config.php"
?>
<?php
  //get id from url
  $consent  = $_POST['consent'];
  $id = $_POST['id'];

  //update the contact table where the id is equal to the id from the request and set the consent from the request
  $sql = "UPDATE contacts SET consent = ? WHERE id = $id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "i", $consent);
  mysqli_stmt_execute($stmt);

  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    echo "success";
  }
?>