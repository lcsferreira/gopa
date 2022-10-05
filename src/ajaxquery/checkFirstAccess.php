<?php
//get id from url
$id = $_GET['id'];

$sql = "SELECT is_active, password FROM admin WHERE id = '$id'";

$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
if($row['password'] != null && $row['is_active'] != 1 ){
  printf("already singed up");
  header("Location: ../login.php");
}

?>