<?php
  include_once "../../../config.php"
?>
<?php
  //get id from the request
  $country_id = $_POST['id'];

  //update the country table where the id is equal to the id from the request and set the indicators_step to wainting_contact
  $sql = "UPDATE countries SET indicators_step = 'waiting contact' WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_execute($stmt);

  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    //send email to the contact
    $sql = "SELECT email FROM contact WHERE id = $contact_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>