<?php
  $title = "Country Card Contact";                   
  include "../../components/header.php";                 
?>
<?php
  //get id from url
  $id = $_GET['id'];
  $sql = "SELECT * FROM contact_values_admin WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $admin_values = mysqli_fetch_assoc($result);
  //select row from demographic_comments table
  $sql = "SELECT * FROM contact_comments WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $comments = mysqli_fetch_assoc($result);
  //select row from demographic_values_contact table
  $sql = "SELECT * FROM contact_values_contact WHERE id = $id";
  $result = mysqli_query($connection, $sql);
  $contact_values = mysqli_fetch_assoc($result);

  $sql = "SELECT * FROM contact_agreement WHERE id = $id";
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
  <title>Country Card Contact</title>
  <link rel="stylesheet" href="../../../css/pages/indicators/indicators.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <?php
      $page = "contact";
      include "../../components/indicatorsNav.php";
      include_once "../../components/modalDisplay.php";
    ?>
    <div class="title">
      <h1>Country Card Contact <span onclick="showModalDisplay()"><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Review the indicators on the left and select the best option.</p>
    </div>
    <form>
      <p style="color: #03a9f4; font-weight: bold;">The Country Card will include information for up to three contacts!</p>
      <div class="indicators">
        <div class="form-input">
          <label for="name-1-admin">
            Name 1
          </label>
          <input type="text" name="name-1-admin" id="name-1-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['name_1'] != null){
                echo "value='" . $admin_values['name_1']."'";
              }
          ?> onblur="saveValueByAdmin('name-1', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 1;
            $indicator_name = "name_1";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="name-1-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Name 1";
              $indicator_name = "name_1";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "name_1";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="email-1-admin">
            Email 1
          </label>
          <input type="text" name="email-1" id="email-1-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['email_1'] != null){
                echo "value='" . $admin_values['email_1']."'";
              }
          ?> onblur="saveValueByAdmin('email-1', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 2;
            $indicator_name = "email_1";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="email-1-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Email 1";
              $indicator_name = "email_1";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>    
        </div>
        <?php
          $indicator_name = "email_1";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="institution-1-admin">
            Institution 1
          </label>
          <input type="text" name="institution-1-admin" id="institution-1-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['institution_1'] != null){
                echo "value='" . $admin_values['institution_1']."'";
              }
          ?> onblur="saveValueByAdmin('institution-1', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 3;
            $indicator_name = "institution_1";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="institution-1-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Institution 1";
              $indicator_name = "institution_1";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "institution_1";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?> 
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="name-2-admin">
            Name 2
          </label>
          <input type="text" name="name-2-admin" id="name-2-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['name_2'] != null){
                echo "value='" . $admin_values['name_2']."'";
              }
          ?> onblur="saveValueByAdmin('name-2', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 4;
            $indicator_name = "name_2";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="name-2-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Name 2";
              $indicator_name = "name_2";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "name_2";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="email-2-admin">
            Email 2
          </label>
          <input type="text" name="email-2-admin" id="email-2-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['email_2'] != null){
                echo "value='" . $admin_values['email_2']."'";
              }
          ?> onblur="saveValueByAdmin('email-2', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 5;
            $indicator_name = "email_2";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="email-2-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Email 2";
              $indicator_name = "email_2";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "email_2";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="institution-2-admin">
            Institution 2
          </label>
          <input type="text" name="institution-2-admin" id="institution-2-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['institution_2'] != null){
                echo "value='" . $admin_values['institution_2']. "'";
              }
          ?> onblur="saveValueByAdmin('institution-2', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 6;
            $indicator_name = "institution_2";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
          <div class="contact-input" id="institution-2-indicator">
          <?php
              $indicator_type = "text";
              $indicator_title = "institution 2";
              $indicator_name = "institution_2";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "institution_2";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="name-3-admin">
            Name 3
          </label>
          <input type="text" name="name-3-admin" id="name-3-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['name_3'] != null){
                echo "value='" . $admin_values['name_3']."'";
              }
          ?> onblur="saveValueByAdmin('name-3', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 7;
            $indicator_name = "name_3";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
        <div class="contact-input" id="name-3-indicator">
          <?php
              $indicator_type = "text";
              $indicator_title = "Name 3";
              $indicator_name = "name_3";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "name_3";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="email-3-admin">
            Email 3
          </label>
          <input type="text" name="email-3-admin" id="email-3-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['email_3'] != null){
                echo "value='" . $admin_values['email_3']."'";
              }
          ?> onblur="saveValueByAdmin('email-3', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 8;
            $indicator_name = "email_3";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
        <div class="contact-input" id="email-3-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Email 3";
              $indicator_name = "email_3";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "email_3";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="institution-3-admin">
            Institution 3
          </label>
          <input type="text" name="institution-3-admin" id="institution-3-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['institution_3'] != null){
                echo "value='" . $admin_values['institution_3']."'";
              }
          ?> onblur="saveValueByAdmin('institution-3', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <?php
            $agreement_order = 9;
            $indicator_name = "institution_3";
            $indicator_table_name = "contact";
            include("../../components/agreementInput.php") 
          ?>
        <div class="contact-input" id="institution-3-indicator">
            <?php
              $indicator_type = "text";
              $indicator_title = "Institution 3";
              $indicator_name = "institution_3";
              $indicator_table_name = "contact_values_contact";
              include("../../components/contactInput.php")
            ?>
          </div>
        </div>
        <?php
          $indicator_name = "institution_3";
          $indicator_table_name = "contact";
          include("../../components/commentInput.php")
        ?>
      </div>
      <div class="indicators" style="justify-content: center;">
         <div class="contact-field">
              <label for="additional-contact" style="color: #03a9f4; font-weight: bold;">Please include additional contact information in case there are more than three Country Contacts. This information will be included in the Third GoPA! Physical Activity Almanac.</label>
              <textarea style="width: 80%; height: 130px;" name="additional-contact" id="additional-contact" <?php if ($_SESSION['userType'] == 'admin') {
                echo " disabled ";}?>onblur="saveValueByContact('additional-contact', '<?php echo $id ?>', 'contact_values_contact')"><?php if ($contact_values["additional_contact"] != null) {echo $contact_values["additional_contact"];}?></textarea> 
         </div>     
      </div>
      <div class="buttons">
        <button class="btn-back" type="button" <?php
          echo "onclick='document.location = `paPyramid.php?id=".$id."`'";
          ?>>Back</button>
        <button class="btn-next" type="button" <?php
          if($_SESSION['userType'] == 'admin'){
            echo "onclick='document.location = `conclusionAdmin.php?id=".$id."`'";
          }else{
            echo "onclick='document.location =  `conclusion.php?id=".$id."`'";
          }
          ?>>Next</button>
      </div>
    </form>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>