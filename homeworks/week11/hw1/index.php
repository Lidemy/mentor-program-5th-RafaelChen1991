<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  $user = NULL;
  $role = 1;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
    $role = $user['role'];
  }

  $page = 1;
  if (!empty($_GET["page"])) {
    $page = intval($_GET["page"]);
  }
  $items_per_page = 5;
  $offset = ($page - 1) * $items_per_page;

  $sql = "SELECT B.id AS id, B.content AS content, B.created_at AS created_at, U.nickname AS nickname, U.username AS username, U.role AS role FROM rafael_board AS B LEFT JOIN rafael_users AS U ON B.username = U.username WHERE B.is_deleted IS NULL ORDER BY B.id DESC LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $items_per_page, $offset);
  $result = $stmt->execute();
  


  if(!$result) {
    die("error: ". $conn->error);
  }

  $result = $stmt->get_result();

  
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
      <?php } else if ($role == 2) { ?>
          <a class="comment-btn" href="admin.php">管理後台</a>
          <a class="comment-btn" href="logout.php">登出</a>
      <?php } else {?>
        <a class="comment-btn" href="logout.php">登出</a>
        <span class="comment-btn update-nickname">修改暱稱</span>
        <form class="hide board__nickname-form" method="POST" action="handle_update_nickname.php">
          <span>新的暱稱: </span>
          <input type="text" name="nickname"/>
          <input type="submit" class="comment__submit-btn" />
        </form>
        <h3>Hello! <?php echo escape($user['nickname']); ?> <?php if ($role == 0) {?> 您已經被停權了 <?php } ?></h3>
      <?php } ?>
    </div>
    <?php if ($role != 0) { ?>
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
    <?php } ?>
    <section>
      <?php
        while($row = $result->fetch_assoc()) {
      ?>
      <div class="comment">
        <div class="comment__avatar"></div>
        <div class="comment__body">
          <div class="comment__info">
            <span class="comment__info-name"><?php echo escape($row["nickname"]); ?>  (@<?php echo escape($row['username']);?>) </span>
            <span class="comment__info-time"><?php echo escape($row["created_at"]); ?> </span>
            <?php if($row["username"] === $username || $role == 2) { ?>
              <a href="update_comment.php?id=<?php echo escape($row['id']); ?>"> 編輯</a>
              <a href="delete_comment.php?id=<?php echo escape($row['id']); ?>"> 刪除</a>
            <?php } ?>  
          </div>
          <p class="comment__text"><?php echo escape($row["content"]); ?></p>
        </div>
      </div>
      <?php } ?>
    </section>
    <div class="hr"></div>
    <?php
      $stmt = $conn->prepare("SELECT count(id) AS count FROM rafael_board WHERE is_deleted IS NULL");
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row["count"];
      $total_page = intval(ceil($count / $items_per_page));
    ?>
    <div class="page-info">
      <span>總共有 <?php echo $count; ?>筆資料, 頁數: </span>
      <span><?php echo $page; ?> / <?php echo $total_page; ?></span>
    </div>
    <div class="paginator">
      <?php if($page !== 1 ) { ?>
        <a href="index.php?page=1">首頁</a>
        <a href="index.php?page=<?php echo $page - 1; ?>">前一頁</a>
      <?php } ?>
      <?php if($page !== $total_page ) { ?>
        <a href="index.php?page=<?php echo $page + 1; ?>">後一頁</a>
        <a href="index.php?page=<?php echo $total_page; ?>">末頁</a>
      <?php } ?>
    </div>

  </div>
  <script>
    var btn = document.querySelector(".update-nickname")
    btn.addEventListener("click", function(){
      var form = document.querySelector(".board__nickname-form")
      form.classList.toggle("hide")
    })
  </script>
</body>
</html>