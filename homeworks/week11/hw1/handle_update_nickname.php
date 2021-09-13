<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  $username = $_SESSION['username'];
  $nickname = $_POST['nickname'];


  if (empty($nickname)) {
    header("Location:index.php?errCode=1");
    die("資料不齊全");
  }

  $sql = "UPDATE rafael_users SET nickname = ? WHERE username = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $nickname, $username);
  $result = $stmt->execute();
  if (!$result){
    die("conn->erro");
  }
  header("Location: index.php");
  
?>


