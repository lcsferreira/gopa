<?php
  include_once "../../../config.php"
?>
<?php
$country_id = $_POST['country_id'];

$valid_extensions = array('pdf'); // valid extensions// upload directory
$path2 = '../../../uploads/card_english/';

if($_FILES['cardPDF']['size'] !=0)
{
  $pdf = $_FILES['cardPDF']['name'];
  $tmp2 = $_FILES['cardPDF']['tmp_name'];
  // get uploaded file's extension
  $ext2 = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
  // can upload same image using rand function
  $final_pdf = $country_id.'.'.$ext2;
  // check's valid format
  if(in_array($ext2, $valid_extensions)) 
  { 
    $path2 = $path2.strtolower($final_pdf);
    if(move_uploaded_file($tmp2,$path2))
    {
      //sql update cards_en table of has_card to 1
      $sql = "UPDATE cards_en SET has_card = 1 WHERE id = $country_id";
      mysqli_query($connection, $sql);
      echo $country_id;
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