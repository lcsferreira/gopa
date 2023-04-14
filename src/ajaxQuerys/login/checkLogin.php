<?php
  include_once "../../../config.php"
?>
<?php
//get email and password from login.php
$email = $_POST['email'];
$password = md5($_POST['password']);


//check if email exists in admin table
$sql = "SELECT id, password, is_active FROM admin WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

//check if email exists in contact table
$sql2 = "SELECT id, password, is_active FROM contacts WHERE email = '$email'";
$result2 = mysqli_query($connection, $sql2);
$row2 = mysqli_fetch_assoc($result2);

//check if email exists
if(mysqli_num_rows($result) > 0){
  if($row['is_active'] == 0){
    echo "Account is not active";
  }else{
    //check if password is correct
    if($row['password'] == $password){
      //start session
      session_start();
      //set session id
      $_SESSION['id'] = $row['id'];
      $_SESSION['loggedin'] = true;
      $_SESSION['userType'] = "admin";

      echo "success admin";
    }else{
      echo "Wrong password";
    }
  }
}else if(mysqli_num_rows($result2) > 0){
  if($row2['password'] == $password){
    //start session
    session_start();
    //set session id
    $_SESSION['id'] = $row2['id'];
    $_SESSION['loggedin'] = true;
    $_SESSION['userType'] = "contact";
    echo "success contact";
  }else{
    echo "Wrong password";
  }
}else{
  echo "Email does not exist";
}
?>