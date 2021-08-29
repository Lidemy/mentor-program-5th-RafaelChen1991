<?php
  session_start();
  require_once('conn.php');



  $username = $_SESSION['username'];
  $title = $_POST["title"];
  $content = $_POST["content"];


  if (empty($title)) {
    header("Location:index.php?errCode=1");
    die("請輸入標題");
  }



  $sql = "insert into rafael_blog_articles(username, title, content) values(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $username, $title, $content); 


  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header("Location: admin.php");
  
?>


