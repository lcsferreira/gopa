<?php
  $title = "Country Cards";                   
  include "../../components/header.php";                 
?>
<?php
  $country_id = $_GET['id'];
  $sql = "SELECT country_cards_step FROM countries WHERE id = $country_id";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['country_cards_step'] == "not started"){
    $sql = "INSERT INTO cards_en (id) VALUES ($country_id)";
    mysqli_query($connection, $sql);
    $sql = "UPDATE countries SET country_cards_step = 'waiting admin' WHERE id = $country_id";
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
    <div class="title mt-50">
      <h1>Country Card English Version</h1>
    </div>
    <div class="forms-container">
      <form id="form" action="ajaxUpload.php" method="post" enctype="multipart/form-data">
        <div class='form-file'>
          <input type="hidden" name="country_id" value='<?php echo $country_id?>'>
          <label for="uploadPDF">Click to upload a file</label>
          <input id="uploadPDF" type="file" accept="file/*" name="cardPDF" class="add-btn" <?php if ($_SESSION["userType"] != "admin") {
            echo " disabled";
          }?>/>
        </div>
        <input class="btn-confirm a-center" type="submit" value="Upload" <?php if ($_SESSION["userType"] != "admin") {
            echo " disabled";
          }?>>
        <div id="preview">No card uploaded.</div>
        <br>
        <a class="btn-confirm btn-download" href="https://work.globalphysicalactivityobservatory.com/uploads/card_english/<?php echo $country_id?>.pdf" download="country_card_en" <?php if($row['has_card']== 0){
              echo " style='display: none'";
            } ?>><i class="fa fa-download"></i> Download</a>
      </form>

      <form id="form-contact" action="cardUploadContact.php" method="post" enctype="multipart/form-data">
        <div class="form-input">
          <p>To ensure efficient review and identification of adjustments, please use a different color (e.g., red, yellow highlight) when requesting changes for the Country Card.</p>
          <label for="card-comments" class="label-textarea">If any adjustment, please indicate year of information and provide additional comments here: </label>
          <textarea placeholder="Add a comment..." name="comment" id="card-comments" cols="30" rows="5" class="comment" <?php if ($_SESSION["userType"] == "admin") {
            echo " disabled";
          }?> onblur='saveComment()'>
            <?php echo $row['comment']?>  
        </textarea>
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
          <?php if ($_SESSION["userType"] == "admin") {
            echo "<a class='btn-confirm btn-download' href='https://work.globalphysicalactivityobservatory.com/uploads/files/".$file_path."' download='contact_comment'"; if($row['has_contact_file']== 0){
              echo " style='display: none'";
            }echo "><i class='fa fa-download'></i> Download</a>";
          }?>
          <div id="msg-file-contact"></div>
        </div>
        <div style="width: 65%">
          <p>Feel free to include audio with your feedback by sending it to the following WhatsApp number: +57 320 8071534. (Recordings may be submitted in English, Portuguese, or Spanish)</p>
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
    <div id="msg"></div>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
</body>

</html>