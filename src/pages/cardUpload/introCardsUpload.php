<?php
  $title = "Country Cards";                   
  include "../../components/header.php";                 
?>
<?php

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
    <div class="title mt-50">
      <h1>Review the contry cards</h1>
      <p>On this step, we’ll show you the english and translated version of the country cards. You can approve or send to correction, upload a file or a audio to help with more information and make a comment with your opnion.</p>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/cardUpload/cardUpload.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>