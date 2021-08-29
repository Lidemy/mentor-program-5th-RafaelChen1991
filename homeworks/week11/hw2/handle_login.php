<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  
  $username = $_POST["username"];



  //search user

  $sql_searchuser = "SELECT * FROM rafael_blog_users WHERE username=?";
  $stmt_searchuser = $conn->prepare($sql_searchuser);
  $stmt_searchuser->bind_param('s', $username);
  $result_searchuser = $stmt_searchuser->execute();
  if(!$result_searchuser) {
    die("error: ". $conn->error);
  } 
  $result_searchuser = $stmt_searchuser->get_result();
  if ($result_searchuser->num_rows === 0) {
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sql = "INSERT INTO rafael_blog_users(username, password) values(?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $result = $stmt->execute();
    if (!$result) {
      die($conn->error);
    }
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    $password = $_POST["password"];
    $row = $result_searchuser->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      header("Location: index.php?name=$username");
    } else {
      header("Location: login.php?errCode=2");
    }
  }




?>



