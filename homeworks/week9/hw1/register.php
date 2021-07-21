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
      <a class="comment-btn" href="index.php">回留言板</a>
      <a class="comment-btn" href="login.php">登入</a>
    </div>
    <h1>註冊</h1>
    <?php
      if(!empty($_GET["errCode"])) {
        $code = $_GET["errCode"];
        $msg = "ERROR";
        if ($code === "1") {
          $msg = "請輸入完整資料";
        } else if ($code === "2") {
          $msg = "此帳號已被註冊!";
        }
        echo "<h2 class='error'> 錯誤: " . $msg . "</h2>";
      }
    ?>
    <form method="POST" class="now-comment" action="handle_register.php">
      <div>
        <span>暱稱: </span>
        <input type="text" name="nickname" />
      </div>
      <div>
        <span>帳號: </span>
        <input type="text" name="username" />
      </div>
      <div>
        <span>密碼: </span>
        <input type="password" name="password" />
      </div>
      <input type="submit" class="comment__submit-btn" />
    </form>

  </div>
</body>
</html>