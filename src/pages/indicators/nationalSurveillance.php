<?php
  $title = "National Surveillance";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  $sql = "SELECT * FROM national_surveillance_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM national_surveillance_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM national_surveillance_values_contact WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $contact_values = mysqli_fetch_assoc($result);
  $sql = "SELECT * FROM national_surveillance_agreement WHERE id = $id";
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
  <title>National Surveillance</title>
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
      $page = "nationalSurveillance";
      include "../../components/indicatorsNav.php";
      $page = "national-surveillance";
      include_once "../../components/modalDisplay.php";
    ?>
    <div class="title">
      <h1>National Surveillance <span onclick="showModalDisplay()"><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Review the indicators on the left and select the best option.</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="national-surveys-admin">
            National survey(s) including physical activity questions <span onclick="showModalInfo('national-survey')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
              Surveys at the national level that cover physical activity at work/in the household, for transport, and
              during leisure time. Surveys should include a representative sample of the entire population or, in some
              cases, a clearly defined geographic segment of the population.
            </p>
          </label>
          <div class="radio" id="national-surveys-admin">
            <label for="yes">Yes</label>
            <input type="radio" id="yes-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['national_surveys'] == 1) {
                echo "checked";
              }
            ?> name="national-surveys-admin"
              onblur="saveRadioValue('national-surveys-admin',  '<?php echo $id ?>', 'national_surveillance_values_admin')"
              value="yes">
            <label for="no">No</label>
            <input type="radio" id="no-admin" <?php 
              if ($admin_values['national_surveys'] == 0 && $admin_values['national_surveys'] != null) {
                echo "checked ";
              }
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
            ?> name="national-surveys-admin"
              onblur="saveRadioValue('national-surveys-admin',  '<?php echo $id ?>', 'national_surveillance_values_admin')"
              value="no">
          </div>
          <?php 
            if($_SESSION['userType'] == "admin"){
              $input_option = 1;
              $indicator_table_name = "national_surveillance";
              include("../../components/differentValueSource.php");
            } 
          ?>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 1;
            $indicator_name = "national_surveys";
            $indicator_table_name = "national_surveillance";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="national-surveys-indicator">
            <div class="form-input">
            <p>Provide the new information here: </p>
              <label for="national-surveys">
                National survey(s) including physical activity questions
              </label>
              <div class="radio" id="national-surveys">
                <label for="yes">Yes</label>
                <input type="radio" id="yes" <?php 
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if ($contact_values['national_surveys'] == 1) {
                  echo "checked";
                }
                ?> name="national-surveys" value="yes"
                onblur="saveRadioValue('national-surveys',  '<?php echo $id ?>', 'national_surveillance_values_contact')">
                <label for="no">No</label>
                <input type="radio" id="no" <?php 
                if ($contact_values['national_surveys'] == 0 && $contact_values['national_surveys'] != null) {
                  echo "checked ";
                }
                if($_SESSION['userType'] == "admin"){
                  echo "disabled";
                }
                ?> name="national-surveys" value="no"
                onblur="saveRadioValue('national-surveys',  '<?php echo $id ?>', 'national_surveillance_values_contact')">
              </div>
            </div>
            <?php
              $diff_input = "1";
              $indicator_name = "national_surveys";
              $indicator_table_name = "national_surveillance";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="most-recent-year-admin">Most recent (Year)</label>
          <textarea style="height: 104px;"name="most-recent-year-admin"
            onblur="saveValueByAdmin('most-recent-year', '<?php echo $id ?>', 'national_surveillance_values_admin')"
            id="most-recent-year-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }  
          ?>><?php if($admin_values['most_recent_year'] != null){
            echo $admin_values['most_recent_year'];
          }?></textarea>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 2;
            $indicator_name = "most_recent_year";
            $indicator_table_name = "national_surveillance";
            include("../../components/agreementInput.php") 
          ?>
        <div class="contact-input" id="most-recent-year-indicator">
          <div class="form-input">
          <p>Provide the new information here: </p>
            <label for="most-recent-year">Most recent (Year)</label>
            <textarea style="height: 104px;" 
              onblur="saveValueByContact('most-recent-year', '<?php echo $id ?>', 'national_surveillance_values_contact')"
              name="most-recent-year" id="most-recent-year" <?php 
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
            ?>><?php if($contact_values['most_recent_year'] != null){
              echo $contact_values['most_recent_year'];
            }?></textarea>
          </div>
            <?php
              $indicator_name = "most_recent_year";
              $indicator_table_name = "national_surveillance";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="next-year-admin">Next (Year)</label>
          <textarea style="height: 104px;" name="next-year-admin"
            onblur="saveValueByAdmin('next-year', '<?php echo $id ?>', 'national_surveillance_values_admin')"
            id="next-year-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
          ?>><?php if($admin_values['next_year'] != null){
            echo $admin_values['next_year'];
          }?></textarea>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 3;
            $indicator_name = "next_year";
            $indicator_table_name = "national_surveillance";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="next-year-indicator">
            <div class="form-input">
              <p>Provide the new information here: </p>
              <label for="next-year">Next (Year)</label>
              <textarea style="height: 104px;" name="next-year"
              onblur="saveValueByContact('next-year', '<?php echo $id ?>', 'national_surveillance_values_contact')"
              id="next-year" <?php 
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                ?>><?php if($contact_values['next_year'] != null){
                  echo $contact_values['next_year'];
                }?></textarea>
              </div>
            <?php
              $indicator_name = "next_year";
              $indicator_table_name = "national_surveillance";
              include("../../components/commentInput.php")
            ?>
            </div>
          </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="survey-tool-admin">
            Surveillance tool (National survey, STEPS WHO, Eurobarometer, NHANES, NHIS, BRFSS, or other)
          </label>
          <textarea style="height: 104px;" name="survey-tool" id="survey-tool-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
          ?> onblur="saveValueByAdmin('survey-tool', '<?php echo $id ?>', 'national_surveillance_values_admin')"><?php 
              if($admin_values['survey_tool'] != null){
                echo $admin_values['survey_tool'];
              }
          ?></textarea>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 4;
            $indicator_name = "survey_tool";
            $indicator_table_name = "national_surveillance";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="survey-tool-indicator">
            <div class="form-input">
              <p>Provide the new information here: </p>
              <label for="survey-tool">
                Surveillance tool (National survey, STEPS WHO, Eurobarometer, NHANES, NHIS, BRFSS, or other)
              </label>
              <textarea style="height: 104px;" name="survey-tool" id="survey-tool"
                onblur="saveValueByContact('survey-tool', '<?php echo $id ?>', 'national_surveillance_values_contact')" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
              ?>><?php 
                  if($contact_values['survey_tool'] != null){
                    echo $contact_values['survey_tool'];
                  }
              ?></textarea>
            </div>
            <?php
              $indicator_name = "survey_tool";
              $indicator_table_name = "national_surveillance";
              include("../../components/commentInput.php")
            ?>
          </div>    
        </div>
      </div>

      <div class="indicators">
        <div class="form-input">
          <label for="survey-instrument-admin">
            Instrument (GPAQ, IPAQ, adapted GPAQ, RPAQ, short IPAQ, other)
          </label>
          <textarea style="height: 104px;" name="survey-instrument" id="survey-instrument-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
          ?> onblur="saveValueByAdmin('survey-instrument', '<?php echo $id ?>', 'national_surveillance_values_admin')"><?php 
              if($admin_values['survey_instrument'] != null){
                echo $admin_values['survey_instrument'];
              }
          ?></textarea>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 5;
            $indicator_name = "survey_instrument";
            $indicator_table_name = "national_surveillance";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="survey-instrument-indicator">
            <div class="form-input">
              <p>Provide the new information here: </p>
              <label for="survey-instrument">
                Instrument (GPAQ, IPAQ, adapted GPAQ, RPAQ, short IPAQ, other)
              </label>
              <textarea style="height:104px;" name="survey-instrument" id="survey-instrument"
                onblur="saveValueByContact('survey-instrument', '<?php echo $id ?>', 'national_surveillance_values_contact')" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
              ?>><?php 
                  if($contact_values['survey_instrument'] != null){
                    echo $contact_values['survey_instrument'];
                  }
              ?></textarea>
            </div>
            <?php
              $indicator_name = "survey_instrument";
              $indicator_table_name = "national_surveillance";
              include("../../components/commentInput.php")
            ?>
          </div>    
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="objective-measures-admin">
          The country has collected national/subnational physical activity data using objective measures <span class="new">*new*</span> <span onclick="showModalInfo('objective-measures')"><i
                class="fa fa-question-circle-o"></i></span>
          </label>
          <div class="radio" id="objective-measures-admin">
            <label for="yes">Yes</label>
            <input type="radio" id="yes-admin" name="objective-measures-admin" value="yes" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['objective_measures'] == 1) {
                echo "checked";
              }?>
              onblur="saveRadioValue('objective-measures-admin',  '<?php echo $id ?>', 'national_surveillance_values_admin')">
            <label for="no">No</label>
            <input type="radio" id="no-admin" name="objective-measures-admin" value="no" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['objective_measures'] == 0 && $admin_values['objective_measures'] != null) {
                echo "checked";
              }?>
              onblur="saveRadioValue('objective-measures-admin',  '<?php echo $id ?>', 'national_surveillance_values_admin')">
          </div>
          <label for="devices-used">Devices that were used (Name)</label>
          <textarea style="height: 104px;" name="devices-used-admin" id="devices-used-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
          ?>
            onblur="saveValueByAdmin('devices-used', '<?php echo $id ?>', 'national_surveillance_values_admin')"><?php 
              if($admin_values['devices_used'] != null){
                echo $admin_values['devices_used'];
              }
          ?></textarea>
          <label for="devices-used-reference">Reference</label>
          <textarea style="height: 104px;" name="devices-used-reference-admin" id="devices-used-reference-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
          ?>
            onblur="saveValueByAdmin('devices-used-reference', '<?php echo $id ?>', 'national_surveillance_values_admin')"><?php 
              if($admin_values['devices_used_reference'] != null){
                echo $admin_values['devices_used_reference'];
              }
          ?></textarea>
          <!-- <label for="estimates" class="mt-10">Objectively measured physical activity prevalence estimates (minutes)</label>
          <input type="number" name="estimates-admin" id="estimates-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['estimates'] != null){
                echo "value='" . $admin_values['estimates']."'";
              }
          ?> onblur="saveValueByAdmin('estimates', '<?php echo $id ?>', 'national_surveillance_values_admin')"> -->
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 6;
            $indicator_name = "objective_measures";
            $indicator_table_name = "national_surveillance";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="objective-measures-indicator">
            <div class="form-input">
              <p>Provide the new information here: </p>
              <label for="objective-measures">
                The country has collected national/subnational physical activity data using objective measures <span class="new">*new*</span>
              </label>
              <div class="radio" id="objetctive-measures">
                <label for="yes">Yes</label>
                <input type="radio" id="yes" name="objective-measures" value="yes" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
                  if ($contact_values['objective_measures'] == 1) {
                    echo "checked";
                  }?>
                  onblur="saveRadioValue('objective-measures',  '<?php echo $id ?>', 'national_surveillance_values_contact')">
                <label for="no">No</label>
                <input type="radio" id="no" name="objective-measures" value="no" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
                  if ($contact_values['objective_measures'] == 0 && $contact_values['objective_measures'] != null) {
                    echo "checked";
                  }?>
                  onblur="saveRadioValue('objective-measures',  '<?php echo $id ?>', 'national_surveillance_values_contact')">
              </div>
              <label for="devices-used">Devices that were used (Name)</label>
              <textarea style="height: 104px;" name="devices-used" id="devices-used" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
              ?>
                onblur="saveValueByContact('devices-used', '<?php echo $id ?>', 'national_surveillance_values_contact')"><?php 
                  if($contact_values['devices_used'] != null){
                    echo $contact_values['devices_used'];
                  }
              ?></textarea>
              <label for="devices-used-reference">Reference</label>
              <textarea style="height: 104px;" name="devices-used-reference" id="devices-used-reference" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
              ?>
                onblur="saveValueByContact('devices-used-reference', '<?php echo $id ?>', 'national_surveillance_values_contact')"><?php 
                  if($contact_values['devices_used_reference'] != null){
                    echo $contact_values['devices_used_reference'];
                  }
              ?></textarea>
              <!-- <label for="estimates" class="mt-10">Objectively measured physical activity prevalence estimates (minutes)</label>
              <input type="number" name="estimates" id="estimates" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
                  if($contact_values['estimates'] != null){
                    echo "value='" . $contact_values['estimates']."'";
                  }
              ?>
                onblur="saveValueByContact('estimates', '<?php echo $id ?>', 'national_surveillance_values_contact')"> -->
            </div>
            <?php
              $indicator_name = "objective_measures";
              $indicator_table_name = "national_surveillance";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>

      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `paPrevalence.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `nationalPolicy.php?id=".$id."`'";
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