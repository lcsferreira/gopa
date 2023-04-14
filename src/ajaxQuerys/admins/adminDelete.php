<?php
  include_once "../../../config.php"
?>
<?php
  $id = $_POST['id'];
  session_start();
  //delete admin where id = $id if id is not equal to session id
  if($id != $_SESSION['id']){
    $sql = "DELETE FROM admin WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    echo "success deleting admin";
  }else{
    echo "You cannot delete yourself";
  }
?>