<?php
  $title = "Conclusion";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];

  //get the 'edited' variable from localstorage and set it to a variable
  if(isset($_SESSION['edited'])){
    $edited = $_SESSION['edited'];
  }  

  $sql = "SELECT indicators_step FROM countries WHERE id = $id"; 
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $indicators_step = $row['indicators_step'];
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
      $page = "conclusionAdmin";
      include "../../components/indicatorsNav.php";
    ?>
    <div class="title">
      <h1>Conclusion</h1>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input-conclusion">
          <?php 
          if($indicators_step=="waiting contact"){
            echo "<div class='center'>The contact has not yet reviewed the indicators!</div>";
          }else{
            if ($edited) {
              echo "<div>
              <label for='review'>Send to contact review</label>
              <input type='checkbox' name='review' id='review' value='need-review'>
              </div>";
            }else{
              echo "<div class='center'>You didn't make any adjustment!</div>";
            }
          }
          ?>
          
        </div>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `contact.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button"
          onclick="sendToContactReview('<?php echo $id ?>')" <?php if ($indicators_step == "waiting contact") {
               echo "disabled"; }?>>Submit</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicatorsConclusionAdmin.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>