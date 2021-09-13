<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  if (empty($_GET['id'])) {
    die('資料不齊全');
  }


  $username = $_SESSION["username"];
  $user = getUserFromUsername($username);
  $role = $_GET["role"];
  $id = $_GET["id"];

  if ($user === NULL || $user['role'] !== 2) {
    header('Location: index.php');
    exit;
  }



  $sql = "UPDATE rafael_users SET role=? WHERE user_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $role, $id);
  $result = $stmt->execute();


  if (!$result) {
    die($conn->error);
  }

  header("location:admin.php");

?>