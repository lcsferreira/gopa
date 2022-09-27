<?php
  include_once "../../config.php"
?>
<?php
$name  = $_POST['name'];
$email  = $_POST['email'];
$password = $_POST['password'];
/* validate whether user has entered all values. */
if(!$name || !$email || !$password){
  $result = 2;
}elseif (!strpos($email, "@") || !strpos($email, ".")) {
  $result = 3;
}
else {
  //SQL query to get results from database
  $sql = "INSERT INTO admin (name, email, password) VALUES (:name, :email, :password)";
  $stmt = $connection->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);
  if($stmt->execute()){
    $result = 1;
  }
}
$connection = null;
?>