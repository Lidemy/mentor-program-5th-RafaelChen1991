<?php
  session_start();
  require_once("conn.php");

  $username = $_POST["username"];
  $password = $_POST["password"];

  if (empty($username) || empty($password)) {
    header("Location:login.php?errCode=1");
    die();
  };

  $sql = sprintf("SELECT * FROM rafael_users WHERE username='%s' AND password='%s'",
    $username,
    $password
  );

  $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  if ($result->num_rows) {
    $_SESSION['username'] = $username;
    header("location:index.php");
  } else {
    header("Location: login.php?errCode=2");
  }
?>