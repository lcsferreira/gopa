<?php
  $title = "Country Register";                   
  include "../../components/header.php";                 
?> 
<?php
  if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== "1"){
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
  <title>Country Register</title>
  <link rel="stylesheet" href="../../../css/pages/list/forms.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <form class="forms" method="POST" action="">
      <div class="form-title">
        <h1>
          Country Registration
        </h1>
        <p>
          Fill with the country informations
        </p>
      </div>
      <div class="form-input">
        <label for="name">Name</label>
        <input type="text" id="name" class="form"placeholder="Name">
      </div>
      <div class="form-input">
        <label for="capital">Capital</label>
        <input type="text" id="capital" class="form" placeholder="Capital">
      </div>
      <div class="form-input">
        <label for="capital">Region</label>
        <input type="text" id="region" class="form" placeholder="Region">
      </div>
      <div class="form-input radio-group">
        <label for="need-translation">Need Translation: </label>
        <div id="need-translation">
          <label for="yes" >Yes</label>
          <input type="radio" id="yes" name="need-translation" value="yes" checked>
          <label for="no">No</label>
          <input type="radio" id="no" name="need-translation" value="no">
        </div>
      </div>
      <button class="btn-create" type="button" id="saveCountry" disabled="true">Register</button>
      </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/countries/countryCreate.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>