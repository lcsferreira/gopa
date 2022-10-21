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

  //insert contact in the database
  $sql = "INSERT INTO contacts (name, email, secondary_email, institution) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($connection, $sql);
  
  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $secondaryEmail, $institution);
  mysqli_stmt_execute($stmt);

  if(mysqli_stmt_affected_rows($stmt) > 0){
    //countries is an array of {country,is_main}, if countries is not empty, insert into country_contact
    if(!empty($countries)){
      $contact_id = mysqli_insert_id($connection);
      foreach($countries as $country){
        $country_id = $country['country_id'];
        $is_main = $country['is_main'];
        $sql = "INSERT INTO country_contact (country_id, contact_id, is_main) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $country_id, $contact_id, $is_main);
        mysqli_stmt_execute($stmt);
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    echo "success";
  }else{
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    echo "error creating contact";
  }

?>