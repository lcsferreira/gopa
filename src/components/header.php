<?php
  include_once "../../../config.php";
?>
<?php
//get the session id
  session_start();
  $id = $_SESSION['id'];
  //select the admin name where id = session id
  $sql = "SELECT name FROM admin WHERE id = '$id'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
</head>
<body>
  <div id="mySidenav" class="sidenav">
    <a class="closebtn" onclick="closeNav()">&times;</a>
    <p>
      Hello, <?php echo $name; ?>
    </p>
    <?php
      if($_SESSION['userType'] == "admin"){
        echo 
        "
        <a href='../adminList/adminList.php'>Admins List</a>
        <a href='#'>Contacts List</a>
        ";
      }
    ?>
    <a href="#">Countries list</a>
    <a href="../login/login.php">Logout</a>
  </div>
  <div class="header-top">
    <button type="button" class="sidemenu-btn" onclick="openNav()">
      <i class="fa fa-bars"></i>
    </button>
    <img src="../../../assets/gopa-header-logo.svg" alt="gopa-logo">
  </div>
</body>
</html>