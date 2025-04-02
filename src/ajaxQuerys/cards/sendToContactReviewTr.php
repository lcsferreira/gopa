<?php
  include_once "../../../config.php";
  include '../../../email_config.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require '../../../PHPMailer/src/Exception.php';
  require '../../../PHPMailer/src/PHPMailer.php';
  require '../../../PHPMailer/src/SMTP.php';
?>
<?php
  //get id from the request
  $country_id = $_POST['id'];

  //select the name from the country where the id is equal to the id from the request
  $sql = "SELECT name FROM countries WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $country_name);
  mysqli_stmt_store_result($stmt);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  //update the country table where the id is equal to the id from the request and set the indicators_step to wainting_contact
  $sql = "UPDATE countries SET country_cards_step = 'waiting contact' WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);

  
  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    $sql = "SELECT contact_id FROM country_contact WHERE country_id = $country_id";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $contact_id);
    mysqli_stmt_store_result($stmt);
    $contacts = array();
    while(mysqli_stmt_fetch($stmt)){
      array_push($contacts, $contact_id);
    }

    foreach ($contacts as $contact) {
      $sql = "SELECT email FROM contacts WHERE id = $contact AND is_active = 1";
      $stmt = mysqli_prepare($connection, $sql);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $email);
      mysqli_stmt_store_result($stmt);
      while (mysqli_stmt_fetch($stmt)) {
        try{
          $mail = new PHPMailer(true);
          $mail->SMTPDebug = 0;                                 // Enable verbose debug output
          $mail->isSMTP();
          $mail->Host = $dreamhost;
          $mail->SMTPAuth = true;
          $mail->Username = $host_username;
          $mail->Password = $host_password;
          $mail->SMTPSecure = 'ssl';
          $mail->Port = $host_port;
          $mail->setFrom($host_username, 'GoPA! Workflow');
          $mail->addAddress($email);
          $mail->isHTML(true);
          $mail->Subject = "Translated Card Step - Review required";
          $mail->Body = "
          <br>
          Dear ".$country_name." Contact,
          <br><br>
          For the Third set of Country Cards 2024, <b>we have updated the translated version of the GoPA! Country Card.</b> Please log into the workflow in order to review it, make any adjustments, and approve it.
          <br><br>
          Please click in the <b>link below</b> to enter the 2024 GoPA! Country Cards workflow.
          <br><br>
          <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>Workflow</a>
          <br><br>
          If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
          ";
          $mail->send();
          echo "success";
        } catch (Exception $e) {
          echo "error";
        }
      }
    }
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>