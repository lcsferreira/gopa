<?php
  $title = "Research Indicators";                   
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
  <title>Research Indicators</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>Research Indicators <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <form>
    <div class="indicators">
        <div class="form-input">
          <label for="contribution-research">
            Contribution to physical activity and health research worldwide from 1950-2016
            <p>
              Percentage (%) of publications per country (total articles per country / total of articles worldwide) 
            </p>
          </label>
          <input type="number" name="contribution-researche" id="contribution-research">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="contribution-research-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Physical activity research quintiles
            <p>
              Calculated to display a comparison between countries on the country cards. 1- high; 2-upper-middle; 3-middle; 4-lower-middle; and, 5-low.
            </p>  
          </label>
          <div class="radio" id="radio-group">
            <label for="q1">Q1</label>
            <input type="radio" id="q1" name="quintiles" value="q1">
            <label for="q2">Q2</label>
            <input type="radio" id="q2" name="quintiles" value="q2">
            <label for="q3">Q3</label>
            <input type="radio" id="q3" name="quintiles" value="q3">
            <label for="q4">Q4</label>
            <input type="radio" id="q4" name="quintiles" value="q4">
            <label for="q5">Q5</label>
            <input type="radio" id="q5" name="quintiles" value="q5">
          </div>
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="research-quitiles-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            Gender inequalities in physical activity research  <span class="new">*new*</span>
            <p>
              Percentage (%) authors in physical activity research, which will be assessed with classical methods of equity analysis such as equiplots
            </p>
          </label>
          <img alt="inequalities">
          <div name="groups" id="groups">
            <div>
              <label for="male">Male</label>
              <input type="number" name="male" id="male">
            </div>
            <div>
              <label for="female">Female</label>
              <input type="number" name="female" id="female">
            </div>
          </div>
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="gender-inequalities-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button"
          <?php
          echo "onclick='document.location = `nationalPolicy.php?id=".$id."`'";
          ?>
        >Back</button>
      <button class="btn-next" type="button"
          <?php
          echo "onclick='document.location = `paPyramid.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>