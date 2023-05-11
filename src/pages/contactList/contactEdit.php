<?php
  $title = "Contact Edit";                   
  include "../../components/header.php";                 
?> 
<?php
  if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true){
    header("location: ../login/login.php");
    exit();
  }
?>
<?php
  include_once "../../../config.php";
  //get the id from the url
  $id = $_GET['id'];
  //select contact values where iid = $id
  $sql = "SELECT * FROM contacts WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $email = $row['email'];
  $second_email = $row['secondary_email'];
  $institution = $row['institution'];
  $is_active = $row['is_active'];

  //select all countries id's and is_main from contact_country
  $sql = "SELECT country_id, is_main FROM country_contact WHERE contact_id = $id";
  $result = mysqli_query($connection, $sql);
  $countries = array();
  //loop through the result and push the country id's and is_main into the countries array  
  while($row = mysqli_fetch_assoc($result)){
    array_push($countries, $row);
  }
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
          Contact Edit
        </h1>
        <p>
          Edit the contact informations
        </p>
      </div>
      <div class="form-input">
        <label for="name">Name</label>
        <input type="text" id="name" class="form"placeholder="Name"
        <?php 
          echo "value='".$name."'";
        ?>
        >
      </div>
      <div class="form-input">
        <label for="email">Email</label>
        <input type="text" id="email" class="form" placeholder="Email"
        <?php 
          echo "value='".$email."'";
        ?>
        >
        <p class="error-msg" id="email-error">Invalid email</p>
      </div>
      <div class="form-input">
        <label for="second-email">Secondary email (optional)</label>
        <input type="text" id="second-email" class="form" placeholder="Secondary Email"
        <?php 
          echo "value='".$second_email."'";
        ?>
        >
        <p class="error-msg" id="second-email-error">Invalid email</p>
      </div>
      <div class="form-input">
        <label for="institution">Institution</label>
        <input type="text" id="institution" class="form" placeholder="Institution"
        <?php 
          echo "value='".$institution."'";
        ?>
        >
      </div>
      <div class="form-input-rg">
        <label for="is-active">Active: </label>
        <input type="checkbox" name="is-active" id="is-active" 
          <?php
            if($is_active == 1){
              echo "checked";
            }
          ?>
        >
      </div>
      <div style='max-width: 456px;'>
        <?php
          if($is_active == 1){
            echo "<p >If any problem with contact activation email, you can copy and paste in an email the link below</p>
            <p style='color: blue; text-decoration: underline;word-break: break-all'>http://work.globalphysicalactivityobservatory.com/src/pages/login/firstAccess.php?id=$id&userType=contact</p>";
          }
          ?>
      </div>
      <div class="country-relation" id="countryRelationForm">
        <button type="button" class="add-btn">
          Add country
        </button>
        <div class="inputs">
          <?php
            $counter = 0;
            foreach($countries as $country){
              echo "<div class='form-input country-input'>
                <label for='country'>Country</label>
                <select name='country' id='country'>
                ";
              
                  $sql = "SELECT id, name FROM countries";
                  $selectedCountry = mysqli_query($connection, $sql);
                  //form a new select option with all of our countries from DB
                  foreach($selectedCountry as $countryOption){
                    if($country['country_id'] == $countryOption['id']){
                      echo "<option value='".$countryOption['id']."' selected>".$countryOption['name']."</option>";
                    }else{
                      echo "<option value='".$countryOption['id']."'>".$countryOption['name']."</option>";
                    }
                  }
               echo "
                </select>
                <div class='form-checkbox'>
                  <label for='contact-type'>Main contact</label>
                ";
                if($country['is_main'] == 1){
                  echo "<input type='checkbox' id='contact-type' checked>";
                }else{
                  echo "<input type='checkbox' id='contact-type'>";
                }
                echo "
                </div>";
                if($counter != 0){
                  echo "<button type='button' class='delete'>Delete</button>";
                }
              echo "</div>";
              $counter++;
            }
          ?> 
        </div>
      </div>
      <button class="btn-confirm" type="button" id="saveContact" >Confirm</button>
    </form>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/contacts/contactEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>