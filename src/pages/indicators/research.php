<?php
  $title = "Research Indicators";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  $sql = "SELECT * FROM research_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM research_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);

  $sql = "SELECT * FROM research_agreement WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $agreement_values = mysqli_fetch_assoc($result);

  $sql = "SELECT * FROM research_values_contact WHERE id = $id";
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
  <title>Research Indicators</title>
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
      $page = "research";
      include "../../components/indicatorsNav.php";
      include_once "../../components/modalDisplay.php";
    ?>
    <div class="title">
      <h1>Research Indicators <span onclick="showModalDisplay()"><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Review the indicators on the left and select the best option.</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="contribution-research">
            Contribution to physical activity and health research worldwide from 1950-2016 <span onclick="showModalInfo('pa-research')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
              Percentage (%) of publications per country (total articles per country / total of articles worldwide)
            </p>
          </label>
          <input type="number" name="contribution-admin" id="contribution-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['contribution'] != null){
                echo "value='" . $admin_values['contribution']."'";
              }
          ?> onblur="saveValueByAdmin('contribution', '<?php echo $id ?>', 'research_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 1;
            $indicator_name = "contribution";
            $indicator_table_name = "research";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="contribution-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Contribution to physical activity and health research worldwide from 1950-2016";
              $indicator_name = "contribution";
              $indicator_table_name = "research_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "contribution";
          $indicator_table_name = "research";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Physical activity research quintiles <span onclick="showModalInfo('research-quintiles')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
              Calculated to display a comparison between countries on the Country Cards. 1- high; 2-upper-middle;
              3-middle; 4-lower-middle; and, 5-low.
            </p>
          </label>
          <div class="radio" id="radio-group">
            <label for="q1">Q1</label>
            <input type="radio" id="q1" name="pa-quintiles-admin" value="q1" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['pa_quintiles'] == "q1") {
                echo " checked";
              }
            ?> onclick="saveRadioValue2('pa-quintiles-admin', '<?php echo $id ?>', 'research_values_admin')">
            <label for="q2">Q2</label>
            <input type="radio" id="q2" name="pa-quintiles-admin" value="q2" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['pa_quintiles'] == "q2") {
                echo " checked";
              }
            ?> onclick="saveRadioValue2('pa-quintiles-admin', '<?php echo $id ?>', 'research_values_admin')">
            <label for="q3">Q3</label>
            <input type="radio" id="q3" name="pa-quintiles-admin" value="q3" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['pa_quintiles'] == "q3") {
                echo " checked";
              }
            ?> onclick="saveRadioValue2('pa-quintiles-admin', '<?php echo $id ?>', 'research_values_admin')">
            <label for="q4">Q4</label>
            <input type="radio" id="q4" name="pa-quintiles-admin" value="q4"<?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['pa_quintiles'] == "q4") {
                echo " checked";
              }
            ?> onclick="saveRadioValue2('pa-quintiles-admin', '<?php echo $id ?>', 'research_values_admin')">
            <label for="q5">Q5</label>
            <input type="radio" id="q5" name="pa-quintiles-admin" value="q5"<?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if ($admin_values['pa_quintiles'] == "q5") {
                echo " checked";
              }
            ?> onclick="saveRadioValue2('pa-quintiles-admin', '<?php echo $id ?>', 'research_values_admin')">
          </div>
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 2;
            $indicator_name = "pa_quintiles";
            $indicator_table_name = "research";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="pa-quintiles-indicator" style="margin-top: 2em">
            <!-- <div class="form-input">
              <p>Provide the new information here: </p>
              <div class="radio" id="radio-group">
                <label for="q1">Q1</label>
                <input type="radio" id="q1" name="pa-quintiles" value="q1" <?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if ($contact_values['pa_quintiles'] == "q1") {
                    echo " checked";
                  }
                ?> onclick="saveRadioValue2('pa-quintiles', '<?php echo $id ?>', 'research_values_contact')">
                <label for="q2">Q2</label>
                <input type="radio" id="q2" name="pa-quintiles" value="q2" <?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if ($contact_values['pa_quintiles'] == "q2") {
                    echo " checked";
                  }
                ?> onclick="saveRadioValue2('pa-quintiles', '<?php echo $id ?>', 'research_values_contact')">
                <label for="q3">Q3</label>
                <input type="radio" id="q3" name="pa-quintiles" value="q3" <?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if ($contact_values['pa_quintiles'] == "q3") {
                    echo " checked";
                  }
                ?> onclick="saveRadioValue2('pa-quintiles', '<?php echo $id ?>', 'research_values_contact')">
                <label for="q4">Q4</label>
                <input type="radio" id="q4" name="pa-quintiles" value="q4"<?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if ($contact_values['pa_quintiles'] == "q4") {
                    echo " checked";
                  }
                ?> onclick="saveRadioValue2('pa-quintiles', '<?php echo $id ?>', 'research_values_contact')">
                <label for="q5">Q5</label>
                <input type="radio" id="q5" name="pa-quintiles" value="q5"<?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if ($contact_values['pa_quintiles'] == "q5") {
                    echo " checked";
                  }
                ?> onclick="saveRadioValue2('pa-quintiles', '<?php echo $id ?>', 'research_values_contact')">
              </div>
            </div> -->
          </div>
        </div>
        <?php
          $indicator_name = "pa_quintiles";
          $indicator_table_name = "research";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input" style="
    width: 45%;
">
          <label for="groups">
            Gender inequalities in physical activity research <span class="new">*new*</span> <span onclick="showModalInfo('gender-inequalities')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
            Gender inequalities in physical activity research will constructed estimating the percentage of male and female authors in physical activity research, which will be assessed with classical methods of equity analysis such as equiplots. Below is an illustration of how the equiplot will be shown. Once all country-specific data is completed, the regional and worldwide parts of the equiplot will be computed.
            </p>
          </label>
          <img class="mt-10" src="../../../assets/gender-inequalities-example.jpg" alt="gender-inequalties-example">
        </div>
        <div class='contact-field'>
          <p style="width: 45%; text-align: justify;">
            Only country information will be considered throughout the approval process. Once data collection and confirmation is complete for all countries, the regional and worldwide elements of the equiplot will be included by the project director following GoPA!’s standardized methods.
          </p>
        </div>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `nationalPolicy.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `paPyramid.php?id=".$id."`'";
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