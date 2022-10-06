<?php
  include_once "../../config.php"
?>
<?php
//get email and password from login.php
$email = $_POST['email'];
$password = $_POST['password'];
//check if email and password are correct
$sql = "SELECT id, password FROM admin WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
echo $row['password'];
if($row['password'] === $password){
  //if email and password are correct, create session
  session_start();
  $_SESSION['id'] = $row['id'];
  //redirect to dashboard
  echo "success";
}else{
  echo "wrong email or password";
}
?>