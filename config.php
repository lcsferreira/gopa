<?php
 $host = "localhost";
 $user = "root";
 $pass= "";

 $dbname = "gopa";
 $port = "3306";

 $connection = new PDO("mysql:host=$host;port=$port;dbname=".$dbname, $user, $pass);
?>