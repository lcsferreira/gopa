<?php
  $title = "Progress of the Indicators";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];

  //create an array tha have all the indicators steps 

  $indicators_steps = array("demographic", "pa_prevalence", "national_surveillance", "national_policy", "research", "pa_promotion", "contact");

  $value_types = array("comments","values_admin", "values_contact", "agreement");

  $indicators_progress = array(0, 0, 0, 0, 0, 0, 0);

  $max_total_indicators = array(13, 1, 5, 3, 2, 3, 3);

  //get indicators_step from country table
  $sql = "SELECT indicators_step FROM countries WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  $sql = "SELECT * FROM national_policy_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);

  if($row['indicators_step'] == "not started"){
    //for all the indicators steps, create a row in the table
    foreach ($indicators_steps as $step) {
      foreach($value_types as $value_type){
        //write the logic to not create a row in the pa_promotion_values_contact table
        if($step == "pa_promotion" && $value_type == "values_contact"){
          continue;
        }else{
          $sql = "INSERT INTO " . $step . "_" . $value_type . " (id) VALUES ($id)";
          mysqli_query($connection, $sql);
        }
      }
    }
    // update indicators_step to "started" in countries table
    $sql = "UPDATE countries SET indicators_step = 'waiting admin' WHERE id = $id";
    mysqli_query($connection, $sql);
  }

  $index = 0;
  foreach ($indicators_steps as $step) {
    //select row from demographic_values_contacct table
    $sql = "SELECT * FROM " . $step . "_agreement WHERE id = $id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    //for each row except id, check if the value is not null or zero
    foreach($row as $key => $value){
      if($key != "id" && $value == 2){
        $indicators_progress[$index] ++;
      }
    }
    $index ++;
  }

  $index = 0;
  foreach ($indicators_progress as $progress) {
    $progress = ($progress / $max_total_indicators[$index]) * 100;
    //MAKE PROGRESS 2 DECIMALS
    if($progress > 100){
      $progress = 100;
    }
    $progress = number_format($progress, 1);
    $indicators_progress[$index] = $progress;
    $index++;
  }
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
  <title>Progress of the Indicators</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title mt-50">
      <h1>Progress of the Indicators</h1>
      <p>The review and completion of the data for the Country Card may be tracked here:</p>
    </div>
    <div class="progress">
      <div class="indicator-progress">
        <h2 <?php
          echo "onclick='document.location = `demographic.php?id=".$id."`'";
          ?>>Demographic Indicators</h2>
        <div class="indicator-progress-percent" style="--percent: 
        <?php 
          echo $indicators_progress[0];
        ?>">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
          </div>
          <h2><?php 
                echo $indicators_progress[0];
              ?><span>%</span>
          </h2>
        </div>
      </div>
      <div class="indicator-progress">
        <h2 <?php
          echo "onclick='document.location = `paPrevalence.php?id=".$id."`'";
          ?>>Physical Activity Participation</h2>
        <div class="indicator-progress-percent" style="--percent: <?php 
                echo $indicators_progress[1];
              ?>">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
          </div>
          <h2><?php 
                echo $indicators_progress[1];
              ?><span>%</span></h2>
        </div>
      </div>
      <div class="indicator-progress">
        <h2 <?php
          echo "onclick='document.location = `nationalSurveillance.php?id=".$id."`'";
          ?>>National Surveillance</h2>
        <div class="indicator-progress-percent" style="--percent: <?php 
                echo $indicators_progress[2];
              ?>">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
          </div>
          <h2><?php 
                echo $indicators_progress[2];
              ?><span>%</span></h2>
        </div>
      </div>
      <div class="indicator-progress">
        <h2 <?php
          echo "onclick='document.location = `nationalPolicy.php?id=".$id."`'";
          ?>>National Policy</h2>
        <div class="indicator-progress-percent" style="--percent: <?php 
                echo $indicators_progress[3];
              ?>">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
          </div>
          <h2><?php 
                echo $indicators_progress[3];
              ?><span>%</span></h2>
        </div>
        <?php if (($admin_values['different_value_source_1'] == 1 || $admin_values['different_value_source_2'] == 1 || $admin_values['different_value_source_3'] == 1)) {
          echo "<h2 class='different-value-source' onclick='document.location = `nationalPolicy.php?id=".$id."`'>Clarification needed!</h2>";
        }
          ?>
      </div>
      <div class="indicator-progress">
        <h2 <?php
          echo "onclick='document.location = `research.php?id=".$id."`'";
          ?>>Research Indicators</h2>
        <div class="indicator-progress-percent" style="--percent: <?php 
                echo $indicators_progress[4];
              ?>">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
          </div>
          <h2><?php 
                echo $indicators_progress[4];
              ?><span>%</span></h2>
        </div>
      </div>
      <div class="indicator-progress">
        <h2 <?php
          echo "onclick='document.location = `paPyramid.php?id=".$id."`'";
          ?>>Physical Activity Promotion Capacity Pyramid</h2>
        <div class="indicator-progress-percent" style="--percent: <?php 
                echo $indicators_progress[5];
              ?>">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
          </div>
          <h2><?php 
                echo $indicators_progress[5];
              ?><span>%</span></h2>
        </div>
      </div>
      <div class="indicator-progress">
        <h2 <?php
          echo "onclick='document.location = `contact.php?id=".$id."`'";
          ?>>Country Card Contact</h2>
        <div class="indicator-progress-percent" style="--percent: <?php 
                echo $indicators_progress[6];
              ?>">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
          </div>
          <h2><?php 
                echo $indicators_progress[6];
              ?><span>%</span></h2>
        </div>
      </div>
    </div>
    <div class="buttons">
      <button class="btn-back" type="button" <?php
      if($_SESSION['userType'] == 'admin'){
        echo "onclick='document.location = `../countriesList/countriesListAdmin.php`'";
      }else{
        echo "onclick='document.location = `../countriesList/countriesListContacts.php`'";
      }
      ?>>
        Back
      </button>
      <button class="btn-next" type="button" <?php
      echo "onclick='document.location = `demographic.php?id=".$id."`'";
    ?>>Next</button>
    </div>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>