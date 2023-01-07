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
    <div class="title">
      <h1>Conclusion</h1>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input-conclusion">
          <?php 
            if($edited == true){
              echo "<div><label for='adjust'>Request further adjustments</label><input type='checkbox' name='adjust' id='adjust' value='adjust'></div>";
            }else if($is_main == 1){
            echo "<div>
                <label for='approve'>Approve</label>
                <input type='checkbox' name='approve' id='approve' value='approve'>
              </div>";
            }else{
              echo "<div><p>You didn't make any adjustment on the indicators value!</p></div>";
            }
          ?>
        </div>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `contact.php?id=".$country_id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" onclick="saveStatus('<?php echo $country_id ?>')">Submit</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicatorsConclusion.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>