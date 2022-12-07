<?php
  $title = "Indicators Progress";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
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