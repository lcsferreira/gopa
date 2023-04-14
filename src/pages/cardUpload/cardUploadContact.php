<?php
  include_once "../../../config.php"
?>
<?php
$country_id = $_POST['country_id'];

$valid_extensions = array('pdf', 'png', 'jpg'); // valid extensions// upload directory
$path2 = '../../../uploads/files/';

if($_FILES['uploadFILE']['size'] !=0)
{
  if($_FILES['uploadFILE']['size'] > 10000000){
    echo "file too large";
    exit();
  }
  $pdf = $_FILES['uploadFILE']['name'];
  $tmp2 = $_FILES['uploadFILE']['tmp_name'];
  // get uploaded file's extension
  $ext2 = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
  // can upload same image using rand function
  $final_pdf = $country_id.".".$ext2;
  // check's valid format
  if(in_array($ext2, $valid_extensions)) 
  { 
    $path2 = $path2.strtolower($final_pdf);
    if(move_uploaded_file($tmp2,$path2)) 
    {
      $sql = "UPDATE cards_en SET has_contact_file = 1 WHERE id = $country_id";
      mysqli_query($connection, $sql);
      echo "success";
    }else{
      echo "error";
    }
  } 
  else 
  {
    echo 'invalid';
  }
}else{
  echo "no file selected";
}
?>