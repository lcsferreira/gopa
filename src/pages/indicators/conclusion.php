<?php
  $title = "Conclusion";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $country_id = $_GET['id'];
  
  //get the userType from the session
  $userType = $_SESSION['userType'];
  if ($userType == "contact") {
    $contact_id = $_SESSION['id'];
    //get the the is_main from the country_contact table where the contact_id is equal to id and the country_id is equal to the id from the url
    $sql = "SELECT is_main FROM country_contact WHERE contact_id = $contact_id AND country_id = $country_id"; 
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $is_main = $row['is_main'];
  }

  $sql = "SELECT indicators_step FROM countries WHERE id = $country_id"; 
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $indicators_step = $row['indicators_step'];

  $indicators_steps = array("demographic", "pa_prevalence", "national_surveillance", "national_policy", "research", "pa_promotion", "contact");
  $all_steps_checked = "false";
  //foreach indicators step, get the agreement table and check if the values are different from null
  foreach ($indicators_steps as $step) {
    //select row from demographic_values_contacct table
    $sql = "SELECT * FROM " . $step . "_agreement WHERE id = $country_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    //for each row except id, check if the value is not null or zero
    foreach($row as $key => $value){
      if($key != "id" && $value == null){
        if($step == "contact" && ($key != "name_1" || $key != "email_1" || $key != "institution_1")){
          $all_steps_checked = "true";
          break;
        }else{
          $all_steps_checked = "false";
          break; 
        }
      }else{
        $all_steps_checked = "true";
      }
    }

    $index ++;
  }


  //get the 'edited' variable from localstorage and set it to a variable 
  if(isset($_SESSION['edited'])){
    $edited = true;
  }else{
    $edited = false;
  }
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
  <title>Conclusion</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <?php
      include_once "../../components/modalConfirm.php";
    ?>
    <div class="title mt-50">
      <h1>Conclusion</h1>
      <p>If you are ready to provide your review of the indicators, click the submit button.</p>
      <?php
          if($all_steps_checked == "false"){
            echo "<p style='color: red;'>You can't submit the indicators because you haven't checked all the indicators.</p>";
          }
      
      ?>
    </div>
    <form>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `contact.php?id=".$country_id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" onclick="confirmation('<?php echo $country_id ?>')" <?php if ($indicators_step == "waiting admin" || $is_main == 0 || $all_steps_checked == "false") {
               echo "disabled"; }?>>Submit</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicatorsConclusion.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>