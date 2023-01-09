<?php
  include_once "../../../config.php"
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
    }
    else if(mysqli_num_rows($result2) > 0){
      $id = $row2['id'];
    }
    //send the email
    $assunto = "Reset Password";
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
    $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
    $headers .= "X-Priority: 1\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
  
    $mensagem = "
    <br>
      Did you forgot your password?
    <br><br>
      Please click in the <b>link below</b> to reset your password.
    <br><br>
      <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/resetPassword.php?id=$id'>Reset Password</a>
    <br><br>
      If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
    ";
  
    $enviaremail = mail($email, $assunto, $mensagem, $headers);
  
    if($enviaremail){
      echo "success";
    } else {
      echo "error";
    }
    echo "success";
  }else{
    echo "email does not exist";
  }
?>