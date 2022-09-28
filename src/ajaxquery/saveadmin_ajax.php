<?php
  include_once "../../config.php"
?>
<?php
  $name  = $_POST['name'];
  $email  = $_POST['email'];

  $sql = "INSERT INTO admin (name, email) VALUES (:name, :email)";
  $stmt = $connection->prepare($sql);

  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  $connection = null;
?>