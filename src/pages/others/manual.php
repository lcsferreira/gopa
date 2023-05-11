<?php
  $title = "Manual";                   
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
  <title>Manual</title>
  <link rel="stylesheet" href="../../../css/pages/others/manual.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="buttons">
      <button class="btn-next" type="button" <?php
        echo "onclick='document.location = `../countriesList/introIndicators.php`'";
        ?> >Next</button>
    </div>
    <div class="pdf-container">
      <div class="title">
        <h1>Manual</h1>
        <p>Detailed instructions for navigating this system and completing the Country Card review and approval process can be found here</p>
      </div>
      <div class="pdf-doc">
      <object data="../../../assets/WorkflowGoPAManual.pdf" type="application/pdf" width="100%" height="500px"></object>
        <a class="button" href="../../../assets/WorkflowGoPAManual.pdf" target="_blank">View</a>
        <a class="button" download="../../../assets/WorkflowGoPAManual.pdf">Download</a>
      </div>
    </div>
    <hr>
    <div class="videos-container">
      <div class="title">
        <h1>Videos</h1>
        <p>Here you can find some videos that will help you to use the application.</p>
      <div class="video-content">
        <h2>1. How to log in</h2>
        <video width="700" controls>
          <source  src="../../../assets/videos/VIDEO 1_How to log in.mp4" type="video/mp4">
        </video>
      </div>
      <div class="video-content">
        <h2>2. Review steps</h2>
        <video width="700" controls>
          <source  src="../../../assets/videos/VIDEO 2_Overview of review steps.mp4" type="video/mp4">
        </video>
      </div>
      <div class="video-content">
        <h2>3. Indicators review</h2>
        <video width="700" controls>
          <source  src="../../../assets/videos/VIDEO 3_Indicators_ review step.mp4" type="video/mp4">
        </video>
      </div>
      <div class="video-content">
        <h2>4. Country card english version</h2>
        <video width="700" controls>
          <source  src="../../../assets/videos/VIDEO 4_Country Card English version step.mp4" type="video/mp4">
        </video>
      </div>
      <div class="video-content">
        <h2>5. Translation</h2>
        <video width="700" controls>
          <source  src="../../../assets/videos/VIDEO 5_Translation step.mp4" type="video/mp4">
        </video>
      </div>
      <div class="video-content">
        <h2>6. Country card translated version</h2>
        <video width="700" controls>
          <source  src="../../../assets/videos/VIDEO 6_Country Card translated version step.mp4" type="video/mp4">
        </video>
      </div>
    </div>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>