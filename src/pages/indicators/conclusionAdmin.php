<?php
  $title = "Conclusion";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];

  //get the 'edited' variable from localstorage and set it to a variable
  if(isset($_SESSION['edited'])){
    $edited = true;
  }else{
    $edited = false;
  }

  $sql = "SELECT indicators_step FROM countries WHERE id = $id"; 
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $indicators_step = $row['indicators_step'];

  $sql = "SELECT * FROM national_policy_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
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
  <title>Conclusion</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <?php
      $page = "conclusionAdmin";
      include "../../components/indicatorsNav.php";
    ?>
    <div class="title">
      <h1>Conclusion</h1>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input-conclusion">
          <?php 
          if($indicators_step=="waiting contact"){
            echo "<div class='center'>The contact has not yet reviewed the indicators!</div>";
          }else{
            if ($edited) {
              echo "<div>
              <label for='review'>Send for Country Contact’s review</label>
              <input type='checkbox' name='review' id='review' value='need-review'>
              </div>";
              if($admin_values['different_value_source_1']==1 || $admin_values['different_value_source_2']==1 || $admin_values['different_value_source_3']==1){
                echo "<input type='hidden' name='clarification' id='clarification' value=true>";
              }else{
                echo "<input type='hidden' name='clarification' id='clarification' value=false>";
              }
            }else{
              echo "<div class='center'>You didn't made any adjustment for the contact to review</div>";
            }
          }
          ?>
          
        </div>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `contact.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button"
          onclick="sendToContactReview('<?php echo $id ?>')" <?php if ($indicators_step == "waiting contact") {
               echo "disabled"; }?>>Submit</button>
      </div>
    </form>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicatorsConclusionAdmin.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>