<?php
  include_once "../../../config.php" 
?>
<?php
//get id from url
$id = $_GET['id'];
$userType = $_GET['userType'];

if($userType == "contact"){
  $sql = "SELECT is_active, password FROM contacts WHERE id = '$id'";

  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['is_active'] == 0){
    //redirect to login page
    header("Location: ../../pages/login/login.php");
  }
}else if($userType == "admin"){
  $sql = "SELECT is_active, password FROM admin WHERE id = '$id'";

  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['is_active'] == 0){
    //redirect to login page
    header("Location: ../../pages/login/login.php");
  }
}else{
  //redirect to login page
  header("Location: ../../pages/login/login.php");
}
?>