<?php
  include_once "../../config.php"
?>
<?php
$name  = $_POST['name'];
$email  = $_POST['email'];
$key = $_POST['key'];



  $sql = "UPDATE admin SET name = :name, email = :email, adm-key = :key WHERE email = :email";
  $stmt = $connection->prepare($sql);

  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':adm-key', $key);
  $stmt->execute();

  $connection = null;

  $message = "Welcome to GOPA! <br /> Click in the link below to create a password for your account <br /> <a href=`../pages/login/firstAccess.php?"+$key+"></a>";

  mail($email, "Access GOPA", $message);
?>