<?php
  include_once "../../config.php"
?>
<?php
//get email and password from login.php
$email = $_POST['email'];
$password = md5($_POST['password']);
//check if email and password are correct
$sql = "SELECT id, password FROM admin WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

//check if email exists in contact table
$sql2 = "SELECT id, password FROM contact WHERE email = '$email'";
$result2 = mysqli_query($connection, $sql2);
$row2 = mysqli_fetch_assoc($result2);

//check if email exists
if(mysqli_num_rows($result) > 0){
  //check if password is correct
  if($row['password'] == $password){
    //start session
    session_start();
    //set session id
    $_SESSION['id'] = $row['id'];
    $_SESSION['userType'] = "admin";
    echo "success";
  }else{
    echo "wrong password";
  }
}else if(mysqli_num_rows($result2) > 0){
  if($row['password'] == $password){
    //start session
    session_start();
    //set session id
    $_SESSION['id'] = $row['id'];
    $_SESSION['userType'] = "contact";
    echo "success";
  }else{
    echo "wrong password";
  }
}else{
  echo "email does not exist";
}
?>