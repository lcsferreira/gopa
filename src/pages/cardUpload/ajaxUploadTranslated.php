<?php
  include_once "../../../config.php"
?>
<?php 
  function getThumbnail($path, $country) {
    if (is_dir($path)) {
        $files = scandir($path);
        
        foreach ($files as $file) {
            if ($file != "." && $file != ".." && strpos($file, $country) === 0 && pathinfo($file, PATHINFO_EXTENSION) === "png") {
                return $file; // Retorna o primeiro arquivo encontrado
            }
        }
    }
    
    return null; // Retorna null se nenhum arquivo for encontrado
  }
?>
<?php
$country_id = $_POST['country_id'];

$valid_extensions = array('pdf'); // valid extensions// upload directory
$path = '../../../uploads/card_translated/';

if($_FILES['pdfFile']['size'] !=0)
{
  $pdf = $_FILES['pdfFile']['name'];
  $tmp2 = $_FILES['pdfFile']['tmp_name'];
  // get uploaded file's extension
  $ext2 = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
  // can upload same image using rand function
  $pdf = $path . $country_id.'.'.$ext2;
  // check's valid format
  if(in_array($ext2, $valid_extensions)) 
  { 
    if(move_uploaded_file($tmp2,$pdf))
    {
      //sql update cards_en table of has_card to 1
      $sql = "UPDATE cards SET has_card = 1 WHERE id = $country_id";
      mysqli_query($connection, $sql);

      //generate thumbnail
      $pdfFilePath = $pdf;
      $thumbnailFile = $path . $country_id; // Nome fixo para a thumbnail
      $oldThumnail = getThumbnail($path, $country_id);
      // echo $oldThumnail;
      unlink($path.$oldThumnail);
      $imagick = new Imagick($pdfFilePath);
      $imagick->setResolution(300, 300);
      $imagick->setImageFormat('png'); 
      // $imagick->setResolution(3000, 2000); // Resolução em DPI (dots per inch)
      // $imagick->thumbnailImage(500, 500, true); // Redimensionar para Full HD
      $imagick->writeImage($thumbnailFile. date("Y-m-d-H-i-s") . '.png');

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