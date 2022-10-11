<?php
  $title = "Admin List";                   
  include "../../components./header.php";                 
?>
<?php
  include_once "../../../config.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin List</title>
  <link rel="stylesheet" href="../../../css/pages/adminList/adminList.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container">
    <div class="title-header">
      <h1>Admin List</h1>
      <p  align="center" class="bg-a">
        <a href="../adminList/adminCreate.php" class="btn-create">Create Admin</a>  
      </p>
    </div>
    <div class="admin-list">
      <?php 
        $sql = "SELECT * FROM admin";
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
                      <button class='btn-delete'>
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
</body>
</html>