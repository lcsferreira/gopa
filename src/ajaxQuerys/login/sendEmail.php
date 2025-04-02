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
  //get the email from the form
  $email = $_POST['email'];
  //get the email from the admin table 
  $sql = "SELECT * FROM admin WHERE email = '$email'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  $sql2 = "SELECT * FROM contacts WHERE email = '$email'";
  $result2 = mysqli_query($connection, $sql2);
  $row2 = mysqli_fetch_assoc($result2);

  if(mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0){
    if(mysqli_num_rows($result) > 0){
      $id = $row['id'];
      $userType = "admin";
    }
    else if(mysqli_num_rows($result2) > 0){
      $id = $row2['id'];
      $userType = "contact";
    }
    //send the email
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
      $mail->Subject = "Reset Password";
      $mail->Body = "
      <br>
        Did you forgot your password?
      <br><br>
        Please click in the <b>link below</b> to reset your password.
      <br><br>
        <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/resetPassword.php?id=$id&userType=$userType'>Reset Password</a>
      <br><br>
        If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
      ";
      $mail->send();
      echo "success";
    } catch (Exception $e) {
      echo "error";
    }
  }else{
    echo "email does not exist";
  }
?>