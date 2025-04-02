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
  $country_id = $_POST['id'];
  $value = $_POST['value'];

  //update the country table where the id is equal to the id from the request and set the indicators_step to wainting_contact
  $sql = "UPDATE countries SET indicators_step = ? WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "s", $value);
  mysqli_stmt_execute($stmt);

  //get the country_name from the countries table where the id is equal to the id from the request
  $sql = "SELECT name FROM countries WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  $country_name = $row['name'];

  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    //send email to the admins if the value is waiting admin or to the contact if the value is waiting contact
    if($value == "waiting admin"){
      $admin_emails = ["julianamegru@gmail.com", "aravamd@gmail.com"];
      // $admin_emails = ["lucas.simoes.ferreira@gmail.com"];
      foreach ($admin_emails as $email) {
        //get time
        date_default_timezone_set('America/Bogota');
        $date = date('m/d/Y h:i:s a', time());
        //send email to admin
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
          $mail->Subject = "Indicators Step - Contact request review";
          $mail->Body = "
          <br>
          Dear Admin,
          <br><br>
          ".$country_name." Contact has sended new information about indicators step for the Country Cards 2024 Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>here</a>.
          <br><br>
          Please click in the <b>link below</b> to enter the 2024 GoPA! Country Cards Workflow.
          <br><br>
          <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>Workflow</a>
          <br><br>
          ";
          $mail->send();
        } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      }
    }else{
      $admin_emails = ["julianamegru@gmail.com", "aravamd@gmail.com"];
      // $admin_emails = ["lucas.simoes.ferreira@gmail.com"];
      foreach ($admin_emails as $email) {
        //get time
        date_default_timezone_set('America/Bogota');
        $date = date('m/d/Y h:i:s a', time());
        //send email to admin
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
          $mail->Subject = "Indicators Step - Contact completed";
          $mail->Body = "
          <br>
          Dear Admin,
          <br><br>
          ".$country_name." Contact has completed a step for the Country Cards 2024 Workflow on ".$date.". You may view their responses <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>here</a>.
          <br><br>
          Please click in the <b>link below</b> to enter the 2024 GoPA! Country Cards Workflow.
          <br><br>
          <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>Workflow</a>
          <br><br>
          ";
          $mail->send();
        } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      }
    }
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>