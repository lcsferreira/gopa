<?php
  include_once "../../../config.php" 
?>
<?php 
  //get the id of the country
  $id = $_GET['id'];
  //get the version
  $version = $_GET['version'];

  //get the need_translation on the countries table
  $sql = "SELECT need_translation FROM countries WHERE id = $id";
  //execute the query
  $result = mysqli_query($connection, $sql);
  //get the result
  $row = mysqli_fetch_assoc($result);
  //get the value of need_translation
  $need_translation = $row['need_translation'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Card Approved</title>
  <link rel="stylesheet" href="../../../css/pages/login/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container">
    <div class="col-50 forms">
      <div class="form-title">
        <h1 style='text-align: center'>
          Congratulations on your new Country Card!
        </h1>
      </div>
      <?php if ($need_translation == 0) {
        echo "<p style='font-size: 20px'>Dear Country Contact. Thank you for completing the GoPA! 2024 Country Cards review process. We will contact you shortly with further instructions about the final set of Country Cards and the Third Physical Activity Almanac.</p>";
      } else if($version == "translated"){
        echo "<p style='font-size: 20px'>Dear Country Contact. Thank you for completing the GoPA! 2024 Country Cards review process. We will contact you shortly with further instructions about the final set of Country Cards and the Third Physical Activity Almanac.</p>";
      } else {
        echo "<p style='font-size: 20px'>Dear Country Contact, thank you for completing the GoPA! 2024 Country Card english version review process. Now the process of translating the Country Card will follow.</p>";
      }?>
    </div>
    <div class="col-50">
      <img class="side-img" src="../../../assets/approved.jpg" alt="gopa-img">
    </div>
  </div>
  <script>
    setTimeout(function() {
      window.location.href = "../countriesList/countriesListContacts.php<?php echo "?id=$id" ?>";
    }, 18000);
  </script>
</body>
</html>