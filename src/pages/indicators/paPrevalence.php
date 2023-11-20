<?php
  $title = "Physical Activity Participation";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  $sql = "SELECT * FROM pa_prevalence_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM pa_prevalence_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM pa_prevalence_values_contact WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $contact_values = mysqli_fetch_assoc($result);
  $sql = "SELECT * FROM pa_prevalence_agreement WHERE id = $id";
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
  <title>Physical Activity Participation</title>
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
      $page = "paPrevalence";
      include "../../components/indicatorsNav.php";
      $page = "pa-prevalence";
      include_once "../../components/modalDisplay.php";
    ?>
    <div class="title">
      <h1>Physical Activity Participation <span onclick="showModalDisplay()"><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Review the indicators on the left and select the best option.</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">Physical activity prevalence adults (%) <span onclick="showModalInfo('pa-prevalence')"><i
                class="fa fa-question-circle-o"></i></span></label>
          <div name="groups" id="groups">
            <div>
              <label for="both-sexes">Both sexes</label>
              <input type="number" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if($admin_values['both_sexes'] != null){
                  echo "value='" . $admin_values['both_sexes']."'";
                }
              ?> onblur="saveValueByAdmin('both-sexes', '<?php echo $id ?>', 'pa_prevalence_values_admin')"
                name="both-sexes-admin" id="both-sexes-admin">
            </div>
            <div>
              <label for="males">Males</label>
              <input type="number" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if($admin_values['males'] != null){
                  echo "value='" . $admin_values['males']."'";
                }
              ?> onblur="saveValueByAdmin('males', '<?php echo $id ?>', 'pa_prevalence_values_admin')" name="males-admin"
                id="males-admin">
            </div>
            <div>
              <label for="females">Females</label>
              <input type="number" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if($admin_values['females'] != null){
                  echo "value='" . $admin_values['females']."'";
                }
              ?> onblur="saveValueByAdmin('females', '<?php echo $id ?>', 'pa_prevalence_values_admin')" name="females-admin"
                id="females-admin">
            </div>
          </div>
          <label for="reference">Reference</label>
          <input type="text" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if($admin_values['reference'] != null){
                  echo "value='" . $admin_values['reference']."'";
                }
              ?> onblur="saveValueByAdmin('reference', '<?php echo $id ?>', 'pa_prevalence_values_admin')"
            name="reference-admin" id="reference-admin">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 1;
            $indicator_name = "pa_prevalence";
            $indicator_table_name = "pa_prevalence";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="pa-prevalence-indicator">
            <div class="form-input">
              <p>Provide the new information here: </p>
              <label for="groups">Physical activity prevalence adults (%)</label>
              <div name="groups" id="groups">
                <div>
                  <label for="both-sexes">Both sexes</label>
                  <input type="number" <?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
                if($contact_values['both_sexes'] != null){
                  echo "value='" . $contact_values['both_sexes']."'";
                }
                ?> onblur="saveValueByContact('both-sexes', '<?php echo $id ?>', 'pa_prevalence_values_contact')"
                name="both-sexes" id="both-sexes">
              </div>
              <div>
                <label for="males">Males</label>
                <input type="number" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['males'] != null){
                  echo "value='" . $contact_values['males']."'";
                }
                ?> onblur="saveValueByContact('males', '<?php echo $id ?>', 'pa_prevalence_values_contact')" name="males"
                id="males">
              </div>
              <div>
                <label for="females">Females</label>
                <input type="number" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['females'] != null){
                  echo "value='" . $contact_values['females']."'";
                }
                ?> onblur="saveValueByContact('females', '<?php echo $id ?>', 'pa_prevalence_values_contact')"
                name="females" id="females">
              </div>
            </div>
            <label for="reference">Reference</label>
            <input type="text" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['reference'] != null){
                  echo "value='" . $contact_values['reference']."'";
                }
                ?> onblur="saveValueByContact('reference', '<?php echo $id ?>', 'pa_prevalence_values_contact')"
            name="reference" id="reference">
          </div>
          </div>
        </div>
        <?php
          $indicator_name = "pa_prevalence";
          $indicator_table_name = "pa_prevalence";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="indicator-image" style="
    width: 45%;
">
          <label for="country">Gender Inequalities in Physical Activity Prevalence <span class="new">*new*</span> <span onclick="showModalInfo('pa-inequalities')"><i
                class="fa fa-question-circle-o"></i></span>
            <p> Gender inequalities in physical activity prevalence will be determined using the physical activity prevalence estimates by sex and will be assessed with classical methods for equity analysis such as equiplots. Below is an illustration of how the equiplot will be shown. The prevalence estimates will be used to compute the inequality, therefore we invite you to review them or correct them. Once all country-specific data is completed, the regional and worldwide parts of the equiplot will be computed.
            </p>
          </label>
          <img class="mt-10" src="../../../assets/inequalities-example.jpg" alt="inequalities-example">
        </div>
        <div class='contact-field'>
          <p style="width: 45%; text-align: justify;">
            Only country information will be considered throughout the approval process. Once data collection and confirmation is complete for all countries, the regional and worldwide elements of the equiplot will be included by the project director following GoPA!’s standardized methods.
          </p>
        </div>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `demographic.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `nationalSurveillance.php?id=".$id."`'";
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