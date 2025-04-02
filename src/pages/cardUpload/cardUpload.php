<?php
  $title = "Country Cards";                   
  include "../../components/header.php";                 
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
  $country_id = $_GET['id'];
  $sql = "SELECT country_cards_step_en FROM countries WHERE id = $country_id";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['country_cards_step_en'] == "not started"){
    $sql = "INSERT INTO cards_en (id) VALUES ($country_id)";
    mysqli_query($connection, $sql);
    $sql = "UPDATE countries SET country_cards_step_en = 'waiting admin' WHERE id = $country_id";
    mysqli_query($connection, $sql);
  }

  $sql = "SELECT * FROM cards_en WHERE id = $country_id";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

?>
<?php
  if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true){
    header("location: ../login/login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <meta http-equiv="pragma" content="no-cache">
  <title>Country Cards</title>
  <link rel="stylesheet" href="../../../css/pages/cardUpload/cardUpload.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="../../js/cardUpload/cardUpload.js"></script>
  <script src="//npmcdn.com/pdfjs-dist/build/pdf.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</head>

<body>
  <div class="container" id="main">
    <?php
      include_once "../../components/modalConfirm.php";
    ?>
    <div class="title mt-50">
      <h1>Country Card English Version</h1>
    </div>
    <div class="forms-container">
      <form id="form" action="ajaxUpload.php" method="post" enctype="multipart/form-data">
        <div class='form-file' <?php if ($_SESSION["userType"] != "admin") {
            echo " hidden";
          }?>>
          <input type="hidden" name="country_id" value='<?php echo $country_id?>'>
          <label for="pdfFile">Click to upload a file</label>
          <input name="pdfFile" id="pdfFile" type="file" accept="file/*" class="add-btn" <?php if ($_SESSION["userType"] != "admin") {
            echo " disabled";
          }?> />
          <input class="btn-confirm a-center" type="submit" value="Upload">
        </div>
        <div id="preview">
          <?php if($row['has_card']== 0){
            echo "<input type='hidden' name='has_card' value='0'>";
          }else{
            echo "<input type='hidden' name='has_card' value='1'>";
            echo "<input type='hidden' name='card_thumbnail' value='".getThumbnail("../../../uploads/card_english/",$country_id)."'>";
          }
          ?>
        </div>
        <br>
        <a class="btn-confirm btn-download"
          href="https://work.globalphysicalactivityobservatory.com/uploads/card_english/<?php echo $country_id?>.pdf"
          download="country_card_en" <?php if($row['has_card']== 0){
              echo " style='display: none'";
            } ?>><i class="fa fa-download"></i> Download</a>
      </form>

      <form id="form-contact" action="cardUploadContact.php" method="post" enctype="multipart/form-data">
        <div class="form-input">
          <p>To ensure efficient review and identification of adjustments, please use a different color (e.g., red,
            yellow highlight) when requesting changes for the Country Card.</p>
          <label for="card-comments" class="label-textarea">If any adjustment, please indicate year of information and
            provide additional comments here: </label>
          <textarea placeholder="Add a comment..." name="comment" id="card-comments" cols="30" rows="5" class="comment"
            onblur='saveComment()'><?php echo $row['comment']?></textarea>
        </div>
        <div class='form-file'>
          <input type="hidden" name="country_id" value='<?php echo $country_id?>'>
          <label for="uploadFILE">Click to upload a file</label>
          <input id="uploadFILE" type="file" accept="file/*" name="uploadFILE" <?php if ($_SESSION["userType"] == "admin") {
            echo " disabled";
          }?> />
          <input class="btn-confirm" type="submit" value="Upload" <?php if ($_SESSION["userType"] == "admin") {
            echo " disabled";
          }?>>
          <p style="color: #03a9f4; font-weight: bold;">You can only upload files of 10MB size!</p>
          <?php if ($_SESSION["userType"] == "admin") {
    // Lista de extensões de arquivos suportadas
    $supported_extensions = ['pdf', 'docx', 'png', 'jpg'];
    
    // Variável para armazenar o link do arquivo encontrado
    $file_link = null;
    
    // Verifica qual arquivo existe
    foreach ($supported_extensions as $extension) {
        $file_path = "https://work.globalphysicalactivityobservatory.com/uploads/files/" . $country_id . "." . $extension;
        
        // Usa get_headers para verificar se o arquivo existe no servidor
        $headers = @get_headers($file_path);
        if($headers && strpos($headers[0], '200')) {
            $file_link = $file_path;
            break;  // Para o loop se o arquivo for encontrado
        }
    }

    // Se o arquivo foi encontrado, exibe o botão de download
    if ($file_link && $row['has_contact_file'] == 1) {
        echo "<a class='btn-confirm btn-download mt-10' href='" . $file_link . "' download='contact_comment'>
                <i class='fa fa-download'></i> Download</a>";
    }
}?>
          <div id="msg-file-contact"></div>
        </div>
        <div class="form-checkbox">
          <?php if ($_SESSION["userType"] == "admin") {
            echo " <div>
            <label for='status'>Send to contact review</label>
            <input type='radio' name='status' id='status' value='review' 
          </div>";
          }else if($_SESSION["userType"] == "contact"){
            echo " <div>
            <label for='status'>Request further adjustments</label>
            <input type='radio' name='status' id='status' value='adjust'> 
            </div>
            <div>
            <label for='status'>Approve the Country Card</label>
            <input type='radio' name='status' id='status' value='approve'>
            </div>";
          }
          ?>
        </div>
    </div>
    <input class="btn-confirm" type="button" value="Submit" <?php if ($_SESSION["userType"] == "admin") {
            echo "onclick='submitValueAdmin()'";
        } else {
            echo " onclick='submitValue()'";
        }?>>
    </form>
  </div>
  <br>
  <div id="err" class="error-msg"></div>
  <div id="msg" class="loading"></div>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
      © 2023 GoPA. All rights reserved.
    </p>
  </footer>
</body>

</html>