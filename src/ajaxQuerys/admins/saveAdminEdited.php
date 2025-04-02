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

$id = $_POST['id'];
$name  = $_POST['name'];
$email  = $_POST['email'];
$is_active = $_POST['is_active'];
  //update admin values where email = $email
  $sql = "UPDATE admin SET name = ?, email = ?, is_active = ? WHERE id = '$id'";
  
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $is_active);
  mysqli_stmt_execute($stmt);
  
  //get the id of the admin that was just updated
  $sql = "SELECT id, password FROM admin WHERE email = '$email'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $id = $row['id'];
  $password = $row['password'];
  
  if(mysqli_stmt_affected_rows($stmt) > 0){
    //if is_active = 1 and password is null, send email to admin
    if($is_active == 1 && $password == null){
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
        $mail->Subject = 'Action Required -  GoPA! Country Contact registration instructions - new GoPA! data review and Country Card approval system';
        $mail->Body = "
        <br>
          This is an authomatic activation message for Administrators.
        <br><br>
          Please click in the <b>link below</b> to login in the GoPA Workflow.
        <br><br>
          <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/firstAccess.php?id=$id&userType=admin'>First access registration</a>
        <br><br>
          If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
        ";
        $mail->send();
        echo "success!";
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    

    }
    else{
      echo "success!";
    }
  }else{
    echo "error updating account";
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>