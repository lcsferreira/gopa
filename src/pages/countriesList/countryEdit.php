<?php
  $title = "Country Edit";                   
  include "../../components/header.php";                 
?>
<?php
  include_once "../../../config.php";
//select admin values where id = $id
  $id = $_GET['id'];
  $sql = "SELECT * FROM countries WHERE id = '$id'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $capital = $row['capital'];
  $region = $row['region'];
  $need_translation = $row['need_translation'];
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
  <title>Country Edit</title>
  <link rel="stylesheet" href="../../../css/pages/list/forms.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <form class="forms" method="POST">
      <div class="form-title">
        <h1>
          Country Edit
        </h1>
        <p>
          Fill with the country informations
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
        <label for="capital">Capital</label>
        <input type="text" id="capital" class="form" placeholder="Capital"
        <?php 
          echo "value='".$capital."'";
        ?>
        >
      </div>
      <div class="form-input">
        <label for="capital">Region</label>
        <input type="text" id="region" class="form" placeholder="Region"
        <?php 
          echo "value='".$region."'";
        ?>
        >
      </div>
      <div class="form-input radio-group">
        <label for="need-translation">Need Translation: </label>
        <div id="need-translation">
          <?php 
            if($need_translation == 1){
              echo "
              <label for='yes'>Yes</label>
              <input type='radio' id='yes' name='need-translation' value='1' checked>
              <label for='no'>No</label>
              <input type='radio' id='no' name='need-translation' value='0'>
              ";
            }else{
              echo "<label for='yes'>Yes</label>
              <input type='radio' id='yes' name='need-translation' value='1'>
              <label for='no'>No</label>
              <input type='radio' id='no' name='need-translation' value='0' checked>
              ";
            }
          ?>
        </div>
      </div>
      <button class="btn-create"type="button" id="saveCountry">Confirm</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script language="JavaScript" src="../../../scripts/md5.js"></script>
  <script src="../../js/countries/countryEdit.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>
</html>