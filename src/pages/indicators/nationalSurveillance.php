<?php
  $title = "National Surveillance";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  $sql = "SELECT * FROM national_surveillance_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM national_surveillance_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM national_surveillance_values_contact WHERE id = $id";
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
  <title>National Surveillance</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class="title">
      <h1>National Surveillance <span><i class="fa fa-question-circle-o"></i></span></h1>
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
          <label for="national-surveys-admin">
            National survey(s) including physical activity questions
            <p>
              Surveys at the national level that cover physical activity at work/in the household, for transport, and
              during leisure time. Surveys should include a representative sample of the entire population or, in some
              cases, a clearly defined geographic segment of the population.
            </p>
          </label>
          <div class="radio" id="national-surveys-admin">
            <label for="yes">Yes</label>
            <input type="radio" id="yes-admin" name="national-surveys"
              onblur="saveRadioValue('national-surveys',  '<?php echo $id ?>', 'national_surveillance_values_admin')"
              value="yes">
            <label for="no">No</label>
            <input type="radio" id="no-admin" name="national-surveys"
              onblur="saveRadioValue('national-surveys',  '<?php echo $id ?>', 'national_surveillance_values_admin')"
              value="no">
          </div>
        </div>
        <div class="form-input">
          <label for="national-surveys">
            National survey(s) including physical activity questions
            <p>
              Surveys at the national level that cover physical activity at work/in the household, for transport, and
              during leisure time. Surveys should include a representative sample of the entire population or, in some
              cases, a clearly defined geographic segment of the population.
            </p>
          </label>
          <div class="radio" id="national-surveys">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="national-surveys" value="yes">
            <label for="no">No</label>
            <input type="radio" id="no" name="national-surveys" value="no">
          </div>
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="national-surveys-comments" cols="30" rows="5"
          class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="most-recent-year-admin">Most recent (Year)</label>
          <input type="text" name="most-recent-year" id="most-recent-year-admin">
        </div>
        <div class="form-input">
          <label for="most-recent-year">Most recent (Year)</label>
          <input type="text" name="most-recent-year" id="most-recent-year">
        </div>
        <textarea placeholder="Add a comment..." name="most-recent-comments" id="most-recent-comments" cols="30"
          rows="5" class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="next-year-admin">Next (Year)</label>
          <input type="text" name="next-year" id="next-year-admin">
        </div>
        <div class="form-input">
          <label for="next-year">Next (Year)</label>
          <input type="text" name="next-year" id="next-year">
        </div>
        <textarea placeholder="Add a comment..." name="next-year-comments" id="next-year-comments" cols="30" rows="5"
          class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="survey-names-admin">
            Surveys and instruments used to assess physical activity
            Names
          </label>
          <input type="text" name="survey-names" id="survey-names-admin">
        </div>
        <div class="form-input">
          <label for="survey-names">
            Surveys and instruments used to assess physical activity
            Names
          </label>
          <input type="text" name="survey-names" id="survey-names">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="survey-names-comments" cols="30" rows="5"
          class="comment"></textarea>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="objective-measures-admin">
            Objective measurement to assess physical activity in adults <span class="new">*new*</span>
          </label>
          <div class="radio" id="objective-measures-admin">
            <label for="yes">Yes</label>
            <input type="radio" id="yes-admin" name="objective" value="yes">
            <label for="no">No</label>
            <input type="radio" id="no-admin" name="objective" value="no">
          </div>
          <label for="reference">Reference</label>
          <input type="text" name="reference" id="objetcitve-measures-reference-admin">
        </div>
        <div class="form-input">
          <label for="objective-measures">
            Objective measurement to assess physical activity in adults <span class="new">*new*</span>
          </label>
          <div class="radio" id="objetctive-measures">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="objective" value="yes">
            <label for="no">No</label>
            <input type="radio" id="no" name="objective" value="no">
          </div>
          <label for="reference">Reference</label>
          <input type="text" name="reference" id="objective-measures-reference">
        </div>
        <textarea placeholder="Add a comment..." name="comments" id="objective-measures-comments" cols="30" rows="5"
          class="comment"></textarea>
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `inequalitiesParticipation.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          echo "onclick='document.location = `nationalPolicy.php?id=".$id."`'";
          ?>>Next</button>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>