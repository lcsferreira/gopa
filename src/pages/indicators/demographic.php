<?php
  $title = "Demographic Indicators";                   
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
  <title>Demographic Indicators</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>Demographic Indicators <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="country">Country</label>
          <input type="text" name="country" id="country">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="capital">Capital</label>
          <input type="text" name="capital" id="capital">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="total-population">Total population (number of people)
            <p>Inhabits of the country</p>
          </label>
          <input type="number" name="total-population" id="total-population">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="urban-population">Urban population (%)
            <p>Percentage (%) of the total population living in urban areas</p>  
          </label>
          <input type="number" name="urban-population" id="urban-population">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="life-expentacy">Life expentacy (years)
            <p>Average age that a person of the population is expected to live</p>
          </label>
          <input type="number" name="life-expentacy" id="life-expentacy">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="gini-index">Gini inequality index (number between 0 and 1)
            <p>Measure of income inequality that summarizes the   dispersion of income across the entire income distribution.
            0: perfect equality; 1: perfect inequality
            </p>
          </label>
          <input type="number" name="gini-index" id="gini-index">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="human-index">Human development index (number between 0 and 1)
            <p>Summary measure of average achievement in key dimensions of human development: a long and healthy life, being knowledgeable and have a decent standard of living</p>
          </label>
          <input type="number" name="human-index" id="human-index">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="literacy-rate">Literacy rate (%)
            <p>Percentage (%) of adults aged 15 and older who can both read and write</p>
          </label>
          <input type="number" name="literacy-rate" id="literacy-rate">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="deaths-diseases">Deaths due to non-communicable diseases (%)
            <p>Percentage (%) of deaths by NCDs (include cancer, diabetes mellitus, cardiovascular diseases, digestive diseases, skin diseases, musculoskeletal diseases, and congenital anomalies)
            </p>
          </label>
          <input type="number" name="deaths-diseases" id="deaths-diseases">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
        echo "onclick='document.location = `progress.php?id=".$id."`'";
        ?>>
          Back
        </button>
        <button class="btn-next" type="button" 
        <?php
        echo "onclick='document.location = `paPrevalence.php?id=".$id."`'";
        ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>