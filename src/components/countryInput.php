<?php
  include_once "../../config.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
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
    <button type="button" class="delete">Delete</button>
  </div>
</body>
</html>