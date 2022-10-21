<?php
  include_once "../../../config.php"
?>
<?php
  $id = $_POST['id'];
  //delete contact where id = $id
  $sql = "DELETE FROM country_contact WHERE contact_id = '$id'";
  $result = mysqli_query($connection, $sql);
  //if query affected rows then
  //delete contact from country_contact where contact_id = $id
  if(mysqli_affected_rows($connection) > 0){
    $sql = "DELETE FROM contacts WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    echo "success deleting contact";
  }else{
    echo "error deleting contact";
  }

?>