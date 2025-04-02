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
  <style>
  /* Estilização do Formulário */
  form {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    padding: 15px;
    border-radius: 8px;
  }

  /* Labels */
  form label {
    font-size: 14px;
    font-weight: 600;
    color: #333;
  }

  /* Select */
  form select {
    padding: 8px 12px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background: #fff;
    cursor: pointer;
    transition: border-color 0.2s ease-in-out;
  }

  form select:hover {
    border-color: #007bff;
  }

  form select:focus {
    border-color: #0056b3;
    outline: none;
  }

  /* Botão de filtro */
  form .btn-start {
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    background: #03a9f4;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.2s ease-in-out;
  }

  form .btn-start:hover {
    background: #0056b3;
  }

  /* Responsividade */
  @media (max-width: 768px) {
    .title-header form {
      flex-direction: column;
      gap: 5px;
    }

    .title-header form select,
    .title-header form .btn-start {
      width: 100%;
    }
  }
  </style>
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

      <button class="btn-create" type="button" onclick="window.location.href='countryCreate.php'">
        Register Country
      </button>
      </button>
    </div>
    <div>
      <p class="info"><a
          href='https://work.globalphysicalactivityobservatory.com/src/pages/others/countries_list_info.php'
          target='_blank'>Click Here</a> to view the information of the country from the countries that have approved
        the indicators.</p>
    </div>
    <form method="get" action="">
      <div>

        <label>Indicators:</label>
        <select name="indicators_filter">
          <option value="" selected>All</option>
          <option value="not started">Not Started</option>
          <option value="waiting admin">Action Required</option>
          <option value="waiting contact">Waiting</option>
          <option value="approved">Approved</option>
        </select>
      </div>
      <div>
        <label>Translation:</label>
        <select name="translation_filter">
          <option value="" selected>All</option>
          <option value="not started">Not Started</option>
          <option value="waiting admin">Action Required</option>
          <option value="waiting contact">Waiting</option>
          <option value="approved">Approved</option>
        </select>
      </div>
      <div>
        <label>Country Card (EN):</label>
        <select name="country_cards_en_filter">
          <option value="" selected>All</option>
          <option value="not started">Not Started</option>
          <option value="waiting admin">Action Required</option>
          <option value="waiting contact">Waiting</option>
          <option value="approved">Approved</option>
        </select>
      </div>
      <div>
        <label>Country Card (Translated):</label>
        <select name="country_cards_filter">
          <option value="" selected>All</option>
          <option value="not started">Not Started</option>
          <option value="waiting admin">Action Required</option>
          <option value="waiting contact">Waiting</option>
          <option value="approved">Approved</option>
        </select>
      </div>

      <input class="btn-start" type="submit" name="submit" value="Filter" />
    </form>
    <div class="countries-list">
      <?php
        $whereClauses = [];

        if (!empty($_GET['indicators_filter'])) {
            $whereClauses[] = "indicators_step = '" . mysqli_real_escape_string($connection, $_GET['indicators_filter']) . "'";
        }
        
        if (!empty($_GET['translation_filter'])) {
            $whereClauses[] = "translation_step = '" . mysqli_real_escape_string($connection, $_GET['translation_filter']) . "'";
        }
        
        if (!empty($_GET['country_cards_en_filter'])) {
            $whereClauses[] = "country_cards_step_en = '" . mysqli_real_escape_string($connection, $_GET['country_cards_en_filter']) . "'";
        }
        
        if (!empty($_GET['country_cards_filter'])) {
            $whereClauses[] = "country_cards_step = '" . mysqli_real_escape_string($connection, $_GET['country_cards_filter']) . "'";
        }
        
        $sql = "SELECT * FROM countries";
        if (!empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }
        $sql .= " ORDER BY name ASC";
        
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
      © 2023 GoPA. All rights reserved.
    </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
  <script src="../../js/countries/countryDelete.js"></script>
</body>

</html>