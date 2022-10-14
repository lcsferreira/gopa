<?php
  include_once "../../../config.php"
?>
<?php
  $id = $_POST['id'];
  //delete country where id = $id
  $sql = "DELETE FROM countries WHERE id = '$id'";
  $result = mysqli_query($connection, $sql);
  if(mysqli_affected_rows($connection) > 0){
    echo "success deleting country";
  }else{
    echo "error deleting country";
  }
?>