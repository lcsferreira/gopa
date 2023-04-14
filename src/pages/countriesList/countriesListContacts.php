<?php
  $title = "Countries List";                   
  include "../../components/header.php";                 
?>
<?php
  include_once "../../../config.php"
?>
<?php
  if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== "1"){
    header("location: ../login/login.php");
    exit();
  }
?>
<?php
  //select country_id from the table country_contact_relation where the contact id is equal to $_SESSION['id']
  $sql = "SELECT country_id FROM country_contact WHERE contact_id = ".$_SESSION['id'];
  $result = mysqli_query($connection, $sql);
  $resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
      $country_id = $row['country_id'];
    }
  } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Countries List</title>
  <link rel="stylesheet" href="../../../css/pages/list/list.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container" id="main">
    <div class="title-header">
      <h1>Countries List</h1>
    </div>
    <div class="countries-list">
      <?php 
        $sql = "SELECT * FROM countries WHERE id = '$country_id' ORDER BY name ASC";
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
          echo "<div class='list'>";
          while($row = mysqli_fetch_assoc($result)){
            echo "<div class='list-object contact'>
                    <div class='country-flag'>
                      <i class='fa fa-flag'></i>
                    </div>
                    <div class='info-detail'>
                      <p>".$row['name']."</p>
                    </div>
                    <div class='steps-list'>
                      <div class='step'>
                        <p>Indicators</p>
                        <button title='Go to Indicators Step' type='button' class='step-start' onclick='document.location = `../indicators/progress.php?id=" . $row['id'] . "`";
                        if($row['indicators_step'] == 'not started'){
                          echo "' disabled><i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['indicators_step'] == 'waiting admin'){
                          echo "' disabled><i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['indicators_step'] == 'waiting contact'){
                          echo "'><i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['indicators_step'] == 'approved'){
                          echo "' disabled><i class='fa fa-check-circle fa-2x green'></i>";
                        };
                        echo "</button>
                      </div>
                      <div class='step'>
                        <p>Country Card English Version</p>
                        <button "; if ($row['indicators_step'] != 'approved') {
                          echo "disabled ";} echo  "title='Go to Cards review Step' type='button' class='step-start' onclick='document.location = `../cardUpload/introCardsUpload.php?id=". $row['id'] ."`'";
                        if($row['country_cards_step_en'] == 'not started'){
                          echo " disabled><i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['country_cards_step_en'] == 'waiting admin'){
                          echo " disabled><i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['country_cards_step_en'] == 'waiting contact'){
                          echo "><i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['country_cards_step_en'] == 'approved'){
                          echo " disabled><i class='fa fa-check-circle fa-2x green'></i>";
                        };
                        echo "</button>
                      </div>
                      <div class='step'";if ($row['need_translation']== 0) {
                        echo "style='display: none '";} echo">
                        <p>Translation</p>
                        <button "; if ($row['country_cards_step_en'] != 'approved') {
                          echo " disabled ";} echo "title='Go to Translation Step' type='button' class='step-start' onclick='document.location = `../translation/translation_form.php?id=".$row['id']."`'";
                        if($row['translation_step'] == 'not started'){
                          echo " disabled><i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['translation_step'] == 'waiting admin'){
                          echo " disabled><i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['translation_step'] == 'waiting contact'){
                          echo "><i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['translation_step'] == 'approved'){
                          echo " disabled><i class='fa fa-check-circle fa-2x green'></i>";
                        };
                        echo "</button>
                      </div>
                      <div class='step'"; if ($row['need_translation'] == 0) {
                        echo " style='display: none'";} echo ">
                        <p>Country Card Translated Version</p>
                        <button "; if ($row['translation_step'] != 'approved') {
                          echo " disabled";} echo"type='button' class='step-start' onclick='document.location = `../cardUpload/introCardsUploadTranslated.php?id=".$row['id']."`'";
                        if($row['country_cards_step'] == 'not started'){
                          echo " disabled><i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['country_cards_step'] == 'waiting admin'){
                          echo " disabled><i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['country_cards_step'] == 'waiting contact'){
                          echo "><i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['country_cards_step'] == 'approved'){
                          echo " disabled><i class='fa fa-check-circle fa-2x green'></i>";
                        }else if($row['country_cards_step'] == ''){
                          echo " disabled><i class='fa fa-play-circle fa-2x gray'></i>";
                        };
                        echo"</button>
                      </div>
                    </div>
                  </div>";
            
          }
          echo "</div>";
        }
      ?>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `../countriesList/introIndicators.php`'";
          ?>>Back</button>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
  <script src="../../js/countries/countryDelete.js"></script>
</body>
</html>