<?php
  $title = "Contacts List";                   
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
  <title>Contact List</title>
  <link rel="stylesheet" href="../../../css/pages/list/list.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <?php
      $type = "contact";
      include_once "../../components/modalDelete.php";
    ?>
    <div class="title-header">
      <h1>Contact List</h1>
      <button class="btn-create" type="button" onclick="window.location.href='contactCreate.php'">
        Create Contact
      </button>
      </button>
    </div>
    <div class="contact-list">
      <?php 
        $sql = "SELECT * FROM contacts ORDER BY name ASC";
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
          echo "<div class='list'>";
          while($row = mysqli_fetch_assoc($result)){
            echo "<div class='list-object'>
                    <div class='user-img'>
                      <i class='fa fa-user-o'></i>
                    </div>
                    <div class='info-detail'>
                      <p>".$row['name']."</p>
                      <p class='institution'>".$row['institution']."</p>
                    </div>
                    <div class='is-active'>
                      <p>
                        ";
                          if($row['is_active'] == 1){
                            echo "Active";
                          }else{
                            echo "Inactive";
                          }
                    echo 
                      "</p>
                    </div>
                    <div class='object-buttons'>
                      <button class='btn-edit' onclick='document.location = `contactEdit.php?id=".$row['id']."`'>
                        <i class='fa fa-pencil'></i>
                      </button>
                      <button class='btn-delete' onclick='showModal(".$row['id'].")'>
                        <i class='fa fa-trash'></i>
                      </button>
                    </div>
                  </div>";
            
          }
          echo "</div>";
        } else {
          echo "<p>No contact registered.</p>";
        }
      ?>
    </div>
  </div>
  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
    ©  2023 GoPA. All rights reserved.
  </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
  <script src="../../js/contacts/contactDelete.js"></script>
</body>

</html>