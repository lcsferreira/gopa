<?php
  $title = "Indicators Progress";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  //get indicators_step from country table
  $sql = "SELECT indicators_step FROM country WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $demographic_progress = 0;

  if($row['indicators_step'] == "not started"){
    //create row in demographic_comments, demographic_values_admin and demograpghic_values_contact tables
    $sql = "INSERT INTO demographic_comments (id) VALUES ($id)";
    mysqli_query($conn, $sql);
    //get the id of the last row inserted
    $id_comment = $id;
    $sql = "INSERT INTO demographic_values_admin (id) VALUES ($id)";
    mysqli_query($conn, $sql);
    $id_value_admin = $id;
    $sql = "INSERT INTO demographic_values_contact (id) VALUES ($id)";
    mysqli_query($conn, $sql);
    $id_value_contact = $id;

    //create row in demoind_country_comments, with all foreign keys from id, id_value_admin, id_comment, id_value_contact
    $sql = "INSERT INTO demoind_country_comments (id_country, id_value_admin, id_comment, id_value_contact) VALUES ($id, $id_comment, $id_value_admin, $id_value_contact)";
  }

  //select row from demographic_values_contacct table
  $sql = "SELECT * FROM demographic_values_contact WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  //for each row except id, check if the value is not null
  foreach($row as $key => $value){
    if($key != "id" && $value != null){
      $demographic_progress ++;
    }
  }
  //calculate the percentage of the demographic indicators
  $demographic_progress = ($demographic_progress / 9) * 100;

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
    <button class="btn-next" type="button"
      <?php
        echo "onclick='document.location = `demographic.php?id=".$id."`'";
      ?>
    >Next</button>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>