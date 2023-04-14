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
      $page = "pa-promotion";
      include_once "../../components/modalDisplay.php";
    ?>
    <div class="title">
      <h1>Physical Activity Promotion Capacity Pyramid <span onclick="showModalDisplay()"><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Review the indicators on the left and select the best option.</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="pyramid-image">
            Physical activity promotion capacity pyramids
            <p>
            Below is an illustration of how the physical activity promotion capacity pyramid will be shown. Once all country-specific data is completed, the regional and worldwide capacity pyramids will be computed.
            </p>
          </label>
          <img class="mt-10" src="../../../assets/pyramid-example.jpg" alt="pyramids" name="pyramid-image">
        </div>
        <div class='contact-field'>
          <p style="width: 45%; text-align: justify;">
            The development of the GoPA! country capacity for physical activity promotion indicator is described in Ramirez Varela, et al. Worldwide use of the first set of physical activity Country Cards: The Global Observatory for Physical Activity-GoPA!. International journal of behavioral nutrition and physical activity 15.1 (2018): 29.
          </p>
          <p style="width: 45%; text-align: justify; color: #03a9f4">
            Note: The final colors and the country pyramid will be determined by the project manager after reviewing the data provided and using GoPA's standardized methods. Clarifications may be requested during this review process.
          </p>
          <p style="width: 45%; text-align: justify;">
            Only country information will be considered throughout the approval process. Once data collection and confirmation is complete for all countries, the regional and worldwide capacity pyramids will be included by the project director following GoPA!’s standardized methods.
          </p>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="radio-group">
            Research: <span onclick="showModalInfo('pa-promotion-research')"><i
                class="fa fa-question-circle-o"></i></span>
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="research" value="green" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['research'] == "green") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('research',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="research" value="yellow" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['research'] == "yellow") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('research',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="red">Red</label>
            <input type="radio" id="red" name="research" value="red" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['research'] == "red") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('research',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
          </div>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 1;
            $indicator_name = "research";
            $indicator_table_name = "pa_promotion";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="research-indicator">
            <?php
              $indicator_name = "research";
              $indicator_table_name = "pa_promotion";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Policy: <span onclick="showModalInfo('pa-promotion-policy')"><i
                class="fa fa-question-circle-o"></i></span>
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="policy" value="green" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['policy'] == "green") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('policy',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="policy" value="yellow" <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['policy'] == "yellow") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('policy',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="red">Red</label>
            <input type="radio" id="red" name="policy" value="red" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['policy'] == "red") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('policy',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
          </div>
          <div class='radio' id='checkbox-group'>
            <label for='policy_type'>Availability</label>
            <input type='checkbox' id='policy_type' name='policy_type' value='availability' <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['policy_type'] == "availability" || $admin_values['policy_type'] == "both") {
                echo "checked";
              }
            ?> onclick="saveCheckboxValue('policy_type',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for='policy_type'>Implementation</label>
            <input type='checkbox' id='policy_type' name='policy_type' value='implementation' <?php 
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if ($admin_values['policy_type'] == "implementation" || $admin_values['policy_type'] == "both") {
                echo "checked";
              }
            ?> onclick="saveCheckboxValue('policy_type',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
          </div>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 2;
            $indicator_name = "policy";
            $indicator_table_name = "pa_promotion";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="policy-indicator">
            <?php
              $indicator_name = "policy";
              $indicator_table_name = "pa_promotion";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="radio-group">
            Surveillance: <span onclick="showModalInfo('pa-promotion-surveillance')"><i
                class="fa fa-question-circle-o"></i></span>
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="surveillance" value="green" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['surveillance'] == "green") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('surveillance',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="surveillance" value="yellow" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['surveillance'] == "yellow") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('surveillance',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
            <label for="red">Red</label>
            <input type="radio" id="red" name="surveillance" value="red" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['surveillance'] == "red") {
                echo "checked";
              }
            ?> onclick="saveRadioValue2('surveillance',  '<?php echo $id ?>', 'pa_promotion_values_admin')">
          </div>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 3;
            $indicator_name = "surveillance";
            $indicator_table_name = "pa_promotion";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="surveillance-indicator">
            <?php
              $indicator_name = "surveillance";
              $indicator_table_name = "pa_promotion";
              include("../../components/commentInput.php")
            ?>
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