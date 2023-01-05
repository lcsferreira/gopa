<?php
  $title = "P.A. Pyramid";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  $sql = "SELECT * FROM pa_promotion_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM pa_promotion_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);

  $sql = "SELECT * FROM pa_promotion_agreement WHERE id = $id";
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
  <title>P.A. Pyramid</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">]
    <?php 
      include_once "../../components/modalInfo.php";
    ?>
    <?php
      $page = "paPyramid";
      include "../../components/indicatorsNav.php";
    ?>
    <div class="title">
      <h1>Physical Activity Promotion capacity pyramid <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a
        file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="radio-group">
            Research: <span onclick="showModalInfo('pa-promotion')"><i
                class="fa fa-question-circle-o"></i></span>
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="research" value="green" <?php 
              if ($admin_values['research'] == "green") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('research',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="research" value="yellow" <?php 
              if ($admin_values['research'] == "yellow") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('research',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="red">Red</label>
            <input type="radio" id="red" name="research" value="red" <?php 
              if ($admin_values['research'] == "red") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('research',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
          </div>
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-1" value="yes" onclick="hideInput('agreement-1','research', '<?php echo $id ?>', 'pa_promotion')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['research'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-1" value="no" onclick="showInput('agreement-1','research', '<?php echo $id ?>', 'pa_promotion')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['research'] == 0 && $agreement_values['research'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="research-indicator">
            <textarea placeholder="Add a comment..." name="comments" id="research-comments" cols="30" rows="5"
            class="comment" onblur="saveComment('research', '<?php echo $id ?>', 'pa_promotion_comments')"><?php
                if($comments['research'] != null){
                  echo $comments['research'];
                }
                ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Policy: <span onclick="showModalInfo('pa-promotion')"><i
                class="fa fa-question-circle-o"></i></span>
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="policy" value="green" <?php 
              if ($admin_values['policy'] == "green") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('policy',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="policy" value="yellow" <?php 
              if ($admin_values['policy'] == "yellow") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('policy',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="red">Red</label>
            <input type="radio" id="red" name="policy" value="red" <?php 
              if ($admin_values['policy'] == "red") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('policy',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="availability">Availability</label>
            <input type="radio" id="availability" name="policy" value="availability" <?php 
              if ($admin_values['policy'] == "availability") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('policy',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="implementation">Implementation</label>
            <input type="radio" id="implementation" name="policy" value="implementation" <?php 
              if ($admin_values['policy'] == "implementation") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('policy',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
          </div>
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-2" value="yes" onclick="hideInput('agreement-2','policy', '<?php echo $id ?>', 'pa_promotion')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['policy'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-2" value="no" onclick="showInput('agreement-2','policy', '<?php echo $id ?>', 'pa_promotion')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['policy'] == 0 && $agreement_values['policy'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="policy-indicator">
            <textarea placeholder="Add a comment..." name="comments" id="policy-comments" cols="30" rows="5"
            class="comment" onblur="saveComment('policy', '<?php echo $id ?>', 'pa_promotion_comments')"><?php
                if($comments['policy'] != null){
                  echo $comments['policy'];
                }
                ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="radio-group">
            Surveillance: <span onclick="showModalInfo('pa-promotion')"><i
                class="fa fa-question-circle-o"></i></span>
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="surveillance" value="green" <?php 
              if ($admin_values['surveillance'] == "green") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('surveillance',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="surveillance" value="yellow" <?php 
              if ($admin_values['surveillance'] == "yellow") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('surveillance',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="red">Red</label>
            <input type="radio" id="red" name="surveillance" value="red" <?php 
              if ($admin_values['surveillance'] == "red") {
                echo "checked";
              }
            ?> onblur="saveRadioValue2('surveillance',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
          </div>
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-3" value="yes" onclick="hideInput('agreement-3','surveillance', '<?php echo $id ?>', 'pa_promotion')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['surveillance'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-3" value="no" onclick="showInput('agreement-3','surveillance', '<?php echo $id ?>', 'pa_promotion')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['surveillance'] == 0 && $agreement_values['surveillance'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="surveillance-indicator">
            <textarea placeholder="Add a comment..." name="comments" id="surveillance-comments" cols="30" rows="5"
            class="comment" onblur="saveComment('surveillance', '<?php echo $id ?>', 'pa_promotion_comments')"><?php
                if($comments['surveillance'] != null){
                  echo $comments['surveillance'];
                }
                ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <img src="../../../assets/pyramid-example.jpg" alt="pyramids">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-4" value="yes" onclick="hideInput('agreement-4','pyramid-image', '<?php echo $id ?>', 'pa_promotion')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['pyramid_image'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-4" value="no" onclick="showInput('agreement-4','pyramid-image', '<?php echo $id ?>', 'pa_promotion')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['pyramid_image'] == 0 && $agreement_values['pyramid_image'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="pyramid-image-indicator">
          <textarea placeholder="Add a comment..." name="comments" id="pyramid-image-comments" cols="30" rows="5"
          class="comment" onblur="saveComment('pyramid-image', '<?php echo $id ?>', 'pa_promotion_comments')"><?php
              if($comments['pyramid_image'] != null){
                echo $comments['pyramid_image'];
              }
              ?></textarea>
          </div>
        </div>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `research.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `contact.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>