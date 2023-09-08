<?php
  $title = "Admin Creation";                   
  include "../../components/header.php";                 
?> 
<?php
  if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true){
    header("location: ../login/login.php");
    exit();
  }
?>
<?php
  include_once "../../../config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Creation</title>
  <link rel="stylesheet" href="../../../css/pages/list/forms.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <form class="forms" method="POST" id="countryForm">
      <div class="form-title">
        <h1>
          Contact Creation
        </h1>
        <p>
          Fill with the contact informations
        </p>
      </div>
      <div class="form-input">
        <label for="name">Name</label>
        <input type="text" id="name" class="form"placeholder="Name">
      </div>
      <div class="form-input">
        <label for="email">Email</label>
        <input type="text" id="email" class="form" placeholder="Email">
        <p class="error-msg" id="email-error">Invalid email</p>
      </div>
      <div class="form-input">
        <label for="second-email">Secondary email (optional)</label>
        <input type="text" id="second-email" class="form" placeholder="Secondary Email">
        <p class="error-msg" id="second-email-error">Invalid email</p>
      </div>
      <div class="form-input">
        <label for="institution">Institution</label>
        <input type="text" id="institution" class="form" placeholder="Institution">
      </div>
      <div class="country-relation" id="countryRelationForm">
        <button type="button" class="add-btn">
          Add country
        </button>
        <div class="inputs">
          <div class="form-input country-input">
            <label for="country">Country</label>
            <select name="country" id="country">
              <?php
                //get all countries from DB with msqli function
                $sql = "SELECT id, name FROM countries ORDER BY name ASC";
                $selectedCountry = mysqli_query($connection, $sql);
                //form a new select option with all of our countries from DB
                foreach($selectedCountry as $country){
                  echo "
                    <option value={$country['id']}>{$country['name']}</option>
                  ";
                }
              ?>
            </select>
            <div class="form-checkbox">
              <label for="contact-type">Main contact</label>
              <input type="checkbox" id="contact-type" class="form">
            </div>
          </div>
        </div>
      </div>
      <button class="btn-create" type="button" id="saveContact" >Create</button>
    </form>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/contacts/contactCreate.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>