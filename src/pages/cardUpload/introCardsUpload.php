<?php
  $title = "Country Cards";                   
  include "../../components/header.php";                 
?>
<?php
  $country_id = $_GET['id'];
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
  <title>Country Cards</title>
  <link rel="stylesheet" href="../../../css/pages/cardUpload/cardUpload.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title mt-50 h-600">
      <h1>Review the Country Card</h1>
      <p>The English version of the Country Card will be displayed in this step. You can approve it or request additional changes, upload a file to offer more information, and leave a comment sharing your opinion.</p>
    </div>

    <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `../countriesList/countriesListContacts.php`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `cardUpload.php?id=".$country_id."`'";
          ?> >Start</button>
      </div>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/cardUpload/cardUpload.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>