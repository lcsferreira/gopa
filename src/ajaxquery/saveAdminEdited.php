<?php
  include_once "../../config.php"
?>
<?php
$name  = $_POST['name'];
$email  = $_POST['email'];
$key = $_POST['key'];

  //update admin values where email = $email
  $sql = "UPDATE admin SET name = ?, email = ?, adm_key = ? WHERE email = '$email'";
  
  $stmt = mysqli_prepare($connection, $sql);

  mysqli_stmt_bind_param($stmt, "sss", $name, $email, $key);
  mysqli_stmt_execute($stmt);
  $connection = null;
  
  $header = "From:abc@somedomain.com \r\n";
  $header .= "Cc:afgh@somedomain.com \r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html\r\n";


  $message = "Welcome to GOPA! <br /> Click in the link below to create a password for your account <br /> <a href=`../pages/login/firstAccess.php?".$key."></a>";

  mail($email, "Access GOPA", $message, $header);
?>