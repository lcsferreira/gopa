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
    ?>
    <div class="title">
      <h1>Country Card Contact <span><i class="fa fa-question-circle-o"></i></span></h1>
      <p>Check the indicators, adjust if necessary and add a comment with more information about it. You can upload a
        file to help with new information, to this drive: https:/drive.com/(CountryName)</p>
    </div>
    <form>
      <div class="indicators">
        <div class="form-input">
          <label for="name-1-admin">
            Name 1
          </label>
          <input type="text" name="name-1" id="name-1-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              }
              if($admin_values['name_1'] != null){
                echo "value=" . $admin_values['name_1'];
              }
          ?> onblur="saveValueByAdmin('name-1', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-1" value="yes" onclick="hideInput('agreement-1','name-1', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['name_1'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-1" value="no" onclick="showInput('agreement-1','name-1', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['name_1'] == 0 && $agreement_values['name_1'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="name-1-indicator">
            <div class="form-input">
              <label for="name-1">
                Name 1
              </label>
              <input type="text" name="name-1" id="name-1" <?php 
              if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }
              if($contact_values['name_1'] != null){
                echo "value=" . $contact_values['name_1'];
              }
              ?> onblur="saveValueByContact('name-1', '<?php echo $id ?>', 'contact_values_contact')">
            </div>
            <textarea placeholder="Add a comment..." name="comments" id="name-1-comments" cols="30" rows="5" class="comment"
            onblur="saveComment('name-1', '<?php echo $id ?>', 'contact_comments')"><?php
                if($comments['name_1'] != null){
                  echo $comments['name_1'];
                }
                ?></textarea>
          </div>
        </div>
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
                echo "value=" . $admin_values['email_1'];
              }
          ?> onblur="saveValueByAdmin('email-1', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-2" value="yes" onclick="hideInput('agreement-2','email-1', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['email_1'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-2" value="no" onclick="showInput('agreement-2','email-1', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['email_1'] == 0 && $agreement_values['email_1'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="email-1-indicator">
            <div class="form-input">
              <label for="email-1">
                Email 1
              </label>
              <input type="text" name="email-1" id="email-1" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($contact_values['email_1'] != null){
                echo "value=" . $contact_values['email_1'];
              }
              ?> onblur="saveValueByContact('email-1', '<?php echo $id ?>', 'contact_values_contact')">
            </div>
            <textarea placeholder="Add a comment..." name="comments" id="email-1-comments" cols="30" rows="5"
              class="comment" onblur="saveComment('email-1', '<?php echo $id ?>', 'contact_comments')"><?php
                  if($comments['email_1'] != null){
                    echo $comments['email_1'];
                  }
                  ?></textarea>
          </div>    
        </div>
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
                echo "value=" . $admin_values['institution_1'];
              }
          ?> onblur="saveValueByAdmin('institution-1', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-3" value="yes" onclick="hideInput('agreement-3','institution-1', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['institution_1'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-3" value="no" onclick="showInput('agreement-3','institution-1', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['institution_1'] == 0 && $agreement_values['institution_1'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="institution-1-indicator">
            <div class="form-input">
              <label for="institution-1">
                Institution 1
              </label>
              <input type="text" name="institution-1" id="institution-1" <?php 
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['institution_1'] != null){
                  echo "value=" . $contact_values['institution_1'];
                }
                ?> onblur="saveValueByContact('institution-1', '<?php echo $id ?>', 'contact_values_contact')">
            </div>
            <textarea placeholder="Add a comment..." name="comments" id="institution-1-comments" cols="30" rows="5"
            class="comment" onblur="saveComment('institution-1', '<?php echo $id ?>', 'contact_comments')"><?php
                  if($comments['institution_1'] != null){
                    echo $comments['institution_1'];
                  }
                  ?></textarea> 
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="name-2-admin">
            Name 2
          </label>
          <input type="text" name="name-2" id="name-2-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['name_2'] != null){
                echo "value=" . $admin_values['name_2'];
              }
          ?> onblur="saveValueByAdmin('name-2', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-4" value="yes" onclick="hideInput('agreement-4','name-2', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['name_2'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-4" value="no" onclick="showInput('agreement-4','name-2', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['name_2'] == 0 && $agreement_values['name_2'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="name-2-indicator">
            <div class="form-input">
              <label for="name-2">
                Name 2
              </label>
              <input type="text" name="name-2" id="name-2" <?php
              if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($contact_values['name_2'] != null){
                echo "value=" . $contact_values['name_2'];
              }
              ?> onblur="saveValueByContact('name-2', '<?php echo $id ?>', 'contact_values_contact')">
            </div>
            <textarea placeholder="Add a comment..." name="comments" id="name-2-comments" cols="30" rows="5" class="comment"
            onblur="saveComment('name-2', '<?php echo $id ?>', 'contact_comments')"><?php
                  if($comments['name_2'] != null){
                    echo $comments['name_2'];
                  }
                  ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="email-2-admin">
            Email 2
          </label>
          <input type="text" name="email-2" id="email-2-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['email_2'] != null){
                echo "value=" . $admin_values['email_2'];
              }
          ?> onblur="saveValueByAdmin('email-2', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-5" value="yes" onclick="hideInput('agreement-5','email-2', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['email_2'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-5" value="no" onclick="showInput('agreement-5','email-2', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['email_2'] == 0 && $agreement_values['email_2'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="email-2-indicator">
            <div class="form-input">
              <label for="email-2">
                Email 2
              </label>
              <input type="text" name="email-2" id="email-2" <?php
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  } 
                  if($contact_values['email_2'] != null){
                    echo "value=" . $contact_values['email_2'];
                  }
              ?> onblur="saveValueByContact('email-2', '<?php echo $id ?>', 'contact_values_contact')">
            </div>
            <textarea placeholder="Add a comment..." name="comments" id="email-2-comments" cols="30" rows="5"
              class="comment" onblur="saveComment('email-2', '<?php echo $id ?>', 'contact_comments')"><?php
                  if($comments['email_2'] != null){
                    echo $comments['email_2'];
                  }
                  ?></textarea> 
          </div>
        </div>
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
                echo "value=" . $admin_values['institution_2'];
              }
          ?> onblur="saveValueByAdmin('institution-2', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-6" value="yes" onclick="hideInput('agreement-6','institution-2', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['institution_2'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-6" value="no" onclick="showInput('agreement-6','institution-2', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['institution_2'] == 0 && $agreement_values['institution_2'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
          <div class="contact-input" id="institution-2-indicator">
            <div class="form-input">
              <label for="institution-2">
                Institution 2
              </label>
              <input type="text" name="institution-2" id="institution-2" <?php 
                  if($_SESSION['userType'] == "admin"){
                    echo "disabled ";
                  }
                  if($contact_values['institution_2'] != null){
                    echo "value=" . $contact_values['institution_2'];
                  }
              ?> onblur="saveValueByContact('institution-2', '<?php echo $id ?>', 'contact_values_contact')">
            </div>
            <textarea placeholder="Add a comment..." name="comments" id="institution-2-comments" cols="30" rows="5"
              class="comment" onblur="saveComment('institution-2', '<?php echo $id ?>', 'contact_comments')"><?php
                  if($comments['institution_2'] != null){
                    echo $comments['institution_2'];
                  }
                  ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="name-3-admin">
            Name 3
          </label>
          <input type="text" name="name-3" id="name-3-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['name_3'] != null){
                echo "value=" . $admin_values['name_3'];
              }
          ?> onblur="saveValueByAdmin('name-3', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-7" value="yes" onclick="hideInput('agreement-7','name-3', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['name_3'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-7" value="no" onclick="showInput('agreement-7','name-3', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['name_3'] == 0 && $agreement_values['name_3'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
        <div class="contact-input" id="name-3-indicator">
          <div class="form-input">
            <label for="name-3">
              Name 3
            </label>
            <input type="text" name="name-3" id="name-3" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                } 
                if($contact_values['name_3'] != null){
                  echo "value=" . $contact_values['name_3'];
                }
            ?> onblur="saveValueByContact('name-3', '<?php echo $id ?>', 'contact_values_contact')">
          </div>
          <textarea placeholder="Add a comment..." name="comments" id="name-3-comments" cols="30" rows="5" class="comment"
            onblur="saveComment('name-3', '<?php echo $id ?>', 'contact_comments')"><?php
                if($comments['name_3'] != null){
                  echo $comments['name_3'];
                }
                ?></textarea>
          </div>
        </div>
      </div>
      <div class="indicators">
        <div class="form-input">
          <label for="email-3-admin">
            Email 3
          </label>
          <input type="text" name="email-3" id="email-3-admin" <?php
              if($_SESSION['userType'] != "admin"){
                echo "disabled ";
              } 
              if($admin_values['email_3'] != null){
                echo "value=" . $admin_values['email_3'];
              }
          ?> onblur="saveValueByAdmin('email-3', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-8" value="yes" onclick="hideInput('agreement-8','email-3', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['email_3'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-8" value="no" onclick="showInput('agreement-8','email-3', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['email_3'] == 0 && $agreement_values['email_3'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
        <div class="contact-input" id="email-3-indicator">
          <div class="form-input">
            <label for="email-3">
              Email 3
            </label>
            <input type="text" name="email-3" id="email-3" <?php 
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                }
                if($contact_values['email_3'] != null){
                  echo "value=" . $contact_values['email_3'];
                }
            ?> onblur="saveValueByContact('email-3', '<?php echo $id ?>', 'contact_values_contact')">
          </div>
          <textarea placeholder="Add a comment..." name="comments" id="email-3-comments" cols="30" rows="5"
            class="comment" onblur="saveComment('email-3', '<?php echo $id ?>', 'contact_comments')"><?php
                if($comments['email_3'] != null){
                  echo $comments['email_3'];
                }
                ?></textarea>
          </div>
        </div>  
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
                echo "value=" . $admin_values['institution_3'];
              }
          ?> onblur="saveValueByAdmin('institution-3', '<?php echo $id ?>', 'contact_values_admin')">
        </div>
        <div class="contact-field">
          <div class="form-input">
            <label for="radio-group">Agreement</label>
            <div class="radio" id="radio-group">
              <label for="yes">Yes</label>
              <input type="radio" id="yes" name="agreement-1" value="yes" onclick="hideInput('agreement-9','institution-3', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              } 
              if($agreement_values['institution_3'] == 1){
                echo "checked";
              }?>>
              <label for="no">No</label>
              <input type="radio" id="no" name="agreement-1" value="no" onclick="showInput('agreement-9','institution-3', '<?php echo $id ?>', 'demographic')" <?php if($_SESSION['userType'] == "admin"){
                echo "disabled ";
              }if($agreement_values['institution_3'] == 0 && $agreement_values['institution_3'] != null){
                echo "checked";
              }?>>
            </div>
          </div>
        <div class="contact-input" id="institution-3-indicator">
          <div class="form-input">
            <label for="institution-3">
              Institution 3
            </label>
            <input type="text" name="institution-3" id="institution-3" <?php
                if($_SESSION['userType'] == "admin"){
                  echo "disabled ";
                } 
                if($contact_values['institution_3'] != null){
                  echo "value=" . $contact_values['institution_3'];
                }
            ?> onblur="saveValueByContact('institution-3', '<?php echo $id ?>', 'contact_values_contact')">
          </div>
          <textarea placeholder="Add a comment..." name="comments" id="institution-3-comments" cols="30" rows="5"
            class="comment" onblur="saveComment('institution-3', '<?php echo $id ?>', 'contact_comments')"><?php
                if($comments['institution_3'] != null){
                  echo $comments['institution_3'];
                }
                ?></textarea>
          </div>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/indicators/indicators.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>