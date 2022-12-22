<?php
  include_once "../../../config.php"
?>
<?php
  $country_id = $_POST['id'];
  $value = $_POST['value'];

  //update the country table where the id is equal to the id from the request and set the indicators_step to wainting_contact
  $sql = "UPDATE countries SET indicators_step = ? WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "s", $value);
  mysqli_stmt_execute($stmt);

  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    //send email to the admins if the value is waiting admin or to the contact if the value is waiting contact
    if($value == "waiting contact"){
      $sql = "SELECT email FROM contact WHERE id = $contact_id";
      $result = mysqli_query($connection, $sql);
      $row = mysqli_fetch_assoc($result);
      $email = $row['email'];
    }else{
      $sql = "SELECT email FROM admin";
      $result = mysqli_query($connection, $sql);
      $row = mysqli_fetch_assoc($result);
      $email = $row['email'];
    }
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>