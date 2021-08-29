<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = $_SESSION["username"];
  $id = $_GET["id"];
  $user = getUserFromUsername($username);
  $role = $user['role'];

  if (empty($id)) {
    header("Location:update_comment.php?errCode=1");
    die("資料不齊全");
  }

  if ($role == 2) {
    $sql = "UPDATE rafael_board AS b SET is_deleted=1 WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
  } else {
    $sql = "UPDATE rafael_board AS b SET is_deleted=1 WHERE id=? AND username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id, $username);
    $result = $stmt->execute();
  }


  if (!$result) {
    die($conn->error);
  }

  header("location:index.php");

?>