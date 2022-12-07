<?php
  $title = "National Policy";                   
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
  <title>National Policy</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>National Policy <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            National physical activity policy/plan
            <p>
              Physical activity plan created and endorsed by the government. The plan should not only endorse the benefits of achieving the recommended level of physical activity but should also encourage the promotion of physical activity and regularly monitor the prevalence of health promoting-physical activity. 
            </p>
          </label>
          <div class="radio" id="radio-group">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-policy" value="yes">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-policy" value="no">
          </div>
          <label for="titles">Title(s)</label>
          <input type="text" name="titles" id="titles">
          <label for="reference" class="mt-10">Reference</label>
          <input type="text" name="reference" id="reference">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="national-policy-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="groups">
            National recommendations
          </label>
          <div class="radio" id="radio-group">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-recommend" value="yes">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-recommend" value="no">
          </div>
          <label for="reference">Reference</label>
          <input type="text" name="reference" id="reference">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="national-recommend-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="policy-percentage">
            Percentage (%) of policy implementation <span class="new">*new*</span>
            <p>
              Policy implementation includes translating statements, ideas, goals, and/or objectives mentioned in the policy documents into practice. 
            </p>
          </label>
          <input type="number" name="policy-percentage" id="policy-percentage">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="policy-percentage-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button"
          <?php
          echo "onclick='document.location = `nationalSurveillance.php?id=".$id."`'";
          ?>
        >Back</button>
      <button class="btn-next" type="button"
          <?php
          echo "onclick='document.location = `research.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>