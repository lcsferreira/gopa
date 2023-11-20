<?php
  $title = "National Policy";                   
  include "../../components/header.php";                 
?>
<?php
  function insertData($id, $title, $reference){
    include_once "../../../config/connection.php";
    $sql = "CALL InsertWithIncrement($id, $title, $reference)";
    $result = mysqli_query($connection, $sql);
  }
  //get id from url
  $id = $_GET['id'];
  //select the country of the id
  $sql = "SELECT indicators_step FROM countries WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $status = mysqli_fetch_assoc($result);
  
  $sql = "SELECT * FROM national_policy_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM national_policy_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM national_policy_values_contact WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $contact_values = mysqli_fetch_assoc($result);

  $sql = "SELECT * FROM national_policy_agreement WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $agreement_values = mysqli_fetch_assoc($result);

  $sql = "SELECT inc, title, reference FROM national_policy_titles_reference_admin WHERE id_country = $id";
  $result = mysqli_query($connection, $sql);
  $national_policy_titles_reference_admin = []; // Inicializa um array vazio

  while ($row = mysqli_fetch_assoc($result)) {
      $national_policy_titles_reference_admin[] = $row; // Adiciona cada linha ao array
  }

  $sql = "SELECT inc, title, reference FROM national_policy_titles_reference_contact WHERE id_country = $id";
  $result = mysqli_query($connection, $sql);
  $national_policy_titles_reference_contact = []; // Inicializa um array vazio

  while ($row = mysqli_fetch_assoc($result)) {
      $national_policy_titles_reference_contact[] = $row; // Adiciona cada linha ao array
  }

  $sql = "SELECT inc, title, reference FROM national_guideline_titles_reference_admin WHERE id_country = $id";
  $result = mysqli_query($connection, $sql);
  $national_guideline_titles_reference_admin = []; // Inicializa um array vazio

  while ($row = mysqli_fetch_assoc($result)) {
      $national_guideline_titles_reference_admin[] = $row; // Adiciona cada linha ao array
  }

  $sql = "SELECT inc, title, reference FROM national_guideline_titles_reference_contact WHERE id_country = $id";
  $result = mysqli_query($connection, $sql);
  $national_guideline_titles_reference_contact = []; // Inicializa um array vazio

  while ($row = mysqli_fetch_assoc($result)) {
      $national_guideline_titles_reference_contact[] = $row; // Adiciona cada linha ao array
  }
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
  <title>National Policy</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <?php 
      include_once "../../components/modalInfo.php";
    ?>
    <?php
      $page = "nationalPolicy";
      include "../../components/indicatorsNav.php";
      $page = "national-policy";
      include_once "../../components/modalDisplay.php";
    ?>
    <div class="title">
      <h1>National Policy <span onclick="showModalDisplay()"><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Review the indicators on the left and select the best option.</p>
    </div>
    <form>
      <?php 
        if($_SESSION['userType']=='contact' && $admin_values['different_value_source_1'] == 1){
          $show = "show";
          $indicator_name = "national_policy";
          $indicator_table_name = "national_policy";
          include("../../components/diffDataSource.php");
        }else if ($_SESSION['userType']=='admin' && $agreement_values['national_policy'] != 2) {
          $indicator_name = "national_policy";
          $indicator_table_name = "national_policy";
          include("../../components/diffDataSource.php");
        }
      ?>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            National physical activity policy/plan <span onclick="showModalInfo('national-pa-policy')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
              Physical activity plan created and endorsed by the government. The plan should not only endorse the
              benefits of achieving the recommended level of physical activity but should also encourage the promotion
              of physical activity and regularly monitor the prevalence of health promoting-physical activity.
            </p>
          </label>
          <div class="radio" id="radio-group">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-policy-admin" value="yes" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['national_policy'] == 1) {
                echo " checked";
              }
            ?> onclick="saveRadioValue('national-policy-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-policy-admin" value="no" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['national_policy'] == 0 && $admin_values['national_policy'] != null) {
                echo " checked";
              }
            ?> onclick="saveRadioValue('national-policy-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
          </div>

          <?php foreach ($national_policy_titles_reference_admin as $row): ?>
            <div class="title-reference">
              <label for="titulos[]">Title</label>
              <input type="text" id='title_<?php echo $row['inc']; ?>' name="titulos[]" value='<?php echo $row['title']; ?>' placeholder="Title" onBlur="insertData(<?php echo $id; ?>, this.value, document.getElementById('reference_<?php echo $row['inc']; ?>').value, <?php echo $row['inc']; ?>)" <?php if($_SESSION['userType'] != "admin"){
                echo " disabled";
              } ?>>
              <label for="referencias[]">Reference</label>
              <input type="text" id="reference_<?php echo $row['inc']; ?>" name="referencias[]" value="<?php echo $row['reference']; ?>" placeholder="Reference" onBlur="insertData(<?php echo $id; ?>, document.getElementById('title_<?php echo $row['inc']; ?>').value, this.value, <?php echo $row['inc']; ?>)" <?php if($_SESSION['userType'] != "admin"){
                echo " disabled";
              } ?>>
              <button <?php if($_SESSION['userType'] != "admin"){
                echo "style='display: none;'";
              } ?> type="button" class="delete-button" onclick="deleteData(<?php echo $id; ?>, <?php echo $row['inc']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
          <?php endforeach; ?>
          
          <div id="novos_campos"></div>
          <button type="button" class="add-button" id="adicionar_campo" <?php if($_SESSION['userType'] != "admin"){
                echo "style='display: none;'";
              } ?>>Add policy</button>
          
          <div class="form-input w-fix" id="embbed-prevention-field-admin">
            <label for="radio-group" class="mt-10">
              The policy/plan is for noncommunicable disease (NCD) prevention and Physical Activity is included <span onclick="showModalInfo('national-pa-policy')"><i
                class="fa fa-question-circle-o"></i></span>
            </label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="embbed-prevention-admin" value="yes" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if ($admin_values['embbed_prevention'] == 1) {
                  echo "checked";
                }
                ?> onclick="saveRadioValue('embbed-prevention-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
              <label for="no">No</label>
              <input type="radio" id="no" name="embbed-prevention-admin" value="no" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if ($admin_values['embbed_prevention'] == 0 && $admin_values['embbed_prevention'] != null) {
                  echo "checked";
                }
                ?> onclick="saveRadioValue('embbed-prevention-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
            </div>
          </div>
          <div class="form-input w-fix" id="standalone-prevention-field-admin">
            <label for="radio-group">
              The policy/plan is standalone for Physical Activity (i.e., exclusively dedicated to physical activity) <span onclick="showModalInfo('national-pa-policy')"><i
                class="fa fa-question-circle-o"></i></span>
            </label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="standalone-prevention-admin" value="yes" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['standalone_prevention'] == 1) {
                echo "checked";
              }
              ?> onclick="saveRadioValue('standalone-prevention-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
              <label for="no">No</label>
              <input type="radio" id="no" name="standalone-prevention-admin" value="no" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['standalone_prevention'] == 0 && $admin_values['standalone_prevention'] != null) {
                echo "checked";
              }
              ?> onclick="saveRadioValue('standalone-prevention-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
            </div>
          </div>
          <?php 
            if($_SESSION['userType'] == "admin"){
              $input_option = 1;
              $indicator_name = "national_policy";
              $indicator_table_name = "national_policy";
              include("../../components/differentValueSource.php");
            } 
          ?>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 1;
            $indicator_name = "national_policy";
            $indicator_table_name = "national_policy";
            include("../../components/agreementInput.php") 
          ?>
        <div class="contact-input" id="national-policy-indicator">
          <div class="form-input">
            <p>Provide the new information here: </p>
            <label for="radio-group">
              National physical activity policy/plan
            </label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="national-policy" value="yes" <?php 
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if ($contact_values['national_policy'] == 1) {
                  echo "checked";
                }
              ?> onclick="saveRadioValue('national-policy',  '<?php echo $id ?>', 'national_policy_values_contact')">
              <label for="no">No</label>
              <input type="radio" id="no" name="national-policy" value="no" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
                if ($contact_values['national_policy'] == 0 && $contact_values['national_policy'] != null) {
                  echo "checked";
                }
              ?> onclick="saveRadioValue('national-policy',  '<?php echo $id ?>', 'national_policy_values_contact')">
            </div>

            <?php foreach ($national_policy_titles_reference_contact as $row): ?>
            <div class="title-reference">
              <label for="titulos[]">Title</label>
              <input type="text" id='contact_title_<?php echo $row['inc']; ?>' name="titulos[]" value='<?php echo $row['title']; ?>' placeholder="Title" onBlur="insertDataContact(<?php echo $id; ?>, this.value, document.getElementById('contact_reference_<?php echo $row['inc']; ?>').value, <?php echo $row['inc']; ?>)" <?php if($_SESSION['userType'] == "admin"){
                echo " disabled";
              } ?>>
              <label for="referencias[]">Reference</label>
              <input type="text" id="contact_reference_<?php echo $row['inc']; ?>" name="referencias[]" value="<?php echo $row['reference']; ?>" placeholder="Reference" onBlur="insertDataContact(<?php echo $id; ?>, document.getElementById('contact_title_<?php echo $row['inc']; ?>').value, this.value, <?php echo $row['inc']; ?>)" <?php if($_SESSION['userType'] == "admin"){
                echo " disabled";
              } ?>>
              <button <?php if($_SESSION['userType'] == "admin"){
                echo "style='display: none;'";
              } ?> type="button" class="delete-button" onclick="deleteDataContact(<?php echo $id; ?>, <?php echo $row['inc']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
          <?php endforeach; ?>
          
          <div id="novos_campos_contact"></div>
          <button type="button" class="add-button" id="adicionar_campo_contact" <?php if($_SESSION['userType'] == "admin"){
                echo "style='display: none;'";
              } ?>>Add policy</button>

            <div class="form-input w-100" id="embbed-prevention-field">
              <label for="radio-group" class="mt-10">
                The policy/plan is for noncommunicable disease (NCD) prevention and Physical Activity is included
              </label>
              <div class="radio" id="radio-group">
                <label for="yes">Yes</label>
                <input type="radio" id="yes" name="embbed-prevention" value="yes" <?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if ($contact_values['embbed_prevention'] == 1) {
                    echo "checked";
                  }
                  ?> onclick="saveRadioValue('embbed-prevention',  '<?php echo $id ?>', 'national_policy_values_contact')">
                <label for="no">No</label>
                <input type="radio" id="no" name="embbed-prevention" value="no" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
                  if ($contact_values['embbed_prevention'] == 0 && $contact_values['embbed_prevention'] != null) {
                    echo "checked";
                  }
                  ?> onclick="saveRadioValue('embbed-prevention',  '<?php echo $id ?>', 'national_policy_values_contact')">
              </div>
            </div>
            <div class="form-input w-100" id="standalone-prevention-field">
              <label for="radio-group">
                The policy/plan is standalone for Physical Activity (i.e., exclusively dedicated to physical activity)
              </label>
              <div class="radio" id="radio-group">
                <label for="yes">Yes</label>
                <input type="radio" id="yes" name="standalone-prevention" value="yes" <?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if ($contact_values['standalone_prevention'] == 1) {
                    echo "checked";
                  }
                ?> onclick="saveRadioValue('standalone-prevention',  '<?php echo $id ?>', 'national_policy_values_contact')">
                <label for="no">No</label>
                <input type="radio" id="no" name="standalone-prevention" value="no" <?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if ($contact_values['standalone_prevention'] == 0 && $contact_values['standalone_prevention'] != null) {
                    echo "checked";
                  }
                ?> onclick="saveRadioValue('standalone-prevention',  '<?php echo $id ?>', 'national_policy_values_contact')">
              </div>
            </div>
          </div>
          </div>
        </div>
        <?php
          $indicator_name = "national_policy";
          $indicator_table_name = "national_policy";
          include("../../components/commentInput.php")
        ?>
      </div>
      <?php 
        if($_SESSION['userType']=='contact' && $admin_values['different_value_source_2'] == 1){
          $show = "show";
          $indicator_name = "national_recommendations";
          $indicator_table_name = "national_policy";
          include("../../components/diffDataSource.php");
        }
        else if ($_SESSION['userType']=='admin' && $agreement_values['national_recommendations'] != 2) {
          $indicator_name = "national_recommendations";
          $indicator_table_name = "national_policy";
          include("../../components/diffDataSource.php");
        }
      ?>
      <div class="indicators">
        <div class="form-input">
          <label for="radio-group">
            National physical activity guidelines <span onclick="showModalInfo('national-guidelines')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
            National recommendations are an official consensus statement issued by a governmental body and/or endorsed by the government. Physical activity recommendations typically state how much physical activity is required for health benefits, while sedentary behavior recommendations typically suggest strategies for reducing prolonged periods of sitting.
            </p>
          </label>
          <div class="radio" id="radio-group">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-recommendations-admin" value="yes" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['national_recommendations'] == 1) {
                echo "checked";
              }
            ?>
              onclick="saveRadioValue('national-recommendations-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-recommendations-admin" value="no" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
            } 
              if ($admin_values['national_recommendations'] == 0 && $admin_values['national_recommendations'] != null) {
                echo "checked";
              }
            ?>
              onclick="saveRadioValue('national-recommendations-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
          </div>
          <?php foreach ($national_guideline_titles_reference_admin as $row): ?>
            <div class="title-reference">
              <label for="titulos[]">Title</label>
              <input type="text" id='guideline_title_<?php echo $row['inc']; ?>' name="titulos[]" value='<?php echo $row['title']; ?>' placeholder="Title" onBlur="insertGuidelineData(<?php echo $id; ?>, this.value, document.getElementById('guideline_reference_<?php echo $row['inc']; ?>').value, <?php echo $row['inc']; ?>)" <?php if($_SESSION['userType'] != "admin"){
                echo " disabled";
              } ?>>
              <label for="referencias[]">Reference</label>
              <input type="text" id="guideline_reference_<?php echo $row['inc']; ?>" name="referencias[]" value="<?php echo $row['reference']; ?>" placeholder="Reference" onBlur="insertGuidelineData(<?php echo $id; ?>, document.getElementById('guideline_title_<?php echo $row['inc']; ?>').value, this.value, <?php echo $row['inc']; ?>)" <?php if($_SESSION['userType'] != "admin"){
                echo " disabled";
              } ?>>
              <button <?php if($_SESSION['userType'] != "admin"){
                echo "style='display: none;'";
              } ?> type="button" class="delete-button" onclick="deleteGuidelineData(<?php echo $id; ?>, <?php echo $row['inc']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
          <?php endforeach; ?>
          
          <div id="novos_campos_guideline"></div>
          <button type="button" class="add-button" id="adicionar_campo_guideline" <?php if($_SESSION['userType'] != "admin"){
                echo "style='display: none;'";
              } ?>>Add guideline</button>
          <?php 
            if($_SESSION['userType'] == "admin"){
              $input_option = 2;
              $indicator_name = "national_recommendations";
              $indicator_table_name = "national_policy";
              include("../../components/differentValueSource.php");
            } 
          ?>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 2;
            $indicator_name = "national_recommendations";
            $indicator_table_name = "national_policy";
            include("../../components/agreementInput.php") 
          ?>
        <div class="contact-input" id="national-recommendations-indicator">
          <div class="form-input">
            <p>Provide the new information here: </p>
            <label for="groups">
              National physical activity guidelines
            </label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="national-recommendations" value="yes" <?php 
                if ($contact_values['national_recommendations'] == 1) {
                  echo " checked ";
                }
                if($_SESSION['userType'] == "admin"){
                  echo " disabled ";
                }
              ?>
                onclick="saveRadioValue('national-recommendations',  '<?php echo $id ?>', 'national_policy_values_contact')">
              <label for="no">No</label>
              <input type="radio" id="no" name="national-recommendations" value="no" <?php 
                if ($contact_values['national_recommendations'] == 0 && $contact_values['national_recommendations'] != null) {
                  echo " checked ";
                }
                if($_SESSION['userType'] == "admin"){
                  echo " disabled ";
                }
              ?>
                onclick="saveRadioValue('national-recommendations',  '<?php echo $id ?>', 'national_policy_values_contact')">
            </div>
              <?php foreach ($national_guideline_titles_reference_contact as $row): ?>
                <div class="title-reference">
                  <label for="titulos[]">Title</label>
                  <input type="text" id='guideline_contact_title_<?php $row['inc']; ?>' name="titulos[]" value='<?php echo $row['title']; ?>' placeholder="Title" onBlur="insertGuidelineContactData(<?php echo $id; ?>, this.value, document.getElementById('guideline_contact_reference_<?php echo $row['inc']; ?>').value, <?php echo $row['inc']; ?>)" <?php if($_SESSION['userType'] == "admin"){
                    echo "disabled";
                  } ?>>
                  <label for="referencias[]">Reference</label>
                  <input type="text" id="guideline_contact_reference_<?php echo $row['inc']; ?>" name="referencias[]" value="<?php echo $row['reference']; ?>" placeholder="Reference" onBlur="insertGuidelineContactData(<?php echo $id; ?>, document.getElementById('guideline_contact_title_<?php echo $row['inc']; ?>').value, this.value, <?php echo $row['inc']; ?>)" <?php if($_SESSION['userType'] == "admin"){
                    echo "disabled";
                  } ?>>
                  <button <?php if($_SESSION['userType'] == "admin"){
                    echo "style='display: none;'";
                  } ?> type="button" class="delete-button" onclick="deleteGuidelineContactData(<?php echo $id; ?>, <?php echo $row['inc']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
              <?php endforeach; ?>
          
            <div id="novos_campos_guideline_contact"></div>
            <button type="button" class="add-button" id="adicionar_campo_guideline_contact" <?php if($_SESSION['userType'] == "admin"){
                  echo "style='display: none;'";
                } ?>>Add guideline</button>
          </div>
          </div>
        </div>
        <?php
          $indicator_name = "national_recommendations";
          $indicator_table_name = "national_policy";
          include("../../components/commentInput.php")
        ?>
      </div>
      <?php 
        if($_SESSION['userType']=='contact' && $admin_values['different_value_source_3'] == 1){
          $show = "show";
          $indicator_name = "policy_implementation";
          $indicator_table_name = "national_policy";
          include("../../components/diffDataSource.php");
        }else if ($_SESSION['userType']=='admin' && $agreement_values['policy_implementation'] != 2) {
          $indicator_name = "policy_implementation";
          $indicator_table_name = "national_policy";
          include("../../components/diffDataSource.php");
        }
      ?>
      <!-- <div class="indicators">
        <div class="form-input">
          <label for="policy-implementation-admin">
            Level of policy implementation <span class="new">*new*</span> <span onclick="showModalInfo('policy-implementation')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
              Policy implementation includes translating statements, ideas, goals, and/or objectives mentioned in the
              policy documents into practice.
            </p>
          </label>
          <input type="number" name="policy-implementation-admin" id="policy-implementation-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['policy_implementation'] != null){
                echo "value='" . $admin_values['policy_implementation']."'";
              }
          ?> onblur="saveValueByAdmin('policy-implementation', '<?php echo $id ?>', 'national_policy_values_admin')">
          <?php 
            if($_SESSION['userType'] == "admin"){
              $input_option = 3;
              $indicator_name = "policy_implementation";
              $indicator_table_name = "national_policy";
              include("../../components/differentValueSource.php");
            } 
          ?>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 3;
            $indicator_name = "policy_implementation";
            $indicator_table_name = "national_policy";
            include("../../components/agreementInput.php") 
          ?>
        <div class="contact-input" id="policy-implementation-indicator">
          <?php
            $indicator_type = "number";
            $indicator_title = "Level of policy implementation";
            $indicator_name = "policy_implementation";
            $indicator_table_name = "national_policy_values_contact";
            include("../../components/contactInput.php")
          ?>
          </div>
        </div>
        <?php
          $indicator_name = "policy_implementation";
          $indicator_table_name = "national_policy";
          include("../../components/commentInput.php")
        ?>
      </div> -->
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `nationalSurveillance.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `research.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
  <script>
    document.getElementById("adicionar_campo").addEventListener("click", function() {
      var existingTitleInputs = document.querySelectorAll('input[id^="title_"]');
      var newTitleId = existingTitleInputs.length + 1;
      console.log(newTitleId);
      var novosCampos = document.getElementById("novos_campos");
      var newFieldContainer = document.createElement("div");
      newFieldContainer.className = "title-reference";

      var newLabelTitle = document.createElement("label");
      newLabelTitle.setAttribute("for", "novos_titulos[]");
      newLabelTitle.textContent = "Title";

      var newInputTitle = document.createElement("input");
      newInputTitle.type = "text";
      newInputTitle.name = "novos_titulos[]";
      newInputTitle.placeholder = "Title";
      newInputTitle.id = "title_" + newTitleId;
      newInputTitle.onblur = function() {
          insertData(<?php echo $id; ?>, this.value, document.getElementById("reference_" + newTitleId).value, newTitleId);
      };

      var newLabelReference = document.createElement("label");
      newLabelReference.setAttribute("for", "novas_referencias[]");
      newLabelReference.textContent = "Reference";

      var newInputReference = document.createElement("input");
      newInputReference.type = "text";
      newInputReference.name = "novas_referencias[]";
      newInputReference.placeholder = "Reference";
      newInputReference.id = "reference_" + newTitleId;
      newInputReference.onblur = function() {
          console.log(newTitleId);
          insertData(<?php echo $id; ?>, document.getElementById('title_'+newTitleId).value, this.value, newTitleId);
      };

      var newDeleteButton = document.createElement("button");
      newDeleteButton.type = "button";
      newDeleteButton.className = "delete-button";
      newDeleteButton.onclick = function() {
          deleteData(<?php echo $id; ?>, newTitleId);
      };
      var newDeleteIcon = document.createElement("i");
      newDeleteIcon.className = "fa fa-trash";
      newDeleteButton.appendChild(newDeleteIcon);

      newFieldContainer.appendChild(newLabelTitle);
      newFieldContainer.appendChild(newInputTitle);
      newFieldContainer.appendChild(newLabelReference);
      newFieldContainer.appendChild(newInputReference);
      newFieldContainer.appendChild(newDeleteButton);

      novosCampos.appendChild(newFieldContainer);
    });

    document.getElementById("adicionar_campo_guideline").addEventListener("click", function() {
      var existingTitleInputs = document.querySelectorAll('input[id^="guideline_title_"]');
      var newTitleId = existingTitleInputs.length + 1;
      var novosCampos = document.getElementById("novos_campos_guideline");
      var newFieldContainer = document.createElement("div");
      newFieldContainer.className = "title-reference";

      var newLabelTitle = document.createElement("label");
      newLabelTitle.setAttribute("for", "novos_titulos_guideline[]");
      newLabelTitle.textContent = "Title";

      var newInputTitle = document.createElement("input");
      newInputTitle.type = "text";
      newInputTitle.name = "novos_titulos_guideline[]";
      newInputTitle.placeholder = "Title";
      newInputTitle.id = "guideline_title_" + newTitleId;
      newInputTitle.onblur = function() {
          insertGuidelineData(<?php echo $id; ?>, this.value, document.getElementById("guideline_reference_" + newTitleId).value, newTitleId);
      };

      var newLabelReference = document.createElement("label");
      newLabelReference.setAttribute("for", "novas_referencias_guideline[]");
      newLabelReference.textContent = "Reference";

      var newInputReference = document.createElement("input");
      newInputReference.type = "text";
      newInputReference.name = "novas_referencias_guideline[]";
      newInputReference.placeholder = "Reference";
      newInputReference.id = "guideline_reference_" + newTitleId;
      newInputReference.onblur = function() {
          insertGuidelineData(<?php echo $id; ?>, document.getElementById('guideline_title_'+newTitleId).value, this.value, newTitleId);
      };

      var newDeleteButton = document.createElement("button");
      newDeleteButton.type = "button";
      newDeleteButton.className = "delete-button";
      newDeleteButton.onclick = function() {
          deleteGuidelineData(<?php echo $id; ?>, newTitleId);
      };
      var newDeleteIcon = document.createElement("i");
      newDeleteIcon.className = "fa fa-trash";
      newDeleteButton.appendChild(newDeleteIcon);

      newFieldContainer.appendChild(newLabelTitle);
      newFieldContainer.appendChild(newInputTitle);
      newFieldContainer.appendChild(newLabelReference);
      newFieldContainer.appendChild(newInputReference);
      newFieldContainer.appendChild(newDeleteButton);

      novosCampos.appendChild(newFieldContainer);
    });

    document.getElementById("adicionar_campo_contact").addEventListener("click", function() {
      var existingTitleInputs = document.querySelectorAll('input[id^="contact_title_"]');
      var newTitleId = existingTitleInputs.length + 1;
      var novosCampos = document.getElementById("novos_campos_contact");
      var newFieldContainer = document.createElement("div");
      newFieldContainer.className = "title-reference";

      var newLabelTitle = document.createElement("label");
      newLabelTitle.setAttribute("for", "novos_titulos_contact[]");
      newLabelTitle.textContent = "Title";

      var newInputTitle = document.createElement("input");
      newInputTitle.type = "text";
      newInputTitle.name = "novos_titulos_contact[]";
      newInputTitle.placeholder = "Title";
      newInputTitle.id = "contact_title_" + newTitleId;
      newInputTitle.onblur = function() {
          insertDataContact(<?php echo $id; ?>, this.value, document.getElementById("contact_reference_" + newTitleId).value, newTitleId);
      };

      var newLabelReference = document.createElement("label");
      newLabelReference.setAttribute("for", "novas_referencias_contact[]");
      newLabelReference.textContent = "Reference";

      var newInputReference = document.createElement("input");
      newInputReference.type = "text";
      newInputReference.name = "novas_referencias_contact[]";
      newInputReference.placeholder = "Reference";
      newInputReference.id = "contact_reference_" + newTitleId;
      newInputReference.onblur = function() {
          insertDataContact(<?php echo $id; ?>, document.getElementById('contact_title_'+newTitleId).value, this.value, newTitleId);
      };

      var newDeleteButton = document.createElement("button");
      newDeleteButton.type = "button";
      newDeleteButton.className = "delete-button";
      newDeleteButton.onclick = function() {
          deleteDataContact(<?php echo $id; ?>, newTitleId);
      };
      var newDeleteIcon = document.createElement("i");
      newDeleteIcon.className = "fa fa-trash";
      newDeleteButton.appendChild(newDeleteIcon);

      newFieldContainer.appendChild(newLabelTitle);
      newFieldContainer.appendChild(newInputTitle);
      newFieldContainer.appendChild(newLabelReference);
      newFieldContainer.appendChild(newInputReference);
      newFieldContainer.appendChild(newDeleteButton);

      novosCampos.appendChild(newFieldContainer);
    });

    document.getElementById("adicionar_campo_guideline_contact").addEventListener("click", function() {
      var existingTitleInputs = document.querySelectorAll('input[id^="guideline_contact_title_"]');
      var newTitleId = existingTitleInputs.length + 1;
      var novosCampos = document.getElementById("novos_campos_guideline_contact");
      var newFieldContainer = document.createElement("div");
      newFieldContainer.className = "title-reference";

      var newLabelTitle = document.createElement("label");
      newLabelTitle.setAttribute("for", "novos_titulos_guideline_contact[]");
      newLabelTitle.textContent = "Title";

      var newInputTitle = document.createElement("input");
      newInputTitle.type = "text";
      newInputTitle.name = "novos_titulos_guideline_contact[]";
      newInputTitle.placeholder = "Title";
      newInputTitle.id = "guideline_contact_title_" + newTitleId;
      newInputTitle.onblur = function() {
          insertGuidelineContactData(<?php echo $id; ?>, this.value, document.getElementById("guideline_contact_reference_" + newTitleId).value, newTitleId);
      };

      var newLabelReference = document.createElement("label");
      newLabelReference.setAttribute("for", "novas_referencias_guideline_contact[]");
      newLabelReference.textContent = "Reference";

      var newInputReference = document.createElement("input");
      newInputReference.type = "text";
      newInputReference.name = "novas_referencias_guideline_contact[]";
      newInputReference.placeholder = "Reference";
      newInputReference.id = "guideline_contact_reference_" + newTitleId;
      newInputReference.onblur = function() {
          insertGuidelineContactData(<?php echo $id; ?>, document.getElementById('guideline_contact_title_'+newTitleId).value, this.value, newTitleId);
      };

      var newDeleteButton = document.createElement("button");
      newDeleteButton.type = "button";
      newDeleteButton.className = "delete-button";
      newDeleteButton.onclick = function() {
          deleteGuidelineContactData(<?php echo $id; ?>, newTitleId);
      };
      var newDeleteIcon = document.createElement("i");
      newDeleteIcon.className = "fa fa-trash";
      newDeleteButton.appendChild(newDeleteIcon);

      newFieldContainer.appendChild(newLabelTitle);
      newFieldContainer.appendChild(newInputTitle);
      newFieldContainer.appendChild(newLabelReference);
      newFieldContainer.appendChild(newInputReference);
      newFieldContainer.appendChild(newDeleteButton);

      novosCampos.appendChild(newFieldContainer);
    });
  </script>
</body>

</html>