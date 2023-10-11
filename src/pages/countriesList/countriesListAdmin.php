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
    <?php
      $type = "country";
      include_once "../../components/modalDelete.php";
      include_once "../../components/modalConfirm.php";
    ?>
    <div class="title-header">
      <h1>Countries List</h1>
      <form method="get" action="">
        <select name="filter" id="filter">
          <option value="" selected disabled hidden>Choose here</option>
          <option value="all">All</option>
          <option value="not started">Not Started</option>
          <option value="waiting admin">Action Required</option>
          <option value="waiting contact">Waiting</option>
          <option value="approved">Approved</option>
        </select>
        <input class="btn-start" type="submit" name="submit" value="Filter"/>
      </form>
        <button class="btn-create" type="button" onclick="window.location.href='countryCreate.php'">
        Register Country
      </button>
      </button>
    </div>
    <div>
      <p class="info"><a href='https://work.globalphysicalactivityobservatory.com/src/pages/others/countries_list_info.php' target='_blank'>Click Here</a> to view the infromation of the country from the countries that have approved the indicators.</p>
    </div>
    <div class="countries-list">
      <?php
        $filter = $_GET['filter'];
        switch ($filter) {
          case 'all':
            $sql = "SELECT * FROM countries ORDER BY name ASC";
            break;
          case 'not started':
            $sql = "SELECT * FROM countries WHERE indicators_step = 'not started' OR translation_step = 'not started' OR country_cards_step_en = 'not started' OR country_cards_step = 'not started' ORDER BY name ASC";
            break;
          case 'waiting admin':
            $sql = "SELECT * FROM countries WHERE indicators_step = 'waiting admin' OR translation_step = 'waiting admin' OR country_cards_step_en = 'waiting admin' OR country_cards_step = 'waiting admin' ORDER BY name ASC";
            break;
          case 'waiting contact':
            $sql = "SELECT * FROM countries WHERE indicators_step = 'waiting contact' OR translation_step = 'waiting contact' OR country_cards_step_en = 'waiting contact' OR country_cards_step = 'waiting contact' ORDER BY name ASC";
            break;
          case 'approved':
            $sql = "SELECT * FROM countries WHERE indicators_step = 'approved' OR translation_step = 'approved' OR country_cards_step_en = 'approved' OR country_cards_step = 'approved' ORDER BY name ASC";
            break;
          default:
            $sql = "SELECT * FROM countries ORDER BY name ASC";
            break;
        }
      
        // $sql = "SELECT * FROM countries ORDER BY name ASC";
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);
    
        if($resultCheck > 0){
          echo "<div class='list'>";
          while($row = mysqli_fetch_assoc($result)){
          echo "<div class='list-object'>
                    <div class='country-flag'>
                      <i class='fa fa-flag'></i>
                    </div>
                    <div class='info-detail'>
                      <p>" . $row['name'] . "</p>
                    </div>
                    <div class='steps-list'>
                      <div class='step'>
                        <p>Indicators</p>
                        <button type='button' class='step-start' onclick='document.location = `../indicators/progress.php?id=" . $row['id'] . "`'>";
                        if($row['indicators_step'] == 'not started'){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['indicators_step'] == 'waiting contact'){
                          echo "<i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['indicators_step'] == 'waiting admin'){
                          echo "<i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['indicators_step'] == 'approved'){
                          echo "<i class='fa fa-check-circle fa-2x green'></i>";
                        };
                        echo "</button>
                      </div>
                      <div class='step'>
                        <p>Country Card English Version</p>
                        <button ";
                        if ($row['indicators_step'] != 'approved') {
                          echo "disabled ";} echo "type='button' class='step-start' onclick='document.location = `../cardUpload/cardUpload.php?id=". $row['id'] ."`'>";
                        if($row['country_cards_step_en'] == 'not started'){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['country_cards_step_en'] == 'waiting contact'){
                          echo "<i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['country_cards_step_en'] == 'waiting admin'){
                          echo "<i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['country_cards_step_en'] == 'approved'){
                          echo "<i class='fa fa-check-circle fa-2x green'></i>";
                        };
                        echo "</button>
                      </div>
                      <div class='step'"; if ($row['need_translation'] == 0) {
                        echo " style='display: none'";} echo ">
                        <p>Translation</p>
                        <button "; if ($row['country_cards_step_en'] != 'approved') {
                          echo "disabled ";
                        }
                        echo "type='button' class='step-start'";
                        if($row['translation_step'] == 'not started'){
                          echo "onclick='startTranslation(".$row['id'].")'>";
                        }else{
                          echo "onclick='document.location = `../translation/translation_form.php?id=". $row['id'] ."`'>";
                        }
                        if($row['translation_step'] == 'not started'){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['translation_step'] == 'waiting contact'){
                          echo "<i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['translation_step'] == 'waiting admin'){
                          echo "<i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['translation_step'] == 'approved'){
                          echo "<i class='fa fa-check-circle fa-2x green'></i>";
                        }else if($row['translation_step'] == ''){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        };
                        echo"</button>
                      </div>
                      <div class='step'"; if ($row['need_translation'] == 0) {
                        echo " style='display: none'";} echo ">
                        <p>Country Card Translated Version</p>
                        <button "; if ($row['translation_step'] != 'approved') {
                          echo "disabled ";
                        }
                        echo "type='button' class='step-start'onclick='document.location = `../cardUpload/cardUploadTranslated.php?id=". $row['id'] ."`'>";
                        if($row['country_cards_step'] == 'not started'){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['country_cards_step'] == 'waiting contact'){
                          echo "<i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['country_cards_step'] == 'waiting admin'){
                          echo "<i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['country_cards_step'] == 'approved'){
                          echo "<i class='fa fa-check-circle fa-2x green'></i>";
                        }else if($row['country_cards_step'] == ''){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        };
                        echo"</button>
                      </div>
                    </div>
                    <div class='object-buttons'>
                      <button class='btn-edit' onclick='document.location = `countryEdit.php?id=".$row['id']."`'>
                        <i class='fa fa-pencil'></i>
                      </button>
                      <button class='btn-delete' onclick='showModal(".$row['id'].")'>
                        <i class='fa fa-trash'></i>
                      </button>
                    </div>
                  </div>";
            
          }
          echo "</div>";
        }else {
          echo "<p>No country found.</p>";
        }
      ?>
    </div>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
  <script src="../../js/countries/countryDelete.js"></script>
</body>

</html>