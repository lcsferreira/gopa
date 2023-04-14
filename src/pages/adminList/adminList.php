<?php
  $title = "Admin List";                   
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
  <title>Admin List</title>
  <link rel="stylesheet" href="../../../css/pages/list/list.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" id="main">
    <?php
      $type = "admin";
      include_once "../../components/modalDelete.php";
    ?>
    <div class="title-header">
      <h1>Admin List</h1>
      <button class="btn-create" type="button" onclick="window.location.href='adminCreate.php'">
        Create Admin
      </button>
      </button>
    </div>
    <div class="admin-list">
      <?php 
        $sql = "SELECT * FROM admin ORDER BY name ASC";
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
                      <p>".$row['email']."</p>
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
                      <button class='btn-edit' onclick='document.location = `adminEdit.php?admId=".$row['id']."`'>
                        <i class='fa fa-pencil'></i>
                      </button>
                      <button class='btn-delete' onclick='showModal(".$row['id'].")'>
                        <i class='fa fa-trash'></i>
                      </button>
                    </div>
                  </div>";
            
          }
          echo "</div>";
        }
      ?>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
  <script src="../../js/admins/adminDelete.js"></script>
</body>

</html>