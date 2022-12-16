<?php
  $title = "National Policy";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
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
    <div class="title">
      <h1>National Policy <span><i class="fa fa-question-circle-o"></i></span></h1>
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
          <label for="groups">
            National physical activity policy/plan
            <p>
              Physical activity plan created and endorsed by the government. The plan should not only endorse the
              benefits of achieving the recommended level of physical activity but should also encourage the promotion
              of physical activity and regularly monitor the prevalence of health promoting-physical activity.
            </p>
          </label>
          <div class="radio" id="radio-group">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-policy-admin" value="yes" <?php 
              if ($admin_values['national_policy'] == 1) {
                echo "checked";
              }
            ?> onblur="saveRadioValue('national-policy-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-policy-admin" value="no" <?php
              if ($admin_values['national_policy'] == 0 && $admin_values['national_policy'] != null) {
                echo "checked";
              }
            ?> onblur="saveRadioValue('national-policy-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
          </div>
          <label for="national-policy-titles-admin">Title(s)</label>
          <input type="text" name="national-policy-titles" id="national-policy-titles-admin" <?php 
              if($admin_values['national_policy_titles'] != null){
                echo "value=" . $admin_values['national_policy_titles'];
              }
          ?> onblur="saveValueByAdmin('national-policy-titles', '<?php echo $id ?>', 'national_policy_values_admin')">
          <label for="reference" class="mt-10">Reference</label>
          <input type="text" name="reference" id="national-policy-reference-admin" <?php 
              if($admin_values['national_policy_reference'] != null){
                echo "value=" . $admin_values['national_policy_reference'];
              }
          ?>
            onblur="saveValueByAdmin('national-policy-reference', '<?php echo $id ?>', 'national_policy_values_admin')">
        </div>
        <div class="form-input">
          <label for="radio-group">
            National physical activity policy/plan
          </label>
          <div class="radio" id="radio-group">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-policy" value="yes" <?php 
              if ($contact_values['national_policy'] == 1) {
                echo "checked";
              }
            ?> onblur="saveRadioValue('national-policy',  '<?php echo $id ?>', 'national_policy_values_contact')">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-policy" value="no" <?php 
              if ($contact_values['national_policy'] == 0 && $contact_values['national_policy'] != null) {
                echo "checked";
              }
            ?> onblur="saveRadioValue('national-policy',  '<?php echo $id ?>', 'national_policy_values_contact')">
          </div>
          <label for="national-policy-titles">Title(s)</label>
          <input type="text" name="titles" id="national-policy-titles" <?php 
              if($contact_values['national_policy_titles'] != null){
                echo "value=" . $contact_values['national_policy_titles'];
              }
          ?>
            onblur="saveValueByContact('national-policy-titles', '<?php echo $id ?>', 'national_policy_values_contact')">
          <label for="national-policy-reference" class="mt-10">Reference</label>
          <input type="text" name="reference" id="national-policy-reference" <?php 
              if($contact_values['national_policy_reference'] != null){
                echo "value=" . $contact_values['national_policy_reference'];
              }
          ?>
            onblur="saveValueByContact('national-policy-reference', '<?php echo $id ?>', 'national_policy_values_contact')">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="national-policy-comments" cols="30" rows="5"
          class="comment" onblur="saveComment('national-policy', '<?php echo $id ?>', 'national_policy_comments')"><?php
              if($comments['national_policy'] != null){
                echo $comments['national_policy'];
              }
              ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            National recommendations
          </label>
          <div class="radio" id="radio-group">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-recommendations-admin" value="yes" <?php 
              if ($admin_values['national_recommendations'] == 1) {
                echo "checked";
              }
            ?>
              onblur="saveRadioValue('national-recommendations-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-recommendations-admin" value="no" <?php 
              if ($admin_values['national_recommendations'] == 0 && $admin_values['national_recommendations'] != null) {
                echo "checked";
              }
            ?>
              onblur="saveRadioValue('national-recommendations-admin',  '<?php echo $id ?>', 'national_policy_values_admin')">
          </div>
          <label for="national-recommendation-reference-admin">Reference</label>
          <input type="text" name="reference" id="national-recommendation-reference-admin" <?php 
              if($admin_values['national_recommendations_reference'] != null){
                echo "value=" . $admin_values['national_recommendations_reference'];
              }
          ?>
            onblur="saveValueByAdmin('national-recommendations-reference', '<?php echo $id ?>', 'national_recommendations_values_admin')">
        </div>
        <div class="form-input">
          <label for="groups">
            National recommendations
          </label>
          <div class="radio" id="radio-group">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-recommendations" value="yes" <?php 
              if ($contact_values['national_recommendations'] == 1) {
                echo "checked";
              }
            ?>
              onblur="saveRadioValue('national-recommendations',  '<?php echo $id ?>', 'national_policy_values_contact')">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-recommendations" value="no" <?php 
              if ($contact_values['national_recommendations'] == 0 && $contact_values['national_recommendations'] != null) {
                echo "checked";
              }
            ?>
              onblur="saveRadioValue('national-recommendations',  '<?php echo $id ?>', 'national_policy_values_contact')">
          </div>
          <label for="reference">Reference</label>
          <input type="text" name="reference" id="national-recommendations-reference" <?php 
              if($contact_values['national_recommendations_reference'] != null){
                echo "value=" . $contact_values['national_recommendations_reference'];
              }
          ?>
            onblur="saveValueByContact('national-recommendations-reference', '<?php echo $id ?>', 'national_policy_values_contact')">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="national-recommendations-comments" cols="30"
          rows="5" class="comment"
          onblur="saveComment('national-recommendations', '<?php echo $id ?>', 'national_policy_comments')"><?php
              if($comments['national_recommendations'] != null){
                echo $comments['national_recommendations'];
              }
              ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="policy-implementation-admin">
            Percentage (%) of policy implementation <span class="new">*new*</span>
            <p>
              Policy implementation includes translating statements, ideas, goals, and/or objectives mentioned in the
              policy documents into practice.
            </p>
          </label>
          <input type="number" name="policy-implementation" id="policy-implementation-admin" <?php 
              if($admin_values['policy_implementation'] != null){
                echo "value=" . $admin_values['policy_implementation'];
              }
          ?> onblur="saveValueByAdmin('policy-implementation', '<?php echo $id ?>', 'national_policy_values_admin')">
        </div>
        <div class="form-input">
          <label for="policy-implementation">
            Percentage (%) of policy implementation <span class="new">*new*</span>
          </label>
          <input type="number" name="policy-implementation" id="policy-implementation" <?php 
              if($contact_values['policy_implementation'] != null){
                echo "value=" . $contact_values['policy_implementation'];
              }
          ?>
            onblur="saveValueByContact('policy-implementation', '<?php echo $id ?>', 'national_policy_values_contact')">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="policy-implementation-comments" cols="30" rows="5"
          class="comment"
          onblur="saveComment('policy-implementation', '<?php echo $id ?>', 'national_policy_comments')"><?php
              if($comments['policy_implementation'] != null){
                echo $comments['policy_implementation'];
              }
              ?></textarea>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>