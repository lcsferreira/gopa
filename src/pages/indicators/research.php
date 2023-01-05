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
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM research_values_contact WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $contact_values = mysqli_fetch_assoc($result);

  $sql = "SELECT * FROM research_agreement WHERE id = $id";
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
    ?>
    <div class="title">
      <h1>Research Indicators <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a
        file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
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
          <input type="number" name="contribution" id="contribution-admin" <?php 
              if($admin_values['contribution'] != null){
                echo "value=" . $admin_values['contribution'];
              }
          ?> onblur="saveValueByAdmin('contribution', '<?php echo $id ?>', 'research_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-1" value="yes" onclick="hideInput('agreement-1','contribution', '<?php echo $id ?>', 'research')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['contribution'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-1" value="no" onclick="showInput('agreement-1','contribution', '<?php echo $id ?>', 'research')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['contribution'] == 0 && $agreement_values['contribution'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="contribution-indicator">
            <textarea placeholder="Add a comment..." name="comments" id="contribution-comments" cols="30" rows="5"
            class="comment" onblur="saveComment('contribution', '<?php echo $id ?>', 'research_comments')"><?php
              if($comments['contribution'] != null){
                echo $comments['contribution'];
              }
              ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Physical activity research quintiles <span onclick="showModalInfo('research-quintiles')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
              Calculated to display a comparison between countries on the country cards. 1- high; 2-upper-middle;
              3-middle; 4-lower-middle; and, 5-low.
            </p>
          </label>
          <div class="radio" id="radio-group">
            <label for="q1">Q1</label>
            <input type="radio" id="q1" name="quintiles" value="q1">
            <label for="q2">Q2</label>
            <input type="radio" id="q2" name="quintiles" value="q2">
            <label for="q3">Q3</label>
            <input type="radio" id="q3" name="quintiles" value="q3">
            <label for="q4">Q4</label>
            <input type="radio" id="q4" name="quintiles" value="q4">
            <label for="q5">Q5</label>
            <input type="radio" id="q5" name="quintiles" value="q5">
          </div>
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-2" value="yes" onclick="hideInput('agreement-2','pa-quintiles', '<?php echo $id ?>', 'research')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['pa_quintiles'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-2" value="no" onclick="showInput('agreement-2','pa-quintiles', '<?php echo $id ?>', 'research')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['pa_quintiles'] == 0 && $agreement_values['pa_quintiles'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="pa-quintiles-indicator">
            <textarea placeholder="Add a comment..." name="comments" id="pa-quintiles-comments" cols="30" rows="5"
              class="comment" onblur="saveComment('pa-quintiles', '<?php echo $id ?>', 'research_comments')"><?php
              if($comments['pa_quintiles'] != null){
                echo $comments['pa_quintiles'];
              }
              ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Gender inequalities in physical activity research <span class="new">*new*</span> <span onclick="showModalInfo('gender-inequalities')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>
              Percentage (%) authors in physical activity research, which will be assessed with classical methods of
              equity analysis such as equiplots
            </p>
          </label>
          <div name="groups" id="groups">
            <div>
              <label for="male">Male</label>
              <input type="number" name="male" id="gender-inequalities-male-admin" <?php
                if($admin_values['gender_inequalities_male'] != null){
                  echo "value=" . $admin_values['gender_inequalities_male'];
                }
              ?> onblur="saveValueByAdmin('gender-inequalities-male', '<?php echo $id ?>', 'research_values_admin')">
            </div>
            <div>
              <label for="female">Female</label>
              <input type="number" name="female" id="gender-inequalities-female-admin" <?php 
              if($admin_values['gender_inequalities_female'] != null){
                echo "value=" . $admin_values['gender_inequalities_female'];
              }
              ?> onblur="saveValueByAdmin('gender-inequalities-female', '<?php echo $id ?>', 'research_values_admin')">
            </div>
          </div>
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-3" value="yes" onclick="hideInput('agreement-3','gender-inequalities', '<?php echo $id ?>', 'research')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['gender_inequalities'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-3" value="no" onclick="showInput('agreement-2','gender-inequalities', '<?php echo $id ?>', 'research')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['gender_inequalities'] == 0 && $agreement_values['gender_inequalities'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="gender-inequalities-indicator">
            <textarea placeholder="Add a comment..." name="comments" id="gender-inequalities-comments" cols="30" rows="5"
            class="comment" onblur="saveComment('gender-inequalities', '<?php echo $id ?>', 'research_comments')"><?php
                if($comments['gender_inequalities'] != null){
                  echo $comments['gender_inequalities'];
                }
                ?></textarea>
          </div>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>