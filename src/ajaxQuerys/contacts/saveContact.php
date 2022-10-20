<?php
  include_once "../../../config.php"
?>
<?php
  $payload  = $_POST['payload'];
  $name = $payload['name'];
  $email = $payload['email'];
  $secondaryEmail = $payload['secondaryEmail'];
  $institution = $payload['institution'];
  $countries = $payload['countries'];

  //for each country insert a contact in contacts table
  foreach($countries as $country)
  {
    $contactType = $country['type'];
    $countryId = $country['id'];
    $insertSql = "INSERT INTO contacts (name, email, institution, secondary_email, id_country,contact_type)
    VALUES ('$name', '$email','$institution','$secondaryEmail','$countryId','$contactType')";
    $stmt = mysqli_prepare($connection, $insertSql);

    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0){
      echo "success";
    }else{
      echo "error creating account";
    }

    mysqli_stmt_close($stmt);

    mysqli_close($connection);
  }

?>