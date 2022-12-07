<?php
  $title = "Inequalities Participation";                   
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
  <title>Inequalities Participation</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>Inequalities in Physical Activity Participation <span class="new">*new*</span> <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">Physical activity prevalence adults (%)</label>
          <div name="groups" id="groups">
            <div>
              <label for="males">Males</label>
              <input type="number" name="males" id="males">
            </div>
            <div>
              <label for="females">Females</label>
              <input type="number" name="females" id="females">
            </div>
          </div>
          <label for="reference">Reference</label>
          <input type="text" name="reference" id="reference">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="pa-prevalence-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="indicator-image">
          <label for="country">Inequalities in adult's physical activity participation <span class="new">*new*</span>
            <p>Determined using the physical activity prevalence estimates by sex and will be assessed with classical methods for equity analysis such as equiplots.
            </p>        
          </label>
          <img src="" alt="image">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="inequalities-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button"
          <?php
          echo "onclick='document.location = `paPrevalence.php?id=".$id."`'";
          ?>
        >Back</button>
      <button class="btn-next" type="button"
          <?php
          echo "onclick='document.location = `nationalSurveillance.php?id=".$id."`'";
          ?>>Next</button>
    </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>