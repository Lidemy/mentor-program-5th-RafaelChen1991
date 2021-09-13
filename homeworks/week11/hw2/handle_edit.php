<?php
  session_start();
  require_once('conn.php');



  $username = $_SESSION['username'];
  $title = $_POST["title"];
  $content = $_POST["content"];
  $id = $_POST["id"];


  if (empty($title)) {
    header("Location:index.php?errCode=1" . $_POST['id']);
    die("請輸入標題");
  }



  $sql = "UPDATE rafael_blog_articles SET title = ?, content = ?, last_edited_at = NOW() WHERE id = ? AND username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssis', $title, $content ,$id, $username); 
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header("Location: admin.php");
  
?>


