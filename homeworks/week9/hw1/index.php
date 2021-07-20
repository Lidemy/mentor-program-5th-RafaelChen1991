<?php
  session_start();
  require_once("conn.php");

  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $sql = "SELECT * FROM rafael_board ORDER BY id DESC";
  $result = $conn->query($sql);
  if(!$result) {
    die("error: ". $conn->error);
  }

  $nickname_sql = sprintf("SELECT * FROM rafael_users WHERE username = '%s'",
    $username
  );
  $nickname_result = $conn->query($nickname_sql);
  $nickname_row = $nickname_result->fetch_assoc();



  
  
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
    <div class="btn">
      <?php if(!$username) { ?>
        <a class="comment-btn" href="register.php">註冊</a>
        <a class="comment-btn" href="login.php">登入</a>
      <?php } else { ?>
        <a class="comment-btn" href="logout.php">登出</a>
        <h3>Hello! <?php echo $nickname_row["nickname"] ?></h3>
      <?php } ?>
    </div>
    <h1>Comments</h1>
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
    <form method="POST" class="now-comment" action="handle_add_post.php">
      <textarea  name="content" rows="5" ></textarea>
      <?php if ($username) { ?>
        <input type="submit" class="comment__submit-btn" />
      <?php } else { ?>
        <h2>請先登入再發布留言。</h2>
      <?php } ?>
    </form>

    <div class="hr"></div>
    <section>
      <?php
        while($row = $result->fetch_assoc()) {
      ?>
      <div class="comment">
        <div class="comment__avatar"></div>
        <div class="comment__body">
          <div class="comment__info">
            <span class="comment__info-name"><?php echo $row["nickname"]; ?></span>
            <span class="comment__info-time"><?php echo $row["created_at"]; ?></span>          
          </div>
          <p class="comment__text"><?php echo $row["content"]; ?></p>
        </div>
      </div>

      <?php } ?>
    </section>
  </div>
</body>
</html>