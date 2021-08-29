<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = $_SESSION["username"];
  $content = $_POST["content"];

  if (empty($content)) {
    header("Location:index.php?errCode=1");
    die("請輸入內容");
  }

  $sql = "INSERT INTO rafael_board(username, content) VALUES(?, ?) ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $content);
  $result = $stmt->execute();


  if (!$result) {
    die($conn->error);
  }

  header("location:index.php");

?>