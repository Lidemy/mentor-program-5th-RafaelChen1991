<?php
  session_start();
  require_once('conn.php');


  $id = $_GET['id'];
  $username = $_SESSION['username'];


  if (empty($id)) {
    header("Location:update_comment.php?errCode=1");
    die("資料不齊全");
  }

  $sql = "UPDATE rafael_blog_articles SET is_deleted = 1 WHERE id = ? AND username = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $id, $username);
  $result = $stmt->execute();
  if (!$result){
    die("conn->erro");
  }
  header("Location: admin.php");
  
?>


