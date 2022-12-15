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
    <div class="title">
      <h1>Demographic Indicators <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a
        file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <div class="input-labels">
      <div>
        <p>Adjusted or most current value suggested</p>
      </div>
      <div>
        <p>
          If any adjustment, please indicate year of information.
        </p>
        <p>
          Please provide additional comments here.
        </p>
      </div>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="country">Country</label>
          <input type="text" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['country'] != null){
                echo "value=" . $admin_values['country'];
              }
            ?> name="country" id="country-admin"
            onblur="saveValueByAdmin('country', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="country">Country</label>
          <input type="text" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['country'] != null){
                echo "value=" . $contact_values['country'];
              } 
            ?> name="country" id="country"
            onblur="saveValueByContact('country', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="country-comments" cols="30" rows="5"
          class="comment" onblur="saveComment('country', '<?php echo $id ?>', 'demographic_comments')"><?php
            if($comments['country'] != null){
              echo $comments['country'];
            }
          ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="capital">Capital</label>
          <input type="text" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['capital'] != null){
                echo "value=" . $admin_values['capital'];
              }
            ?> name="capital" id="capital-admin"
            onblur="saveValueByAdmin('capital', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="capital">Capital</label>
          <input type="text" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['capital'] != null){
                echo "value=" . $contact_values['capital'];
              } 
            ?> name="capital" id="capital"
            onblur="saveValueByContact('capital', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..."
          onblur="saveComment('capital', '<?php echo $id ?>', 'demographic_comments')" name="comments"
          id="capital-comments" cols="30" rows="5" class="comment"><?php
                if($comments['capital'] != null){
                  echo $comments['capital'];
                }
              ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="total-population">Total population (number of people)
            <p>Inhabits of the country</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['total_population'] != null){
                echo "value=" . $admin_values['total_population'];
              }
            ?> name="total-population" id="total-population-admin"
            onblur="saveValueByAdmin('total-population', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="total-population">Total population (number of people)</label>
          <input type="number" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['total_population'] != null){
                echo "value=" . $contact_values['total_population'];
              } 
            ?> name="total-population" id="total-population"
            onblur="saveValueByContact('total-population', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..."
          onblur="saveComment('total-population', '<?php echo $id ?>', 'demographic_comments')" name="comments"
          id="total-population-comments" cols="30" rows="5" class="comment"><?php
            if($comments['total_population'] != null){
              echo $comments['total_population'];
            }
          ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="urban-population">Urban population (%)
            <p>Percentage (%) of the total population living in urban areas</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['urban_population'] != null){
                echo "value=" . $admin_values['urban_population'];
              }
            ?> name="urban-population" id="urban-population-admin"
            onblur="saveValueByAdmin('urban-population', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="urban-population">Urban population (%)</label>
          <input type="number" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['urban_population'] != null){
                echo "value=" . $contact_values['urban-population'];
              } 
            ?> name="urban-population" id="urban-population"
            onblur="saveValueByContact('urban-population', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..."
          onblur="saveComment('urban-population', '<?php echo $id ?>', 'demographic_comments')" name="comments"
          id="urban-population-comments" cols="30" rows="5" class="comment"><?php
            if($comments['urban_population'] != null){
              echo $comments['urban_population'];
            }
          ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="life-expentacy">Life expentacy (years)
            <p>Average age that a person of the population is expected to live</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['life_expentacy'] != null){
                echo "value=" . $admin_values['life_expentacy'];
              }
            ?> name="life-expentacy" id="life-expentacy-admin"
            onblur="saveValueByAdmin('life-expentacy', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="life-expentacy">Life expentacy (years)</label>
          <input type="number" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['life_expentacy'] != null){
                echo "value=" . $contact_values['life_expentacy'];
              } 
            ?> name="life-expentacy" id="life-expentacy"
            onblur="saveValueByContact('life-expentacy', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..."
          onblur="saveComment('life_expentacy', '<?php echo $id ?>', 'demographic_comments')" name="comments"
          id="life-expentacy-comments" cols="30" rows="5" class="comment"><?php
            if($comments['life_expentacy'] != null){
              echo $comments['life_expentacy'];
            }
          ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="gini-index">Gini inequality index (number between 0 and 1)
            <p>Measure of income inequality that summarizes the dispersion of income across the entire income
              distribution.
              0: perfect equality; 1: perfect inequality
            </p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['gini_index'] != null){
                echo "value=" . $admin_values['gini_index'];
              }
            ?> name="gini-index" id="gini-index-admin"
            onblur="saveValueByAdmin('gini-index', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="gini-index">Gini inequality index (number between 0 and 1)</label>
          <input type="number" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['gini_index'] != null){
                echo "value=" . $contact_values['gini_index'];
              } 
            ?> name="gini-index" id="gini-index"
            onblur="saveValueByContact('gini-index', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..."
          onblur="saveComment('gini-index', '<?php echo $id ?>', 'demographic_comments')" name="comments"
          id="gini-index-comments" cols="30" rows="5" class="comment"><?php
            if($comments['gini_index'] != null){
              echo $comments['gini_index'];
            }
          ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="human-index">Human development index (number between 0 and 1)
            <p>Summary measure of average achievement in key dimensions of human development: a long and healthy life,
              being knowledgeable and have a decent standard of living</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['human_index'] != null){
                echo "value=" . $admin_values['human_index'];
              }
            ?> name="human-index" id="human-index-admin"
            onblur="saveValueByAdmin('human-index', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="human-index">Human development index (number between 0 and 1)</label>
          <input type="number" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['human_index'] != null){
                echo "value=" . $contact_values['human_index'];
              } 
            ?> name="human-index" id="human-index"
            onblur="saveValueByContact('human-index', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..."
          onblur="saveComment('human-index', '<?php echo $id ?>', 'demographic_comments')" name="comments"
          id="human-index-comments" cols="30" rows="5" class="comment"><?php
            if($comments['human_index'] != null){
              echo $comments['human_index'];
            }
          ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="literacy-rate">Literacy rate (%)
            <p>Percentage (%) of adults aged 15 and older who can both read and write</p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['literacy_rate'] != null){
                echo "value=" . $admin_values['literacy_rate'];
              }
            ?> name="literacy-rate" id="literacy-rate-admin"
            onblur="saveValueByAdmin('literacy-rate', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="literacy-rate">Literacy rate (%)</label>
          <input type="number" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['literacy_rate'] != null){
                echo "value=" . $contact_values['literacy_rate'];
              } 
            ?> name="literacy-rate" id="literacy-rate"
            onblur="saveValueByContact('literacy-rate', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..."
          onblur="saveComment('literacy-rate', '<?php echo $id ?>', 'demographic_comments')" name="comments"
          id="literacy-rate-comments" cols="30" rows="5" class="comment"><?php
            if($comments['literacy_rate'] != null){
              echo $comments['literacy_rate'];
            }
          ?></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="deaths-diseases">Deaths due to non-communicable diseases (%)
            <p>Percentage (%) of deaths by NCDs (include cancer, diabetes mellitus, cardiovascular diseases, digestive
              diseases, skin diseases, musculoskeletal diseases, and congenital anomalies)
            </p>
          </label>
          <input type="number" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled";
              }
              if($admin_values['deaths_diseases'] != null){
                echo "value=" . $admin_values['deaths_diseases'];
              }
            ?> name="deaths-diseases" id="deaths-diseases-admin"
            onblur="saveValueByAdmin('deaths-diseases', '<?php echo $id ?>', 'demographic_values_admin')">
        </div>
        <div class="form-input">
          <label for="deaths-diseases">Deaths due to non-communicable diseases (%)</label>
          <input type="number" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled";
              }
              if($contact_values['deaths_diseases'] != null){
                echo "value=" . $contact_values['deaths_diseases'];
              } 
            ?> name="deaths-diseases" id="deaths-diseases"
            onblur="saveValueByContact('deaths-diseases', '<?php echo $id ?>', 'demographic_values_contact')">
        </div>
        <textarea placeholder="Add a comment..."
          onblur="saveComment('deaths-diseases', '<?php echo $id ?>', 'demographic_comments')" name="comments"
          id="deaths-diseases-comments" cols="30" rows="5" class="comment"><?php
            if($comments['deaths_diseases'] != null){
              echo $comments['deaths_diseases'];
            }
          ?></textarea>
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