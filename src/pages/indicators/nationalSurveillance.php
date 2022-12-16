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
    <div class="title">
      <h1>National Surveillance <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a
        file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <div class="input-labels">
      <div>
        <p>Adjusted or most current value suggested</p>
      </div>
      <div>
        <p>
          If any adjustment, please indicate year of information.
        </p>
        <p>
          Please provide additional comments here.
        </p>
      </div>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="national-surveys-admin">
            National survey(s) including physical activity questions
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
              if ($admin_values['national_surveys'] == 0) {
                echo "checked ";
              }
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
            ?> name="national-surveys-admin"
              onblur="saveRadioValue('national-surveys-admin',  '<?php echo $id ?>', 'national_surveillance_values_admin')"
              value="no">
          </div>
        </div>
        <div class="form-input">
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
              if ($contact_values['national_surveys'] == 0) {
                echo "checked ";
              }
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
            ?> name="national-surveys" value="no"
              onblur="saveRadioValue('national-surveys',  '<?php echo $id ?>', 'national_surveillance_values_contact')">
          </div>
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="national-surveys-comments" cols="30" rows="5"
          class="comment"
          onblur="saveComment('national-surveys', '<?php echo $id ?>', 'national_surveillance_comments')"><?php if ($comments['national_surveys'] != null) {
            echo $comments['national_surveys'];
          }?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="most-recent-year-admin">Most recent (Year)</label>
          <input type="text" name="most-recent-year"
            onblur="saveValueByAdmin('most-recent-year', '<?php echo $id ?>', 'national_surveillance_values_admin')"
            id="most-recent-year-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['most_recent_year'] != null){
                echo "value=" . $admin_values['most_recent_year'];
              }
          ?>>
        </div>
        <div class="form-input">
          <label for="most-recent-year">Most recent (Year)</label>
          <input type="text"
            onblur="saveValueByContact('most-recent-year', '<?php echo $id ?>', 'national_surveillance_values_contact')"
            name="most-recent-year" id="most-recent-year" <?php 
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['most_recent_year'] != null){
                echo "value=" . $contact_values['most_recent_year'];
              }
          ?>>
        </div>
        <textarea placeholder="Add a comment..." name="most-recent-comments" id="most-recent-comments" cols="30"
          rows="5" class="comment"
          onblur="saveComment('most-recent-year', '<?php echo $id ?>', 'national_surveillance_comments')"><?php if ($comments['most_recent_year'] != null) {
            echo $comments['most_recent_year'];
          }?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="next-year-admin">Next (Year)</label>
          <input type="text" name="next-year"
            onblur="saveValueByAdmin('next-year', '<?php echo $id ?>', 'national_surveillance_values_admin')"
            id="next-year-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['next_year'] != null){
                echo "value=" . $admin_values['next_year'];
              }
          ?>>
        </div>
        <div class="form-input">
          <label for="next-year">Next (Year)</label>
          <input type="text" name="next-year"
            onblur="saveValueByContact('next-year', '<?php echo $id ?>', 'national_surveillance_values_contact')"
            id="next-year" <?php 
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['next_year'] != null){
                echo "value=" . $contact_values['next_year'];
              }
          ?>>
        </div>
        <textarea placeholder="Add a comment..." name="next-year-comments" id="next-year-comments" cols="30" rows="5"
          class="comment" onblur="saveComment('next-year', '<?php echo $id ?>', 'national_surveillance_comments')"><?php if ($comments['next_year'] != null) {
            echo $comments['next_year'];
          }?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="survey-names-admin">
            Surveys and instruments used to assess physical activity
            Names
          </label>
          <input type="text" name="survey-names" id="survey-names-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['survey_names'] != null){
                echo "value=" . $admin_values['survey_names'];
              }
          ?> onblur="saveValueByAdmin('survey-names', '<?php echo $id ?>', 'national_surveillance_values_admin')">
        </div>
        <div class="form-input">
          <label for="survey-names">
            Surveys and instruments used to assess physical activity
            Names
          </label>
          <input type="text" name="survey-names" id="survey-names"
            onblur="saveValueByContact('survey-names', '<?php echo $id ?>', 'national_surveillance_values_contact')" <?php 
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['survey_names'] != null){
                echo "value=" . $contact_values['survey_names'];
              }
          ?>>
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="survey-names-comments" cols="30" rows="5"
          class="comment" onblur="saveComment('survey-names', '<?php echo $id ?>', 'national_surveillance_comments')"><?php if ($comments['survey_names'] != null) {
            echo $comments['survey_names'];
          }?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="objective-measures-admin">
            Objective measurement to assess physical activity in adults <span class="new">*new*</span>
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
              if ($admin_values['objective_measures'] == 0) {
                echo "checked";
              }?>
              onblur="saveRadioValue('objective-measures-admin',  '<?php echo $id ?>', 'national_surveillance_values_admin')">
          </div>
          <label for="reference">Reference</label>
          <input type="text" name="reference" id="objective-measures-reference-admin" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['objective_measures_reference'] != null){
                echo "value=" . $admin_values['objective_measures_reference'];
              }
          ?>
            onblur="saveValueByAdmin('objective-measures-reference', '<?php echo $id ?>', 'national_surveillance_values_admin')">
        </div>
        <div class="form-input">
          <label for="objective-measures">
            Objective measurement to assess physical activity in adults <span class="new">*new*</span>
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
              if ($contact_values['objective_measures'] == 0) {
                echo "checked";
              }?>
              onblur="saveRadioValue('objective-measures',  '<?php echo $id ?>', 'national_surveillance_values_contact')">
          </div>
          <label for="reference">Reference</label>
          <input type="text" name="reference" id="objective-measures-reference" <?php 
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['objective_measures_reference'] != null){
                echo "value=" . $contact_values['objective_measures_reference'];
              }
          ?>
            onblur="saveValueByContact('objective-measures-reference', '<?php echo $id ?>', 'national_surveillance_values_contact')">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="objective-measures-comments" cols="30" rows="5"
          class="comment"
          onblur="saveComment('objective-measures', '<?php echo $id ?>', 'national_surveillance_comments')"><?php if ($comments['objective_measures'] != null) {
            echo $comments['objective_measures'];
          }?></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `inequalitiesParticipation.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `nationalPolicy.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>