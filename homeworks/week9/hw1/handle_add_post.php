<?php
  session_start();
  require_once("conn.php");

  $username = $_SESSION["username"];

  $user_sql = sprintf("SELECT * FROM rafael_users WHERE username = '%s'",
      $username
    );
  $user_result = $conn->query($user_sql);
  $user_row = $user_result->fetch_assoc();

  $nickname = $user_row["nickname"];

  $content = $_POST["content"];

  if (empty($content)) {
    header("Location:index.php?errCode=1");
    die("請輸入內容");
  }

  $sql = sprintf("INSERT INTO rafael_board(nickname, content) VALUES('%s', '%s') ",
    $nickname,
    $content
  );

  $result = $conn->query($sql);


  if (!$result) {
    die($conn->error);
  }

  header("location:index.php");

?>