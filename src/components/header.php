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
    <a href="../adminList/adminList.php">Admins</a>
    <a href="#">Contacts</a>
    <a href="#">Countries</a>
  </div>
  <div class="header-top">
    <button type="button" class="sidemenu-btn" onclick="openNav()">
      <i class="fa fa-bars"></i>
    </button>
    <img src="../../../assets/gopa-header-logo.svg" alt="gopa-logo">
  </div>
</body>
</html>