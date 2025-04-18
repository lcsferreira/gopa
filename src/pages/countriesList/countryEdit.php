<?php
  $title = "Country Edit";                   
  include "../../components/header.php";                 
?>
<?php
  include_once "../../../config.php";
//select admin values where id = $id
  $id = $_GET['id'];
  $sql = "SELECT * FROM countries WHERE id = '$id'";
  $result = mysqli_query($connection, $sql);
  $country = mysqli_fetch_assoc($result);
  $name = $country['name'];
  $capital = $country['capital'];
  $region = $country['region'];
  $need_translation = $country['need_translation'];
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
  <title>Country Edit</title>
  <link rel="stylesheet" href="../../../css/pages/list/forms.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <form class="forms" method="POST">
      <div class="form-title">
        <h1>
          Country Edit
        </h1>
        <p>
          Fill with the country informations
        </p>
      </div>
      <div class="form-input">
        <label for="name">Name</label>
        <input type="text" id="name" class="form" placeholder="Name" <?php 
          echo "value='".$name."'";
        ?>>
      </div>
      <div class="form-input">
        <label for="capital">Capital</label>
        <input type="text" id="capital" class="form" placeholder="Capital" <?php 
          echo "value='".$capital."'";
        ?>>
      </div>
      <div class="form-input">
        <label for="capital">Region</label>
        <input type="text" id="region" class="form" placeholder="Region" <?php 
          echo "value='".$region."'";
        ?>>
      </div>
      <div class="form-input radio-group">
        <label for="need-translation">Need Translation: </label>
        <div id="need-translation">
          <?php 
            if($need_translation == 1){
              echo "
              <label for='yes'>Yes</label>
              <input type='radio' id='yes' name='need-translation' value='1' checked>
              <label for='no'>No</label>
              <input type='radio' id='no' name='need-translation' value='0'>
              ";
            }else{
              echo "<label for='yes'>Yes</label>
              <input type='radio' id='yes' name='need-translation' value='1'>
              <label for='no'>No</label>
              <input type='radio' id='no' name='need-translation' value='0' checked>
              ";
            }
          ?>
        </div>
      </div>
      <!-- Etapas -->
      <div style="display:flex; flex-direction: column;width: 100%; gap: 1rem; margin-top: 2rem;" class="form-input">
        <h3>Country Workflow Steps</h3>
        <p>Note: NO EMAIL will be SENT regarding the status update</p>
        <!-- indicators_step -->
        <div class="form-group">
          <label for="indicators_step">Indicators Step Status</label>
          <select name="indicators_step" id="indicators_step" style="width: 100%;" class="select-input">
            <option value="not started" <?php if ($country['indicators_step'] == 'not started') echo 'selected'; ?>>
              Not
              Started</option>
            <option value="waiting contact"
              <?php if ($country['indicators_step'] == 'waiting contact') echo 'selected'; ?>>Waiting Contact</option>
            <option value="waiting admin" <?php if ($country['indicators_step'] == 'waiting admin') echo 'selected'; ?>>
              Waiting Admin</option>
            <option value="approved" <?php if ($country['indicators_step'] == 'approved') echo 'selected'; ?>>
              Approved</option>
          </select>
        </div>


        <!-- card_english_step -->
        <div class="form-group">
          <label for="country_cards_step_en">Card English Step Status</label>
          <select name="country_cards_step_en" id="country_cards_step_en" style="width: 100%;" class="select-input">
            <option value="not started"
              <?php if ($country['country_cards_step_en'] == 'not started') echo 'selected'; ?>>
              Not Started</option>
            <option value="waiting contact"
              <?php if ($country['country_cards_step_en'] == 'waiting contact') echo 'selected'; ?>>Waiting Contact
            </option>
            <option value="waiting admin"
              <?php if ($country['country_cards_step_en'] == 'waiting admin') echo 'selected'; ?>>Waiting Admin</option>
            <option value="approved" <?php if ($country['country_cards_step_en'] == 'approved') echo 'selected'; ?>>
              Approved</option>
          </select>
        </div>

        <div class="form-group">
          <label for="translation_step">Translation Step Status</label>
          <select name="translation_step" id="translation_step" style="width: 100%;" class="select-input">
            <option value="not started" <?php if ($country['translation_step'] == 'not started') echo 'selected'; ?>>
              Not
              Started</option>
            <option value="waiting contact"
              <?php if ($country['translation_step'] == 'waiting contact') echo 'selected'; ?>>Waiting Contact
            </option>
            <option value="waiting admin"
              <?php if ($country['translation_step'] == 'waiting admin') echo 'selected'; ?>>Waiting Admin</option>
            <option value="approved" <?php if ($country['translation_step'] == 'approved') echo 'selected'; ?>>
              Approved</option>
          </select>
        </div>

        <div class="form-group">
          <label for="country_cards_step">Card Translated Step Status</label>
          <select name="country_cards_step" id="country_cards_step" style="width: 100%;" class="select-input">
            <option value="not started" <?php if ($country['country_cards_step'] == 'not started') echo 'selected'; ?>>
              Not Started</option>
            <option value="waiting contact"
              <?php if ($country['country_cards_step'] == 'waiting contact') echo 'selected'; ?>>Waiting Contact
            </option>
            <option value="waiting admin"
              <?php if ($country['country_cards_step'] == 'waiting admin') echo 'selected'; ?>>Waiting Admin
            </option>
            <option value="approved" <?php if ($country['country_cards_step'] == 'approved') echo 'selected'; ?>>
              Approved</option>
          </select>
        </div>


      </div>
      <button class="btn-create" type="button" id="saveCountry">Confirm</button>
    </form>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
      © 2023 GoPA. All rights reserved.
    </p>
  </footer>

  <script>
  // initialize the translation step status based on the need translation checkbox
  let needTranslationYes = document.getElementById("yes").checked;
  let needTranslation = needTranslationYes ? true : false;

  let translationStep = document.getElementById("translation_step");
  let cardTranslatedStep = document.getElementById("country_cards_step");

  if (needTranslation) {
    translationStep.disabled = false;
    cardTranslatedStep.disabled = false;
  } else {
    translationStep.disabled = true;
    cardTranslatedStep.disabled = true;
  }


  // Update the translateion step status based on the need translation checkbox
  document.getElementById("need-translation").addEventListener("change", function() {
    console.log("change");
    let needTranslation = document.getElementById("yes").checked;
    let translationStep = document.getElementById("translation_step");
    let cardTranslatedStep = document.getElementById("country_cards_step");

    if (needTranslation) {
      translationStep.disabled = false;
      cardTranslatedStep.disabled = false;
    } else {
      translationStep.disabled = true;
      cardTranslatedStep.disabled = true;
    }
  });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script language="JavaScript" src="../../../scripts/md5.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>