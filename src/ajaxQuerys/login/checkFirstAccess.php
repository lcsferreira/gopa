<?php
  include_once "../../../config.php" 
?>
<?php
//get id from url
$id = $_GET['id'];

//get the year from the id
$year = substr($id, 0, 4);
//get the actual year
$actualYear = date("Y");
if($year == $actualYear){
  $sql = "SELECT is_active, password FROM contact WHERE id = '$id'";

  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['is_active'] == 0){
  //redirect to login page
  header("Location: ../../pages/login/login.php");
}
}

$sql = "SELECT is_active, password FROM admin WHERE id = '$id'";

$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if($row['is_active'] == 1){
  //redirect to login page
  header("Location: ../../pages/login/login.php");
}
?>