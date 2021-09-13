<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $id = $_GET["id"];
  $username = NULL;
  $name = NULL;

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $name = $_SESSION['username'];
  } else if (!empty($_GET['name'])) {
    $name = $_GET['name'];
  }

  $sql = "SELECT * FROM rafael_blog_articles WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  if (!$result) {
    die("error: " . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php?name=<?php echo escape($name)?>'><?php echo escape($name)?>'s Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="all_articles.php?name=<?php echo escape($name) ?>">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
          <?php if(!$username) { ?>
            <li><a href="login.php">登入</a></li>
          <?php }else { ?>
            <li><a href="admin.php">管理後台</a></li>
            <li><a href="logout.php">登出</a></li>
          <?php } ?>
        </div>
      </ul>
    </div>
  </nav>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div><?php echo escape($row["title"]); ?></div>
          <?php if($row["username"] === $username) { ?>
          <div class="post__actions">
            <a class="post__action" href="edit.php?id=<?php echo escape($row['id']); ?>">編輯</a>
          </div>
          <?php } ?>
        </div>
        <div class="post__info">
          <?php echo escape($row["last_edited_at"]); ?>
        </div>
        <div class="post__content">
          <?php echo escape($row["content"]); ?>
        </div>
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>