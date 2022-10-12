<?php
  include_once "../../config.php"
?>
<?php
  $id = $_POST['id'];
  $sql = "DELETE FROM admin WHERE id = '$id'";
  $result = mysqli_query($connection, $sql);
  if($result){
    echo "success deleting admin";
  }else{
    echo "Error deleting admin";
  }
?>