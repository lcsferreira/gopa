<?php
  $title = "Introduction";                   
  include "../../components/header.php";                 
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
  <title>Introduction</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title mt-50 w-60">
      <h1>Third Set of Country Cards 2024</h1>
      <div>
        <p style="font-size: 20px;">Dear Country Contact, in the Third set of Country Cards, GoPA!’s core indicators will be updated to the most recent and available information.</p>
        <p style="font-size: 20px;">We value very much your participation and great contributions to GoPA!. We kindly ask you to review the data collected for your country’s Country Card.</p>
      </div>
    </div>
    <div class='intro list' style="font-size: 18px;">
      <p>You will have to:</p>
      <ul>
        <li>
        Complete and review the indicators of the Country Card's Indicators.
          <ul style="list-style: circle;">
            <li>Demographic Indicators</li>
            <li>Participation in physical activity</li>
            <li>National Surveillance</li>
            <li>National Policy</li>
            <li>Research</li>
            <li>Physical Activity Promotion Capacity Pyramid</li>
            <li>Country Card Contact</li>
          </ul>
        </li>
        <li>Review the English version of the Country Card.</li>
        <li>Translate your country's Country Card (if applicable)</li>
        <li>Review the translated version of the Country Card (if applicable)</li>
      </ul>
    </div>
    <div class='w-60'>
      <p style="font-size: 20px; color:#03a9f4; text-align: justify;">Data is automatically stored by the system. You can log out and log back in as you need, and your progress won’t be lost. There is no limit to the number of times you may check the data before approving it, but once you do, you won't be able to make any more changes.</p>
    </div>
    <form>
      <div class="buttons intro-btn">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `../others/manual.php`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `../countriesList/countriesListContacts.php`'";
          ?>>Start</button>
      </div>
    </form>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicatorsConclusion.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>