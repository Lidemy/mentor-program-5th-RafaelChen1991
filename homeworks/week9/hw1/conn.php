<?php
  $servername = "localhost";
  $username = "mtr04group5";
  $password = "Lidemymtr04group5";
  $db_name = "mtr04group5";

  $conn = new mysqli($servername, $username, $password, $db_name);

  if($conn->connect_error) {
    die("connection error: " . $conn->connect_error);
  }

  $conn->query("SET NAMES UTF-8");
  $conn->query("SET time_zone = '+8:00'");


?>