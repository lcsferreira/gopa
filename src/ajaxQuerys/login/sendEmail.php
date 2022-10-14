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
    //send the email
    //$to = $email;
    //$subject = "Password Reset";
    //$message = "Your new password is: $password";
    //$headers = "From: GopaTeam";
    //mail($to, $subject, $message, $headers);
    echo "success";
  }else{
    echo "email does not exist";
  }
?>