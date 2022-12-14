<?php
  $title = "Demographic Indicators";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  //select row from demographic_values_admin table
  $sql = "SELECT * FROM demographic_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM demographic_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM demographic_values_contact WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $contact_values = mysqli_fetch_assoc($result);

  //select row from demographic_agreement table
  $sql = "SELECT * FROM demographic_agreement WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $agreement_values = mysqli_fetch_assoc($result);

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
  <title>Demographic Indicators</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <?php 
      include_once "../../components/modalInfo.php";
      ?>
    <?php
      $page = "demographic";
      include "../../components/indicatorsNav.php";
      include_once "../../components/modalDisplay.php";
    ?>
    <div class="title">
      <h1>Demographic Indicators <span onclick="showModalDisplay()"><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Review the indicators on the left side and check the best option about it.</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="country-admin">Country <span onclick="showModalInfo('country')"><i
                class="fa fa-question-circle-o"></i></span></label>
          <input type="text" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['country'] != null){
                echo "value='" . $admin_values['country']."'";
              }
            ?> name="country-admin" id="country-admin"
            onblur="saveValueByAdmin('country', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 1;
            $indicator_name = "country";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="country-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Country";
              $indicator_name = "country";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "country";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="capital-admin">Capital <span onclick="showModalInfo('capital')"><i
                class="fa fa-question-circle-o"></i></span></label>
          <input type="text" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['capital'] != null){
                echo "value='" . $admin_values['capital']."'";
              }
            ?> name="capital-admin" id="capital-admin"
            onblur="saveValueByAdmin('capital', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 2;
            $indicator_name = "capital";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="capital-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Capital";
              $indicator_name = "capital";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "capital";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="total-population-admin">Total population (number of people) <span
              onclick="showModalInfo('total-population')"><i class="fa fa-question-circle-o"></i></span>
            <p>Inhabits of the country</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['total_population'] != null){
                echo "value='" . $admin_values['total_population']."'";
              }
            ?> name="total-population-admin" id="total-population-admin"
            onblur="saveValueByAdmin('total-population', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 3;
            $indicator_name = "total_population";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="total-population-indicator">
            <?php
              $indicator_type = "number";
              $indicator_title = "Total population (number of people)";
              $indicator_name = "total_population";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "total_population";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="urban-population-admin">Urban population (%) <span onclick="showModalInfo('urban-population')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>Percentage (%) of the total population living in urban areas</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['urban_population'] != null){
                echo "value='" . $admin_values['urban_population']."'";
              }
            ?> name="urban-population-admin" id="urban-population-admin"
            onblur="saveValueByAdmin('urban-population', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 4;
            $indicator_name = "urban_population";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="urban-population-indicator">
          <?php
              $indicator_type = "number";
              $indicator_title = "Urban population (%)";
              $indicator_name = "urban_population";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "urban_population";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="life-expentacy-admin">Life expentacy (years) <span onclick="showModalInfo('life-expentacy')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>Average age that a person of the population is expected to live</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['life_expentacy'] != null){
                echo "value='" . $admin_values['life_expentacy']."'";
              }
            ?> name="life-expentacy-admin" id="life-expentacy-admin"
            onblur="saveValueByAdmin('life-expentacy', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 5;
            $indicator_name = "life_expentacy";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="life-expentacy-indicator">
          <?php
              $indicator_type = "number";
              $indicator_title = "Life expentacy (years)";
              $indicator_name = "life_expentacy";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "life_expentacy";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="gini-index-admin">Gini inequality index (number between 0 and 1) <span onclick="showModalInfo('gini-index')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>Measure of income inequality that summarizes the dispersion of income across the entire income
              distribution.
              0: perfect equality; 1: perfect inequality
            </p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['gini_index'] != null){
                echo "value='" . $admin_values['gini_index']."'";
              }
            ?> name="gini-index-admin" id="gini-index-admin"
            onblur="saveValueByAdmin('gini-index', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 6;
            $indicator_name = "gini_index";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="gini-index-indicator">
            <?php
              $indicator_type = "number";
              $indicator_title = "Gini inequality index (number between 0 and 1)";
              $indicator_name = "gini_index";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "gini_index";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>  
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="human-index-admin">Human development index (number between 0 and 1) <span onclick="showModalInfo('human-index')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>Summary measure of average achievement in key dimensions of human development: a long and healthy life,
              being knowledgeable and have a decent standard of living</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['human_index'] != null){
                echo "value='" . $admin_values['human_index']."'";
              }
            ?> name="human-index-admin" id="human-index-admin"
            onblur="saveValueByAdmin('human-index', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 7;
            $indicator_name = "human_index";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="human-index-indicator">
            <?php
              $indicator_type = "number";
              $indicator_title = "Human development index (number between 0 and 1)";
              $indicator_name = "human_index";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "human_index";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="literacy-rate-admin">Literacy rate (%) <span onclick="showModalInfo('literacy-rate')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>Percentage (%) of adults aged 15 and older who can both read and write</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['literacy_rate'] != null){
                echo "value='" . $admin_values['literacy_rate']."'";
              }
            ?> name="literacy-rate-admin" id="literacy-rate-admin"
            onblur="saveValueByAdmin('literacy-rate', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 8;
            $indicator_name = "literacy_rate";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="literacy-rate-indicator">
          <?php
              $indicator_type = "number";
              $indicator_title = "Literacy rate (%)";
              $indicator_name = "literacy_rate";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "literacy_rate";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="deaths-diseases-admin">Deaths due to non-communicable diseases (%) <span onclick="showModalInfo('deaths-diseases')"><i
                class="fa fa-question-circle-o"></i></span>
            <p>Percentage (%) of deaths by NCDs (include cancer, diabetes mellitus, cardiovascular diseases, digestive
              diseases, skin diseases, musculoskeletal diseases, and congenital anomalies)
            </p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['deaths_diseases'] != null){
                echo "value='" . $admin_values['deaths_diseases']."'";
              }
            ?> name="deaths-diseases-admin" id="deaths-diseases-admin"
            onblur="saveValueByAdmin('deaths-diseases', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 9;
            $indicator_name = "deaths_diseases";
            $indicator_table_name = "demographic";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="deaths-diseases-indicator">
            <?php
              $indicator_type = "number";
              $indicator_title = "Deaths due to non-communicable diseases (%)";
              $indicator_name = "deaths_diseases";
              $indicator_table_name = "demographic_values_contact";
              include("../../components/contactInput.php")
            ?>
            <?php
              $indicator_name = "deaths_diseases";
              $indicator_table_name = "demographic";
              include("../../components/commentInput.php")
            ?>
          </div>
        </div>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
        echo "onclick='document.location = `progress.php?id=".$id."`'";
        ?>>
          Back
        </button>
        <button class="btn-next" type="button" <?php
        echo "onclick='document.location = `paPrevalence.php?id=".$id."`'";
        ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>