<?php
  require_once("conn.php");

  $nickname = $_POST["nickname"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (empty($nickname) || empty($username) || empty($password)) {
    header("Location:register.php?errCode=1");
    die("資料不齊全");
  };

  $sql = sprintf("INSERT INTO rafael_users(username, password, nickname) VALUES('%s', '%s', '%s')", 
    $username,
    $password,
    $nickname
  );

  $result = $conn->query($sql);
  if (!$result) {
    $code = $conn->errno;
    if($code === 1062) {
      header("Location:register.php?errCode=2");
    }
    die();
  }

  header("location:index.php");
?>