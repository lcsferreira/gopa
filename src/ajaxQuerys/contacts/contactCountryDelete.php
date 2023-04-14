<?php
  include_once "../../../config.php"
?>
<?php
  $country_id = $_POST['country_id'];
  $contact_id = $_POST['contact_id'];
  //select the contact_id from the country_relation table where id = $id
  $sql = "SELECT contact_id FROM country_contact WHERE country_id = '$country_id'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  //if returned only one row
  if(mysqli_num_rows($result) != 0){
    $contact_id_selected = $row['contact_id'];
    
    if($contact_id == $contact_id_selected){
      $sql = "DELETE FROM country_contact WHERE country_id = '$country_id' AND contact_id = '$contact_id'";
      $result = mysqli_query($connection, $sql);
      if($result){
        echo "success";
      }else{
        echo "error";
      }
    }else{
      echo "no relation found";
    }
  }else{
    echo "no relation found";
  }
?>