<?php
  $title = "Country Cards";                   
  include "../../components/header.php";                 
?>
<?php
  $country_id = $_GET['id'];
?>
<?php
  if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true){
    header("location: ../login/login.php");
    exit();
  }
  //GET CONSENT FROM CONTACT
  $sql = "SELECT consent FROM contacts WHERE id = ?";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $consent);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Country Cards</title>
  <link rel="stylesheet" href="../../../css/pages/cardUpload/cardUpload.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <div class='modal-consent' id='modalConfirm'>
      <div class='modal-content'>
        <div class='modal-header'>
          <i class='fa fa-exclamation-circle fa-5x' aria-hidden='true'></i>
          <h2>Consent to take part in research</h2>
        </div>
        <div class='modal-body' id='msg-confirm'>
          <p>
            This project is being conducted by a team of physical activity and public health experts from the Global
            Observatory for Physical Activity – GoPA!, coordinated by Andrea Ramírez Varela (University of Texas Health
            Science Center at Houston, Houston, TX, USA).
          </p>
          <p>
            The purpose of this project is to assess the current status and trends of physical activity epidemiologic
            surveillance, policy and research indicators worldwide, using the data collected by the GoPA!. This project
            will collaborate with a team of top-level physical activity researchers, epidemiologists, public health
            policymakers, practitioners, and experts worldwide.
          </p>
          <p>
            There are no potential risks of participating in this project. If you agree to take part, you will review,
            complete, and approve the data for each of the indicators we will include in the physical activity profiles
            called the Country Cards. These indicators include: country demographics, physical activity prevalence,
            physical activity research, physical activity surveillance, physical activity policy. There are no personal
            benefits from engaging in this project, we will use the results from this study to produce physical activity
            profiles for your country. There are no costs associated with taking part in this project.
          </p>
          <p>
            If you agree to participate, you will engage for one month to review and approve data. Reviewing the Country
            Cards will extend for one year, followed by another year for manuscript analysis. Voluntary participation
            aligns with ongoing GoPA! monitoring, with Country Card updates every 4-5 years.
          </p>
          <p>
            Furthermore, an Almanac will be developed consolidating all Country Cards into a single publication.
            Additionally, your country, you, and GoPA! will be the owners of the Country Card. Your name and affiliation
            as the GoPA! Country Contact will be included on the Country Cards, Almanac, manuscripts, and the GoPA!
            Observatory’ website.
          </p>
          <p>
            You may decide to stop taking part in the project at any time. To withdraw, please contact Andrea Ramírez
            Varela at <a
              href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
          </p>
          <p>
            The Committee for Protection of Human Subjects at the University of Texas Health Science Center has reviewed
            this research study. You may contact them for any questions about your rights as a research subject, and to
            discuss any concerns, comments, or complaints about taking part in a research study.
          </p>
          <p>
            IRB NUMBER: HSC-SPH-24-0230
          </p>
          <h2>I confirm that I have read the consent to take part in the GoPA! Country Cards.</h2>
          <h2>I understand that I can withdraw from this project at any time and this withdrawal will not jeopardize me
            in any way.</h2>
          <input type='checkbox' id='consent' name='consent' value='consent'>
          <label for='consent'>
            I agree to participate.</label>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn-confirm' id='confirm'>Confirm</button>
          <button type='button' class='btn-cancel' id='cancel-confirm'>Cancel</button>
        </div>
      </div>
    </div>
    <div class="title mt-50 h-600">
      <h1>Review the Country Card</h1>
      <p>The English version of the Country Card will be displayed in this step. You can approve it or request
        additional changes, upload a file to offer more information, and leave a comment sharing your opinion.</p>
    </div>

    <div class="buttons">
      <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `../countriesList/countriesListContacts.php`'";
          ?>>Back</button>
      <button class="btn-next" type="button"
        <?php if($_SESSION['userType']=='contact' && $consent == 0){echo "onclick='openModalConset()'";}else{echo "onclick='document.location = `cardUpload.php?id=$country_id`'";} ?>>Next</button>
    </div>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
      © 2023 GoPA. All rights reserved.
    </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/cardUpload/cardUpload.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
  <script>
  $("#cancel-confirm").click(function() {
    $("#modalConfirm").css("display", "none");
  });

  $("#confirm").click(function() {
    if ($("#consent").is(":checked")) {
      $("#modalConfirm").css("display", "none");

      $.ajax({
        url: "../../ajaxQuerys/cards/contactConsent.php",
        type: "POST",
        data: {
          consent: 1,
          id: <?php echo $_SESSION['id']; ?>
        },
        success: function(data) {
          if (data == "success") {
            document.location = `cardUpload.php?id=<?php echo $country_id; ?>`;
          }
        }
      });
    } else {
      if ($("#error")) {
        $("#error").remove();
      }
      $("#msg-confirm").append(
        "<p style='color: red;' id='error'>Please confirm that you agree to participate.</p>");
    }
  });

  function openModalConset() {
    $("#modalConfirm").css("display", "block");
  }
  </script>
</body>

</html>