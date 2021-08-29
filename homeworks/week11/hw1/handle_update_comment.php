<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = $_SESSION["username"];
  $content = $_POST["content"];
  $id = $_POST["id"];
  $user = getUserFromUsername($username);
  $role = $user['role'];


  if (empty($content)) {
    header("Location:index.php?errCode=1");
    die("請輸入內容");
  }

  if ($role == 2) {
    $sql = "UPDATE rafael_board SET content=? WHERE id=? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $content, $id);
    $result = $stmt->execute();
  } else {
    $sql = "UPDATE rafael_board SET content=? WHERE id=? AND username=? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $content, $id, $username);
    $result = $stmt->execute();
  }


  if (!$result) {
    die($conn->error);
  }

  header("location:index.php");

?>