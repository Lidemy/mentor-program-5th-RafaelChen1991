<?php
  session_start();
  require_once("conn.php");

  $nickname = $_POST["nickname"];
  $username = $_POST["username"];
  $password = $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

  if (empty($nickname) || empty($username) || empty($password)) {
    header("Location:register.php?errCode=1");
    die("資料不齊全");
  };

  $sql = "INSERT INTO rafael_users(username, password, nickname) VALUES(?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $username, $password, $nickname);
  $result = $stmt->execute();
  if (!$result) {
    $code = $conn->errno;
    if($code === 1062) {
      header("Location:register.php?errCode=2");
    }
    die();
  }

  $_SESSION['username'] = $username;
  header("location:index.php");
?>