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
          echo "<table class='table'>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                  </tr>";
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr class='table-row' onclick='document.location = `adminEdit.php?admName=".$row['name']."&admEmail=".$row['email']."`'>
                    <td>".$row['name']."</td>
                    <td>".$row['email']."</td>
                  </tr>";
            
          }
          echo "</table>";
        }
      ?>
    </div>
  </div>
</body>
</html>