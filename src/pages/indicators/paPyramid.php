<?php
  $title = "P.A. Pyramid";                   
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
  <title>P.A. Pyramid</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>Physical Activity Promotion capacity pyramid <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Research:  
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="pyramid-research" value="green">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="pyramid-research" value="yellow">
            <label for="red">Red</label>
            <input type="radio" id="red" name="pyramid-research" value="red">
          </div>
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="research-pyramid-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Policy:  
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="pyramid-policy" value="green">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="pyramid-policy" value="yellow">
            <label for="red">Red</label>
            <input type="radio" id="red" name="pyramid-policy" value="red">
            <label for="availability">Availability</label>
            <input type="radio" id="availability" name="pyramid-policy" value="availability">
            <label for="implementation">Implementation</label>
            <input type="radio" id="implementation" name="pyramid-policy" value="implementation">
          </div>
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="policy-pyramid-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Surveillance:  
          </label>
          <div class="radio" id="radio-group">
            <label for="green">Green</label>
            <input type="radio" id="green" name="pyramid-survey" value="green">
            <label for="yellow">Yellow</label>
            <input type="radio" id="yellow" name="pyramid-survey" value="yellow">
            <label for="red">Red</label>
            <input type="radio" id="red" name="pyramid-survey" value="red">
          </div>
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="survey-pyramid-quitiles-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <img src="" alt="pyramids">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="pyramids-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button"
          <?php
          echo "onclick='document.location = `research.php?id=".$id."`'";
          ?>
        >Back</button>
      <button class="btn-next" type="button"
          <?php
          echo "onclick='document.location = `contact.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>