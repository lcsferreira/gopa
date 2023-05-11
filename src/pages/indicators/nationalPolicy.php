<?php
  $title = "National Policy";                   
  include "../../components/header.php";                 
?>
<?php
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
            National physical activity policy/plan <span onclick="showModalInfo('pa-policy-year')"><i
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
          <label for="national-policy-titles-admin">Title(s)</label>
          <textarea style="height: 104px;" name="national-policy-titles-admin" id="national-policy-titles-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
          ?> onblur="saveValueByAdmin('national-policy-titles', '<?php echo $id ?>', 'national_policy_values_admin')"><?php 
              if($admin_values['national_policy_titles'] != null){
                echo $admin_values['national_policy_titles'];
              }
          ?></textarea>
          <label for="reference" class="mt-10">Reference</label>
          <textarea style="height: 104px;" name="national-policy-reference-admin" id="national-policy-reference-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
          ?>
            onblur="saveValueByAdmin('national-policy-reference', '<?php echo $id ?>', 'national_policy_values_admin')"><?php 
              if($admin_values['national_policy_reference'] != null){
                echo $admin_values['national_policy_reference'];
              }
          ?></textarea>
          <div class="form-input w-fix" id="embbed-prevention-field-admin">
            <label for="radio-group" class="mt-10">
              The policy/plan is for noncommunicable disease (NCD) prevention and Physical Activity is included
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
              The policy/plan is standalone for Physical Activity (i.e., exclusively dedicated to physical activity)
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
            <label for="national-policy-titles">Title(s)</label>
            <textarea style="height: 104px;" name="national-policy-titles" id="national-policy-titles" <?php 
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
            ?>
              onblur="saveValueByContact('national-policy-titles', '<?php echo $id ?>', 'national_policy_values_contact')"><?php 
                if($_SESSION['userType'] != "admin"){
                  echo $contact_values['national_policy_titles'];
                }
              ?></textarea>
            <label for="national-policy-reference" class="mt-10">Reference</label>
            <textarea style="height: 104px;" name="national-policy-reference" id="national-policy-reference" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                } 
            ?>
              onblur="saveValueByContact('national-policy-reference', '<?php echo $id ?>', 'national_policy_values_contact')"><?php 
                if($_SESSION['userType'] != "admin"){
                  echo $contact_values['national_policy_reference'];
                }
              ?></textarea>
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
          <?php
            $indicator_name = "national_policy";
            $indicator_table_name = "national_policy";
            include("../../components/commentInput.php")
          ?>
          </div>
        </div>
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
          <label for="national-recommendations-reference-admin">Reference</label>
          <input type="text" name="national-recommendations-reference-admin" id="national-recommendations-reference-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['national_recommendations_reference'] != null){
                echo "value='" . $admin_values['national_recommendations_reference']."'";
              }
          ?>
            onblur="saveValueByAdmin('national-recommendations-reference', '<?php echo $id ?>', 'national_policy_values_admin')">
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
                  echo "checked";
                }
              ?>
                onclick="saveRadioValue('national-recommendations',  '<?php echo $id ?>', 'national_policy_values_contact')">
              <label for="no">No</label>
              <input type="radio" id="no" name="national-recommendations" value="no" <?php 
                if ($contact_values['national_recommendations'] == 0 && $contact_values['national_recommendations'] != null) {
                  echo "checked";
                }
              ?>
                onclick="saveRadioValue('national-recommendations',  '<?php echo $id ?>', 'national_policy_values_contact')">
            </div>
            <label for="reference">Reference</label>
            <input type="text" name="national-recommendations-reference" id="national-recommendations-reference" <?php 
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['national_recommendations_reference'] != null){
                  echo "value=" . $contact_values['national_recommendations_reference']."'";
                }
            ?>
              onblur="saveValueByContact('national-recommendations-reference', '<?php echo $id ?>', 'national_policy_values_contact')">
          </div>
          <?php
            $indicator_name = "national_recommendations";
            $indicator_table_name = "national_policy";
            include("../../components/commentInput.php")
          ?>
          </div>
        </div>
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
      <div class="indicators">
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
          <?php
            $indicator_name = "policy_implementation";
            $indicator_table_name = "national_policy";
            include("../../components/commentInput.php")
          ?>
          </div>
        </div>
      </div>
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
</body>

</html>