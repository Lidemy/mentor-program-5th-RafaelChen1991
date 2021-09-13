<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $id = $_GET["id"];
  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $sql = "SELECT * FROM rafael_board WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();

  if(!$result) {
    die("error: ". $conn->error);
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="warning">
    注意!本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </header>
  <div class="comment-area">
    <h1>編輯留言</h1>
    <?php
      if (!empty($_GET["errCode"])) {
        $code = $_GET["errCode"];
        $msg = "ERROR";
        if ($code === '1') {
          $msg = "資料不齊全";
        }
        echo "<h2 class='error'> 錯誤: " . $msg . "</h2>";
      }
    ?>
    <form method="POST" class="now-comment" action="handle_update_comment.php">
      <textarea  name="content" rows="5" ><?php echo escape($row['content']); ?></textarea>
      <input type="hidden" name="id" value="<?php echo $row['id'] ?>"/>
      <input type="submit" class="comment__submit-btn" />
    </form>

    <div class="hr"></div>

</body>
</html>