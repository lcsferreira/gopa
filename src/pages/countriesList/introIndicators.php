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
        <p>GoPA! Country Cards provide the most current and reliable data to improve physical activity surveillance, policy, and research indicators.</p>
        <p>In the Third set of Country Cards, GoPA!’s core indicators will be updated to the most recent and available information. Based on the current monitoring gaps, seven new indicators were proposed with their description, data collection methods and articles of reference.</p>
        <p>We value very much your participation and great contributions to GoPA!. We kindly ask you that you to review the data collected for your country’s Country Card.</p>
      </div>
    </div>
    <div class='intro list'>
      <p>You will have to complete 3 steps:</p>
      <ul>
        <li>
          Data completion and review of the indicators of the Country Cards
        </li>
        <li>Translation of the Country Cards to native language (if applicable)</li>
        <li>Review English and translated version (if applicable) of the Country Cards</li>
      </ul>
    </div>
    <form>
      <div class="buttons intro-btn">
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `../countriesList/countriesListContacts.php`'";
          ?>>Start</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicatorsConclusion.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>