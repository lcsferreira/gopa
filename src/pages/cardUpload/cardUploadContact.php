<?php
$country_id = $_POST['country_id'];

$valid_extensions = array('pdf', 'png', 'jpg'); // valid extensions// upload directory
$path2 = '../../../uploads/files/';

if($_FILES['uploadFILE']['size'] !=0)
{
  $pdf = $_FILES['uploadFILE']['name'];
  $tmp2 = $_FILES['uploadFILE']['tmp_name'];
  // get uploaded file's extension
  $ext2 = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
  // can upload same image using rand function
  $final_pdf = md5($country_id).".".$ext2;
  // check's valid format
  if(in_array($ext2, $valid_extensions)) 
  { 
    $path2 = $path2.strtolower($final_pdf);
    if(move_uploaded_file($tmp2,$path2)) 
    {
      $path2 = "uploads/files/".$final_pdf;
      // update database with the path at the file_path
      $sql = "UPDATE cards_en SET file_path = ? WHERE id = $country_id";
      $stmt = mysqli_prepare($connection, $sql);
      mysqli_stmt_bind_param($stmt, "s", $path2);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($connection);
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