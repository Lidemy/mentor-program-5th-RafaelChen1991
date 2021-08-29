<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  $name = NULL;

  if (!empty($_GET['name'])) {
    $name = $_GET['name'];
  }

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $items_per_page = 5;
  $offset = ($page - 1) * $items_per_page;

  $sql = "SELECT * FROM rafael_blog_articles WHERE is_deleted IS NULL AND username = ? ORDER BY last_edited_at DESC LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sii', $username, $items_per_page, $offset);
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

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php?name=<?php echo escape($username);?>'><?php echo escape($username);?>'s Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="all_articles.php?name=<?php echo escape($username) ?>">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
          <li><a href="add_article.php">新增文章</a></li>
          <li><a href="logout.php">登出</a></li>
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
    <?php
      while($row=$result->fetch_assoc()) {
    ?>
    <div class="container">
      <div class="admin-posts">
        <div class="admin-post">
          <div class="admin-post__title"><?php echo escape($row['title']); ?></div>
          <div class="admin-post__info"><div class="admin-post__created-at"><?php echo escape($row['last_edited_at']); ?></div>
            <a class="admin-post__btn" href="edit.php?id=<?php echo escape($row['id']); ?>">
              編輯
            </a>
            <a class="admin-post__btn" href="delete.php?id=<?php echo escape($row['id']); ?>">
              刪除
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <?php
  $sql = "SELECT count(id) as count FROM rafael_blog_articles WHERE is_deleted IS NULL AND username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $result = $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $count = $row['count'];
  $total_page = intval(ceil($count / $items_per_page));
  ?>
  <div class="page-info">
    <span>共有<?php echo $count; ?> 筆資料, 頁數:</span>
    <span> <?php echo $page;?> / <?php echo $total_page; ?></span>
  </div>
  <div class="paginator">
    <?php if ($page !== 1) { ?>
      <a href="admin.php?page=1">首頁</a>
      <a href="admin.php?page=<?php echo $page - 1; ?>">上一頁</a>
    <?php } ?>
    <?php if ($page !== $total_page) { ?>
      <a href="admin.php?page=<?php echo $page + 1; ?>">下一頁</a>
      <a href="admin.php?page=<?php echo $total_page; ?>">末頁</a>
    <?php } ?>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>