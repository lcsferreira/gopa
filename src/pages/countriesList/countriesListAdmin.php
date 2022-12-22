<?php
  $title = "Countries List";                   
  include "../../components/header.php";                 
?>
<?php
  include_once "../../../config.php"
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
  <title>Countries List</title>
  <link rel="stylesheet" href="../../../css/pages/list/list.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <?php
      $type = "country";
      include_once "../../components/modalDelete.php";
    ?>
    <div class="title-header">
      <h1>Countries List</h1>
      <button class="btn-create" type="button" onclick="window.location.href='countryCreate.php'">
        Register Country
      </button>
      </button>
    </div>
    <div class="countries-list">
      <?php 
        $sql = "SELECT * FROM countries";
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);
    
        if($resultCheck > 0){
          echo "<div class='list'>";
          while($row = mysqli_fetch_assoc($result)){
          echo "<div class='list-object'>
                    <div class='country-flag'>
                      <i class='fa fa-flag'></i>
                    </div>
                    <div class='info-detail'>
                      <p>" . $row['name'] . "</p>
                    </div>
                    <div class='steps-list'>
                      <div class='step'>
                        <p>Indicators</p>
                        <button type='button' class='step-start' onclick='document.location = `../indicators/progress.php?id=" . $row['id'] . "`'>";
                        if($row['indicators_step'] == 'not started'){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['indicators_step'] == 'waiting contact'){
                          echo "<i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['indicators_step'] == 'waiting admin'){
                          echo "<i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['indicators_step'] == 'approved'){
                          echo "<i class='fa fa-check-circle fa-2x green'></i>";
                        };
                        echo "</button>
                      </div>
                      <div class='step'>
                        <p>Translation</p>
                        <button disabled type='button' class='step-start'>";
                        if($row['translation_step'] == 'not started'){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['translation_step'] == 'waiting contact'){
                          echo "<i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['translation_step'] == 'waiting admin'){
                          echo "<i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['translation_step'] == 'approved'){
                          echo "<i class='fa fa-check-circle fa-2x green'></i>";
                        };
                        echo"</button>
                      </div>
                      <div class='step'>
                        <p>Country Cards</p>
                        <button disabled type='button' class='step-start'>";
                        if($row['country_cards_step'] == 'not started'){
                          echo "<i class='fa fa-play-circle fa-2x gray'></i>";
                        }else if($row['country_cards_step'] == 'waiting contact'){
                          echo "<i class='fa fa-clock-o fa-2x yellow'></i>";
                        }else if($row['country_cards_step'] == 'waiting admin'){
                          echo "<i class='fa fa-exclamation-circle fa-2x red'></i>";
                        }else if($row['country_cards_step'] == 'approved'){
                          echo "<i class='fa fa-check-circle fa-2x green'></i>";
                        };
                        echo "</button>
                      </div>
                    </div>
                    <div class='object-buttons'>
                      <button class='btn-edit' onclick='document.location = `countryEdit.php?id=".$row['id']."`'>
                        <i class='fa fa-pencil'></i>
                      </button>
                      <button class='btn-delete' onclick='showModal(".$row['id'].")'>
                        <i class='fa fa-trash'></i>
                      </button>
                    </div>
                  </div>";
            
          }
          echo "</div>";
        }else {
          echo "<p>No country registered.</p>";
        }
      ?>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
  <script src="../../js/countries/countryDelete.js"></script>
</body>

</html>