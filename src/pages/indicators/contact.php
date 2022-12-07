<?php
  $title = "Country Card Contact";                   
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
  <title>Country Card Contact</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>Country Card Contact <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="name-1">
            Name 1 
          </label>
          <input type="number" name="name-1" id="name-1">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="name-1-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="email-1">
            Email 1 
          </label>
          <input type="number" name="email-1" id="email-1">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="email-1-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="institution-1">
            Institution 1 
          </label>
          <input type="number" name="institution-1" id="institution-1">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="institution-1-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="name-2">
            Name 2 
          </label>
          <input type="number" name="name-2" id="name-2">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="name-2-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="email-2">
            Email 2 
          </label>
          <input type="number" name="email-2" id="email-2">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="email-2-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="institution-2">
            Institution 2 
          </label>
          <input type="number" name="institution-2" id="institution-2">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="institution-2-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="name-3">
            Name 3 
          </label>
          <input type="number" name="name-3" id="name-3">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="name-3-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="email-3">
            Email 3 
          </label>
          <input type="number" name="email-3" id="email-3">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="email-3-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="institution-3">
            Institution 3 
          </label>
          <input type="number" name="institution-3" id="institution-3">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="institution-3-comments" cols="30" rows="5" class="comment"></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button"
          <?php
          echo "onclick='document.location = `paPyramid.php?id=".$id."`'";
          ?>
        >Back</button>
      <button class="btn-next" type="button"
          <?php
          echo "onclick='document.location = `conclusion.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>