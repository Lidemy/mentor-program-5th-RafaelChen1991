<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = $_SESSION["username"];
  $role = $_GET["role"];
  $id = $_GET["id"];


  $sql = "UPDATE rafael_users SET role=? WHERE user_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $role, $id);
  $result = $stmt->execute();


  if (!$result) {
    die($conn->error);
  }

  header("location:admin.php");

?>