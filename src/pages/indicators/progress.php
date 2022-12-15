<?php
  $title = "Indicators Progress";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];

  //create an array tha have all the indicators steps 

  $indicators_steps = array("demographic", "pa_prevalence", "inequalitites_participation", "national_surveillance", "national_policy", "research", "pa_promotion", "contact");

  $value_types = array("comments","values_admin", "values_contact");

  $indicators_progress = array(0, 0, 0, 0, 0, 0, 0, 0);

  //get indicators_step from country table
  $sql = "SELECT indicators_step FROM countries WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  $demographic_progress = 0;

  if($row['indicators_step'] == "not started"){
    //for all the indicators steps, create a row in the table
    foreach ($indicators_steps as $step) {
      foreach($value_types as $value_type){
        $sql = "INSERT INTO " . $step . "_" . $value_type . " (id) VALUES ($id)";
        mysqli_query($connection, $sql);
      }
    }
    //update indicators_step to "in progress" in countries table
    $sql = "UPDATE countries SET indicators_step = 'started' WHERE id = $id";
  }

  foreach ($indicators_steps as $step) {
    $index = 0;
    //select row from demographic_values_contacct table
    $sql = "SELECT * FROM " . $step . "_values_contact WHERE id = $id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    //for each row except id, check if the value is not null
    foreach($row as $key => $value){
      if($key != "id" && $value != null){
        $indicators_progress[$index] ++;
      }
    }
    $index ++;
  }

  foreach ($indicators_progress as $progress) {
    $progress = ($progress / 9) * 100;
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
  <title>Indicators Progress</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>Progress of the indicators</h1>
      <p>This is the progress of the data completion and review of the indicators of the Country Card:</p>
    </div>
    <div class="progress">
      <div class="indicator-progress">
        <h2>Demographic Indicators</h2>
        <div class="indicator-progress-percent" style="--percent: 
        <?php 
          echo $demographic_progress;
        ?>">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
            <h2>
              <?php 
                echo $demographic_progress;
              ?>
              <span>%</span>
            </h2>
          </div>
        </div>
      </div>
      <div class="indicator-progress">
        <h2>P.A. Prevalance</h2>
        <div class="indicator-progress-percent" style="--percent: 0">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
            <h2>0<span>%</span></h2>
          </div>
        </div>
      </div>
      <div class="indicator-progress">
        <h2>Ineqaulities in P.A. Participation</h2>
        <div class="indicator-progress-percent" style="--percent: 0">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
            <h2>0<span>%</span></h2>
          </div>
        </div>
      </div>
      <div class="indicator-progress">
        <h2>National Surveillance</h2>
        <div class="indicator-progress-percent" style="--percent: 0">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
            <h2>0<span>%</span></h2>
          </div>
        </div>
      </div>
      <div class="indicator-progress">
        <h2>National Policy</h2>
        <div class="indicator-progress-percent" style="--percent: 0">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
            <h2>0<span>%</span></h2>
          </div>
        </div>
      </div>
      <div class="indicator-progress">
        <h2>Research Indicators</h2>
        <div class="indicator-progress-percent" style="--percent: 0">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
            <h2>0<span>%</span></h2>
          </div>
        </div>
      </div>
      <div class="indicator-progress">
        <h2>P.A. Promotion Capacity Pyramid</h2>
        <div class="indicator-progress-percent" style="--percent: 0">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
            <h2>0<span>%</span></h2>
          </div>
        </div>
      </div>
      <div class="indicator-progress">
        <h2>Country Card Contact</h2>
        <div class="indicator-progress-percent" style="--percent: 0">
          <svg>
            <circle cx="20" cy="20" r="20"></circle>
            <circle cx="20" cy="20" r="20"></circle>
          </svg>
          <div class="number">
            <h2>0<span>%</span></h2>
          </div>
        </div>
      </div>
    </div>
    <button class="btn-next" type="button" <?php
        echo "onclick='document.location = `demographic.php?id=".$id."`'";
      ?>>Next</button>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>