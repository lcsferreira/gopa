<?php
  include_once "../../config.php"
?>
<?php
$name  = $_POST['name'];
$email  = $_POST['email'];

/* validate whether user has entered all values. */
if(!$name || !$email){
  $result = 2;
}elseif (!strpos($email, "@") || !strpos($email, ".")) {
  $result = 3;
}
else {
  //SQL query to get results from database
  $sql = "INSERT INTO admin (name, email) VALUES (:name, :email)";
  $stmt = $connection->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);

  if($stmt->execute()){
    $result = 1;
  }
}
$connection = null;
?>