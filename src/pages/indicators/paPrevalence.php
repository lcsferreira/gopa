<?php
  $title = "P.A. Prevalence";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  $sql = "SELECT * FROM paprevalence_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM paprevalence_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM paprevalence_values_contact WHERE id = $id";
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
  <title>P.A. Prevalence</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>Physical Activity Prevalence <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a
        file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <div class="input-labels">
      <div>
        <p>suggest a value</p>
      </div>
      <div>
        <p>add a comment</p>
      </div>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">Physical activity prevalence adults (%)</label>
          <div name="groups" id="groups">
            <div>
              <label for="both-sexes">Both sexes</label>
              <input type="number" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled";
                }
                if($admin_values['both_sexes'] != null){
                  echo "value=" . $admin_values['both_sexes'];
                }
              ?> name="both-sexes" id="both-sexes-admin">
            </div>
            <div>
              <label for="males">Males</label>
              <input type="number" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled";
                }
                if($admin_values['males'] != null){
                  echo "value=" . $admin_values['males'];
                }
              ?>name="males" id="males-admin">
            </div>
            <div>
              <label for="females">Females</label>
              <input type="number" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled";
                }
                if($admin_values['females'] != null){
                  echo "value=" . $admin_values['females'];
                }
              ?> name="females" id="females-admin">
            </div>
          </div>
          <label for="reference">Reference</label>
          <input type="text" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled";
                }
                if($admin_values['reference'] != null){
                  echo "value=" . $admin_values['reference'];
                }
              ?> name="reference" id="reference-admin">
        </div>
        <div class="form-input">
          <label for="groups">Physical activity prevalence adults (%)</label>
          <div name="groups" id="groups">
            <div>
              <label for="both-sexes">Both sexes</label>
              <input type="number" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled";
                }
                if($contact_values['both_sexes'] != null){
                  echo "value=" . $contact_values['both_sexes'];
                }
              ?> name="both-sexes" id="both-sexes">
            </div>
            <div>
              <label for="males">Males</label>
              <input type="number" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled";
                }
                if($contact_values['males'] != null){
                  echo "value=" . $contact_values['males'];
                }
              ?> name="males" id="males">
            </div>
            <div>
              <label for="females">Females</label>
              <input type="number" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled";
                }
                if($contact_values['females'] != null){
                  echo "value=" . $contact_values['females'];
                }
              ?> name="females" id="females">
            </div>
          </div>
          <label for="reference">Reference</label>
          <input type="text" <?php
                if($_SESSION['userType'] != "admin"){
                  echo "disabled";
                }
                if($contact_values['reference'] != null){
                  echo "value=" . $contact_values['reference'];
                }
              ?> name="reference" id="reference">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="pa-prevalence-comments" cols="30" rows="5"
          class="comment"><?php
                if($comments['pa_prevalence'] != null){
                  echo $comments['pa_prevalence'];
                }
              ?></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `demographic.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `inequalitiesParticipation.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>