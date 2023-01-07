<?php
  $title = "Inequalities Participation";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  $sql = "SELECT * FROM inequalities_participation_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM inequalities_participation_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM inequalities_participation_values_contact WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $contact_values = mysqli_fetch_assoc($result);
  $sql = "SELECT * FROM inequalities_participation_agreement WHERE id = $id";
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
  <title>Inequalities Participation</title>
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
      $page = "inequalitiesParticipation";
      include "../../components/indicatorsNav.php";
    ?>
    <div class="title">
      <h1>Inequalities in Physical Activity Participation <span class="new">*new*</span> <span><i
            class="fa fa-question-circle-o"></i></span></h1>
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
          <label for="groups">Physical activity prevalence adults (%) <span onclick="showModalInfo('pa-prevalence')"><i
                class="fa fa-question-circle-o"></i></span></label>
          <div name="groups" id="groups">
            <div>
              <label for="males">Males</label>
              <input type="number" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if($admin_values['pa_activity_males'] != null){
                  echo "value=" . $admin_values['pa_activity_males'];
                }
              ?> onblur="saveValueByAdmin('pa-activity-males', '<?php echo $id ?>', 'inequalities_participation_values_admin')" name="males" id="pa-activity-males-admin">
            </div>
            <div>
              <label for="females">Females</label>
              <input type="number" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if($admin_values['pa_activity_females'] != null){
                  echo "value=" . $admin_values['pa_activity_females'];
                }
              ?> onblur="saveValueByAdmin('pa-activity-females', '<?php echo $id ?>', 'inequalities_participation_values_admin')" name="females" id="pa-activity-females-admin">
            </div>
          </div>
          <label for="reference">Reference</label>
          <input type="text" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled ";
                }
                if($admin_values['reference'] != null){
                  echo "value=" . $admin_values['reference'];
                }
              ?> onblur="saveValueByAdmin('reference', '<?php echo $id ?>', 'inequalities_participation_values_admin')" name="reference" id="reference-admin">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-1" value="yes" onclick="hideInput('agreement-1','pa-activity', '<?php echo $id ?>', 'inequalities_participation')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['pa_activity'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-1" value="no" onclick="showInput('agreement-1','pa-activity', '<?php echo $id ?>', 'inequalities_participation')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['pa_activity'] == 0 && $agreement_values['pa_activity'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="pa-activity-indicator">
            <div class="form-input">
              <label for="groups">Physical activity prevalence adults (%)</label>
              <div name="groups" id="groups">
                <div>
                  <label for="males">Males</label>
                  <input type="number" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['pa_activity_males'] != null){
                  echo "value=" . $contact_values['pa_activity_males'];
                }
                ?> name="males" id="males">
            </div>
            <div>
              <label for="females">Females</label>
              <input type="number" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['pa_activity_females'] != null){
                  echo "value=" . $contact_values['pa_activity_females'];
                }
                ?> name="females" id="females">
            </div>
          </div>
          <label for="reference">Reference</label>
          <input type="text" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['reference'] != null){
                  echo "value=" . $contact_values['reference'];
                }
                ?> name="reference" id="reference">
          </div>
          <textarea placeholder="Add a comment..." name="comments" id="pa-activity-comments" cols="30" rows="5" onblur="saveComment('pa-activity', '<?php echo $id ?>', 'inequalities_participation_comments')" class="comment"><?php
                  if($comments['pa_activity'] != null){
                    echo $comments['pa_activity'];
                  }
                  ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="indicator-image">
          <label for="country">Inequalities in adult's physical activity participation <span class="new">*new*</span> <span onclick="showModalInfo('pa-inequalities')"><i
                class="fa fa-question-circle-o"></i></span>
            <p> Inequalities in adults’ physical activity participation will be determined using the physical activity prevalence estimates by sex and will be assessed with classical methods for equity analysis such as equiplots. Below is an illustration of how the equiplot will be shown. The prevalence estimates will be used to compute the inequality, therefore we invite you to review them or correct them.
            </p>
          </label>
          <img class="mt-10" src="../../../assets/inequalities-example.PNG" alt="inequalities-example">
        </div>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `paPrevalence.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `nationalSurveillance.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>